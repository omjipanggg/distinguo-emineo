<?php

namespace App\Http\Controllers;

use App\Imports\CriteriaImport;

use App\Models\Criteria;

use DataTables;
use Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

use Maatwebsite\Excel\HeadingRowImport;
use RealRashid\SweetAlert\Facades\Alert;

class CriteriaController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = [];
        return view('pages.dashboard.criteria.index', $context);
    }

    public function import(Request $request) {
        Excel::import(new CriteriaImport(), $request->file('file'));

        alert()->success('Sukses', 'Data berhasil diunggah.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data berhasil diunggah.',
            'refreshAfter' => true
        ]);
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
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criteria)
    {
        //
    }
}
