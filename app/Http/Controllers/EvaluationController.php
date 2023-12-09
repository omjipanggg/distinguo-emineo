<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Evaluatee;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Tokeniser;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $queries = null;

        if ($request->has('token')) {
            $queries = $request->all();
        }

        $context = [
            'queries' => $queries
        ];
        return view('pages.evaluation.index', $context);
    }

    public function assessment(Request $request)
    {
        $context = [];
        return view('pages.evaluation.form.assessment', $context);
    }

    public function score(Request $request)
    {
        $token = $request->input('token') ?? null;

        /*
	    $exists = Tokeniser::where('token', $token)->exists();
 	    if (!$exists) {
            alert()->error('Kesalahan', 'Token tidak ditemukan.');
	        return redirect()->route('evaluation.index')->with(['code' => 404, 'message' => 'Token tidak ditemukan.', 'variant' => 'danger', 'icon' => 'x-circle']);
	    }
        $evaluator = Evaluator::whereHas('tokeniser', function($query) use($token) {
            return $query->where('token', $token);
        })->with(['tokeniser.departments'])->first();
        */

        $project_numbers = Tokeniser::join('pivot_projects_tokenisers', 'pivot_projects_tokenisers.tokeniser_id', '=', 'tokenisers.id')->join('projects', 'projects.id', '=', 'pivot_projects_tokenisers.project_id')->with('projects')->where('token', $token)->whereHas('evaluator')->pluck('projects.project_number');

        $departments = Evaluatee::join('pivot_departments_evaluatees', 'pivot_departments_evaluatees.evaluatee_id', '=', 'evaluatees.id')->join('departments', 'departments.id', '=', 'pivot_departments_evaluatees.department_id')->select('departments.id', 'departments.name')->whereIn('project_number', $project_numbers)->whereDoesntHave('evaluations.evaluator', function($query) use($token) {
                return $query->where('token', $token);
            })->with(['departments', 'evaluations.evaluator'])->groupBy('departments.id', 'departments.name')->get();

        $context = [
            'departments' => $departments,
            'token' => $token
        ];

        return view('pages.evaluation.score', $context);
    }

    public function history(Request $request)
    {
        $token = $request->input('token') ?? null;

        $project_numbers = Tokeniser::join('pivot_projects_tokenisers', 'pivot_projects_tokenisers.tokeniser_id', '=', 'tokenisers.id')->join('projects', 'projects.id', '=', 'pivot_projects_tokenisers.project_id')->with('projects')->where('token', $token)->whereHas('evaluator')->pluck('projects.project_number');

        $departments = Evaluatee::join('pivot_departments_evaluatees', 'pivot_departments_evaluatees.evaluatee_id', '=', 'evaluatees.id')->join('departments', 'departments.id', '=', 'pivot_departments_evaluatees.department_id')->select('departments.id', 'departments.name')->whereIn('project_number', $project_numbers)->whereHas('evaluations.evaluator', function($query) use($token) {
                return $query->where('token', $token);
            })->with(['departments', 'evaluations.evaluator'])->groupBy('departments.id', 'departments.name')->get();

        $context = [
            'departments' => $departments,
            'token' => $token
        ];

        return view('pages.evaluation.history', $context);
    }

    public function create(Request $request)
    {
        $token = $request->token ?? null;

        $evaluatee = Evaluatee::find($request->evaluatee_id);

        $materials = Assessment::join('pivot_projects_tokenisers', 'pivot_projects_tokenisers.assessment_id', '=', 'assessments.id')
            ->join('tokenisers', 'tokenisers.id', '=', 'pivot_projects_tokenisers.tokeniser_id')
            ->where('tokenisers.token', $token)
            ->with(['criterias.type'])
        ->first();

        $context = [
            'evaluatee' => $evaluatee,
            'materials' => $materials,
            'token' => $token
        ];

        // return response()->json($materials);
        return view('pages.evaluation.form.create', $context);
    }

    public function store(Request $request)
    {
        $data = [];
        foreach ($request->all() as $key => $value) {
            $data[] = $key;
        }

        // $filteredNumbers = preg_grep('/\d+/', $data);

        $criterias = [];
        foreach ($request->all() as $key => $value) {
            preg_match('/\d+/', $key, $matches);

            if (!empty($matches)) {
                $criterias[$matches[0]] = $value;
            }
        }

        $evaluatee_id = $request->input('evaluatee_id');
        $evaluator_id = Evaluator::where('token', $request->input('token'))->first()->id;

        $batch = strtotime('now');
        $result = $request->input('result');

        foreach ($criterias as $key => $value) {
            $evaluation = Evaluation::create([
                'evaluator_id' => $evaluator_id,
                'evaluatee_id' => $evaluatee_id,
                'criteria_id' => $key,
                'remarks' => $value,
                'batch' => $batch
            ]);
        }

        Evaluation::create([
            'evaluator_id' => $evaluator_id,
            'evaluatee_id' => $evaluatee_id,
            'criteria_id' => 999,
            'remarks' => $result,
            'batch' => $batch
        ]);

        alert()->success('Sukses', 'Penilaian berhasil ditambahkan.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Penilaian untuk [' . Str::upper($request->name) . '] berhasil ditambahkan.'
        ]);
    }

    public function temp(Request $request)
    {
        $token = $request->token ?? null;

        $context = [
            'token' => $token
        ];

        return view('pages.evaluation.temp', $context);
    }

    public function show(Request $request, string $batch)
    {
        $evaluatee = Evaluatee::find($request->evaluatee_id);
        $evaluation = Evaluation::where('batch', $batch)->with(['criteria.type', 'evaluatee.departments', 'evaluator'])->get();

        $context = [
            'evaluatee' => $evaluatee,
            'evaluation' => $evaluation
        ];

        return view('pages.evaluation.form.show', $context);
    }

    public function edit(Request $request, string $batch)
    {
        $evaluatee = Evaluatee::find($request->evaluatee_id);
        $evaluation = Evaluation::where('batch', $batch)->with(['criteria.type', 'evaluatee.departments', 'evaluator'])->get();

        $context = [
            'batch' => $batch,
            'evaluatee' => $evaluatee,
            'evaluation' => $evaluation
        ];

        return view('pages.evaluation.form.edit', $context);
    }

    public function update(Request $request, string $batch)
    {
        // dd($request->all());

        $data = [];
        foreach ($request->all() as $key => $value) {
            $data[] = $key;
        }

        // $filteredNumbers = preg_grep('/\d+/', $data);

        $remarks = [];
        foreach ($request->all() as $key => $value) {
            preg_match('/\d+/', $key, $matches);

            if (!empty($matches)) {
                $remarks[$matches[0]] = $value;
            }
        }

        foreach ($remarks as $key => $value) {
            $evaluation = Evaluation::find($key)->update([
                'remarks' => $value
            ]);
        }

        alert()->success('Sukses', 'Penilaian berhasil diubah.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Penilaian berhasil diubah.'
        ]);
    }

    public function destroy(Evaluation $evaluation)
    {
        Evaluation::where('batch', $evaluation->batch)->delete();

        alert()->success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
