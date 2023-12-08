<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Criteria;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class AssessmentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Assessment::orderBy('name')->with(['criterias'])->get();
        $context = [
            'data' => $data
        ];
        return view('pages.dashboard.assessment.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criterias = Criteria::orderBy('name')->where('id', '<>', 999)->with(['type'])->get();
        $context = [
            'criterias' => $criterias
        ];
        return view('pages.dashboard.assessment.form.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Assessment::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $data->criterias()->sync($request->criterias);

        alert()->success('Sukses', 'Data berhasil ditambahkan.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data berhasil ditambahkan.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assessment $assessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assessment $assessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
        //
    }
}
