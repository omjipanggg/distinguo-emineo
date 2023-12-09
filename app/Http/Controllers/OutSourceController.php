<?php

namespace App\Http\Controllers;

use App\Models\Evaluatee;

use App\Imports\OutSourceImport;

use DataTables;
use Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

use Maatwebsite\Excel\HeadingRowImport;
use RealRashid\SweetAlert\Facades\Alert;

class OutSourceController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'has.dashboard', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.member.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Flush a newly imported resource in storage.
     */
    public function import(Request $request)
    {
        if (!$request->hasFile('file')) {
            alert()->error('Kesalahan', 'Berkas tidak ditemukan.');
            return redirect()->back()->with([
                'code' => 301,
                'message' => 'Berkas tidak ditemukan.',
                'icon' => 'x-circle',
                'variant' => 'danger'
            ]);
        }

        $file = $request->file('file');

        $name = 'OutSource_' . strtotime('now') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $name, 'public');

        Excel::import(new OutSourceImport(), $file);

        alert()->success('Sukses', 'Data berhasil diunggah.');
        return redirect()->back()->with([
            'code' => 200,
            'message' => 'Data berhasil diunggah.',
            'refreshAfter' => true
        ]);
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
    public function show(Evaluatee $evaluatee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluatee $evaluatee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluatee $evaluatee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluatee $evaluatee)
    {
        //
    }
}
