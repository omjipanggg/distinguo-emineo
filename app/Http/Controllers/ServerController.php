<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Criteria;
use App\Models\Evaluatee;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Project;
use App\Models\Tokeniser;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use DataTables;

use RealRashid\SweetAlert\Facades\Alert;

class ServerController extends Controller
{
    public function __construct() {}

    public function fetch(Request $request) {
        dd($request->all());
    }

    /*
    public function fetchByTable(Request $request, string $table) {
    	if (Schema::hasTable($table)) {
    	    $data = DB::table($table)->whereNull('deleted_at');
            if (Schema::hasColumn($table, 'name')) {
                $data = $data->orderBy('name');
            }
            $data = $data->latest()->get();
    	} else { $data = []; }
	    return DataTables::of($data)->make(true);
    }
    */

    public function checkToken(Request $request) {
        $token = $request->token;
        $data = Tokeniser::where('token', $token)->where('is_used', false)->with(['evaluator'])->first();

        if ($data) {
            $data['code'] = 200;
            $data['message'] = 'Token is valid, and may proceed.';
        }
        else {
            $data = Tokeniser::whereHas('evaluator', function($query) use($token) {
                return $query->where('token', $token);
            })->with(['evaluator'])->first();

            if ($data) {
                $data['code'] = 402;
                $data['message'] = 'Token has been used, and is resumable.';
            }
            else {
                $data['code'] = 301;
                $data['message'] = 'Token is either currently being used, or expired, or not found.';
            }
        }

        return response()->json($data);
    }

    public function selectEvaluateesByProject(Request $request, string $id) {
        $project = Project::find($id);

        $data = DB::table('evaluatees')->select('id', 'name', 'card_number')->where('project_number', $project->project_number)->orderBy('name')->groupBy('id', 'name', 'card_number')->whereNull('deleted_at')->get();
        return response()->json($data);
    }

    public function fetchCriterias(Request $request) {
        $data = Criteria::orderBy('name')->where('id', '<>', 999)->with(['type'])->get();
        return DataTables::of($data)->make(true);
    }

    public function fetchScores(Request $request) {
        $token = $request->input('token') ?? null;
        $batch = $request->input('batch') ?? null;

        $tokenId = null;
        if ($token) {
            $tokenId = Tokeniser::where('token', $token)->first()->id;
        }

        $data = [];
        $project_numbers = Tokeniser::join('pivot_projects_tokenisers', 'pivot_projects_tokenisers.tokeniser_id', '=', 'tokenisers.id')->join('projects', 'projects.id', '=', 'pivot_projects_tokenisers.project_id')->with('projects')->where('token', $token)->whereHas('evaluator')->pluck('projects.project_number');

        $data = Evaluatee::whereDoesntHave('evaluations.evaluator', function($query) use($token) {
                return $query->where('token', $token);
            })->whereHas('tokens', function($query) use($tokenId) {
                return $query->where('tokeniser_id', $tokenId);
            })->with(['departments', 'evaluations.evaluator']);

        if ($request->filled('department')) {
            $department = $request->input('department');
            $data = $data->where('project_number', $department);
            /*
            if ($department != 'all') {
                $data = $data->whereHas('departments', function($query) use($department) {
                    return $query->where('department_id', $department);
                });
            }
            */
        } else {
            $data = $data->whereIn('project_number', $project_numbers);
        }

        $data = $data->get();

        return DataTables::of($data)->make(true);
    }

    public function fetchEvaluation(Request $request) {
        $data = Evaluation::with(['criteria.type', 'evaluatee', 'evaluator'])
        ->where('criteria_id', 999)
        ->latest()->orderByDesc('batch')->get();

        $sum_of_batches = Evaluation::join('criterias', 'criterias.id', '=', 'evaluations.criteria_id')->join('criteria_types', 'criteria_types.id', '=', 'criterias.criteria_type_id')->select('evaluations.batch')->selectRaw('SUM(evaluations.remarks) as sum_of_remarks, COUNT(CASE WHEN criteria_types.id = 1 THEN 1 END) as total')->groupBy('batch')->get();

        $rest_of_scores = Evaluation::select('remarks', 'criteria_id', 'batch')
        ->where('criteria_id', '<>', 999)
        ->latest()->orderByDesc('batch')->get();

        $data = $data->map(function($item) use($sum_of_batches) {
            foreach ($sum_of_batches as $key => $value) {
                if ($item['batch'] == $value['batch']) {
                    $item['percentage'] = ($value['sum_of_remarks'] / ($value['total'] * 5)) * 100;
                    $item['stars'] = $value['total'];
                    return $item;
                }

            }
        });

        foreach ($data as $key => $value) {
            $grouped = [];
            foreach ($rest_of_scores as $rest_key => $rest_value) {
                if ($value['batch'] == $rest_value['batch']) {
                    if (is_numeric($rest_value['remarks'])) {
                        $grouped[] = [
                            'other_id' => $rest_value['criteria_id'],
                            'other_remarks' => $rest_value['remarks']
                        ];
                    }
                }
            }
            $value['others'] = $grouped;
        }

        return DataTables::of($data)->make(true);
    }

