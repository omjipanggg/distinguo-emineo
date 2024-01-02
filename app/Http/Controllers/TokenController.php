<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Evaluatee;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Project;
use App\Models\Region;
use App\Models\Tokeniser;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;

class TokenController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    public function index()
    {
        return view('pages.dashboard.token.index');
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $regions = Region::orderBy('code')->get();
        $zones = Evaluatee::select('zone')->groupBy('zone')->pluck('zone');

        $projects = Project::orderBy('project_number')->get();

        $context = [
            'departments' => $departments,
            'projects' => $projects,
            'regions' => $regions,
            'zones' => $zones
        ];

        return view('pages.dashboard.token.form.create', $context);
    }

    public function store(Request $request)
    {
        $po = Project::find($request->input('projects')[0])->project_number;

        $token = Tokeniser::create([
            'token' => $request->input('token'),
            'project_number' => $po
        ]);

        $token->projects()->syncWithPivotValues(
            $request->input('projects'), [
                'assessment_id' => $request->assessment_id
            ]
        );

        $evaluator = Evaluator::create([
            'name' => $request->input('name'),
            'token' => $request->input('token')
        ]);

        if (in_array(0, $request->evaluatees)) {
            $evaluatees = Evaluatee::where('project_number', $po)->get();
            foreach ($evaluatees as $key => $eval) {
                $eval->tokens()->attach($token->id);
            }
        } else {
            $evaluatees = Evaluatee::whereIn('id', $request->evaluatees)->get();
            foreach ($evaluatees as $key => $eval) {
                $eval->tokens()->attach($token->id);
            }
        }

        alert()->success('Sukses', 'Token baru berhasil dibuat.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Token baru berhasil dibuat.',
        ]);
    }

    public function show(string $id)
    {
        $tokeniser = Tokeniser::find($id);

        if (!$tokeniser) {
            alert()->error('Kesalahan', 'Token tidak ditemukan.');
            return redirect()->back();
        }

        dd($tokeniser);
    }

    public function edit(Tokeniser $tokeniser)
    {
        //
    }

    public function update(Request $request, Tokeniser $tokeniser)
    {
        //
    }

    public function destroy(string $id)
    {
        $tokeniser = Tokeniser::find($id);

        $evaluator = Evaluator::where('token', $tokeniser->token)->delete();

        if (!$tokeniser) {
            alert()->error('Kesalahan', 'Token tidak ditemukan.');
            return redirect()->back()->with([
                'code' => 300,
                'message' => 'Token tidak ditemukan.',
                'variant' => 'danger',
                'icon' => 'x-circle'
            ]);
        }

        $tokeniser->delete();
        alert()->error('Sukses', 'Token dihapus.');
        return redirect()->back()->with([
            'code' => 300,
            'message' => 'Token dihapus.'
        ]);
    }
}
