<?php

namespace App\Http\Controllers;

use App\Models\Evaluatee;
use App\Models\Project;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::select('project_number')->selectRaw('COUNT(*) as total')->groupBy('project_number')->orderBy('project_number')->get();

        $context = [
            'projects' => $projects
        ];
        return view('pages.dashboard.project.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);

        $context = [
            'project' => $project
        ];

        return view('pages.dashboard.project.form.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Evaluatee::where('project_number', $request->old_no_po)->update(['project_number' => $request->no_po]);
        Project::find($id)->update(['project_number' => $request->no_po, 'name' => $request->name]);

        alert()->success('Sukses', 'Data berhasil diubah.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data berhasil diubah.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::find($id)->delete();

        alert()->success('Sukses', 'Data dihapus.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data dihapus.'
        ]);
    }
}