    public function fetchEvaluationHistory(Request $request) {
        $token = $request->token ?? null;

        $batches = Evaluation::select('batch')->whereHas('evaluator', function($query) use($token) {
            return $query->where('token', $token);
        })->groupBy('batch')->pluck('batch') ?? [];

        $data = Evaluation::whereHas('evaluator', function($query) use($token) {
            return $query->where('token', $token);
        })
        ->where('criteria_id', 999)
        ->whereIn('batch', $batches);

        if ($request->has('department')) {
            $department = $request->department;
            $data = $data->whereHas('evaluatee', function($query) use($department) {
                return $query->where('project_number', $department);
            });

            /*
            if ($department != 'all') {
                $data = $data->whereHas('evaluatee.departments', function($query) use($department) {
                    return $query->where('department_id', $department);
                });
            }
            */
        }

        $data = $data->with(['criteria.type', 'evaluatee.departments', 'evaluator'])->get();

        $sum_of_batches = Evaluation::select('batch')->selectRaw('SUM(remarks) as sum_of_remarks, COUNT(remarks) as total')->groupBy('batch')->get();

        $data = $data->map(function($item) use($sum_of_batches) {
            foreach ($sum_of_batches as $key => $value) {
                if ($item['batch'] == $value['batch']) {
                    $item['percentage'] = ($value['sum_of_remarks'] / 25) * 100;
                    $item['stars'] = $value['total'];
                    return $item;
                }
            }
        });

        return DataTables::of($data)->make(true);
    }

    public function fetchProjects(Request $request) {
        $data = Project::leftJoin('evaluatees', 'evaluatees.project_number', '=', 'projects.project_number')->select('projects.id', 'projects.project_number', 'projects.name', 'projects.description')->selectRaw('COUNT(evaluatees.id) as total')->groupBy('projects.id', 'projects.project_number', 'projects.name', 'projects.description')->orderBy('projects.project_number')->get();
        return DataTables::of($data)->make(true);
    }

    public function fetchMembers(Request $request) {
        $data = Evaluatee::orderBy('name')->with(['departments'])->get();
        return DataTables::of($data)->make(true);
    }

    public function fetchTokens(Request $request) {
    	$data = Tokeniser::with(['evaluator' => function($query) {
            return $query->withCount('evaluations');
        }])->with(['project'])->withCount('evaluatees')->latest()->get();

    	return DataTables::of($data)->make(true);
    }

    public function fetchAssessments(Request $request) {
        $data = Assessment::orderBy('name')->with(['criterias'])->get();
        return DataTables::of($data)->make(true);
    }

    public function fetchUsers(Request $request) {
        $data = User::orderBy('name')->get();
        return DataTables::of($data)->make(true);
    }

    public function newEvaluator(Request $request) {
        $data = Evaluator::updateOrCreate([
            'token' => $request->token
        ], [
            'name' => $request->name,
            'token' => $request->token,
            'user_agent' => $request->agent
        ]);

        $data['code'] = 200;

        Tokeniser::where('token', $request->token)
        ->update([
            'is_used' => true,
            'used_at' => Carbon::now()
        ]);

        return response()->json($data);
    }

    public function updateEvaluator(Request $request) {
        $token = $request->token ?? null;

        $data = Evaluator::where('token', $token)->first();

        $data->update(['user_agent' => $request->agent]);

        $data['code'] = 200;

        Tokeniser::where('token', $token)
        ->update([
            'is_used' => true,
            'used_at' => Carbon::now()
        ]);

        return response()->json($data);
    }
}
