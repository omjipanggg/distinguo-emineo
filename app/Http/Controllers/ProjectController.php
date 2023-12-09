<?php

namespace App\Http\Controllers;

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
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        alert()->success('Sukses', 'Data dihapus.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data dihapus.'
        ]);
    }
}
