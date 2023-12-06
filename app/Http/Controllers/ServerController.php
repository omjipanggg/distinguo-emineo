<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Evaluatee;
use App\Models\Evaluation;
use App\Models\Evaluator;
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

    public function fetchByTable(Request $request, string $table) {
    	if (Schema::hasTable($table)) {
    	    $data = DB::table($table)->whereNull('deleted_at');
            if (Schema::hasColumn($table, 'name')) {
                $data = $data->orderBy('name');
            }
            $data = $data->get();
    	} else { $data = []; }
	    return DataTables::of($data)->make(true);
    }

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
                $data['message'] = 'Token is either being used, or expired, or not found.';
            }
        }

        return response()->json($data);
    }

    public function fetchCriterias(Request $request) {
        $data = Criteria::orderBy('name')->with(['type'])->get();
        return DataTables::of($data)->make(true);
    }

    public function fetchScores(Request $request) {
        $token = $request->input('token') ?? null;

        $data = [];
        $param = Tokeniser::select('region', 'zone')->where('token', $token)->whereHas('evaluator')->first();

        if ($param) {
            $departments = Tokeniser::join('pivot_departments_tokenisers', 'pivot_departments_tokenisers.tokeniser_id', '=', 'tokenisers.id')->where('tokenisers.token', $token)->pluck('pivot_departments_tokenisers.department_id');

            $data = Evaluatee::where('region', $param->region)
                ->where('zone', $param->zone);


            if ($request->filled('department')) {
                $department = $request->input('department');
                if ($department != 'all') {
                    $data = $data->whereHas('departments', function($query) use($department) {
                        return $query->where('department_id', $department);
                    });
                }
            } else {

                $data = $data->whereHas('departments', function($query) use($departments) {
                    return $query->whereIn('department_id', $departments);
                });
            }

            $data = $data->whereDoesntHave('evaluations.evaluator', function($query) use($token) {
                    return $query->where('token', $token);
                })
                ->with(['departments', 'evaluations.evaluator'])
            ->get();
        }

        return DataTables::of($data)->make(true);
    }

    public function fetchEvaluationHistory(Request $request) {
        $token = $request->token ?? null;

        $batches = Evaluation::select('batch')->whereHas('evaluator', function($query) use($token) {
            return $query->where('token', $token);
        })->groupBy('batch')->pluck('batch');

        $data = Evaluation::whereHas('evaluator', function($query) use($token) {
            return $query->where('token', $token);
        })->whereIn('batch', $batches)->where('criteria_id', 999);

        if ($request->has('department')) {
            $department = $request->department;
            if ($department != 'all') {
                $data = $data->whereHas('evaluatee.departments', function($query) use($department) {
                    return $query->where('department_id', $department);
                });
            }
        }

        $data = $data->with(['criteria.type', 'evaluatee.departments', 'evaluator'])->get();

        return DataTables::of($data)->make(true);
    }

    public function fetchMembers(Request $request) {
        $data = Evaluatee::orderBy('name')->with(['departments'])->get();
        return DataTables::of($data)->make(true);
    }

    public function fetchTokens(Request $request) {
    	$data = Tokeniser::with(['departments'])->latest()->get();
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
}