<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Evaluatee;
use App\Models\Region;
use App\Models\Tokeniser;

use Illuminate\Http\Request;

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
        $zones = Evaluatee::select('zone')->groupBy('zone')->pluck('zone');
        $regions = Region::orderBy('code')->get();

        $context = [
            'departments' => $departments,
            'regions' => $regions,
            'zones' => $zones
        ];

        return view('pages.dashboard.token.form.create', $context);
    }

    public function store(Request $request)
    {
        $token = Tokeniser::create([
            'token' => $request->input('token'),
	    'region' => $request->input('region'),
	    'zone' => $request->input('zone')
        ]);

        $token->departments()->syncWithPivotValues($request->input('departments'), [
	    'assessment_id' => 1
        ]);

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
