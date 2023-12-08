<?php

namespace App\Http\Controllers;

use App\Models\Evaluatee;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Tokeniser;
use App\Models\User;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EvaluatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = [];
        return view('pages.evaluator.index', $context);
    }

    public function lounge(Request $request) {
        $found = Tokeniser::where('token', $request->token)->where('is_used', false)->first();

        if (!$found) {
            alert()->error('Kesalahan', 'Token sudah digunakan.');
            return redirect()->route('home.index');
        }

        $context = [
            'token' => $found
        ];

        return view('pages.evaluator.lounge', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $context = [];
        return view('pages.evaluator.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        return redirect()->route('evaluator.index')->with([
            'code' => 200,
            'message' => 'Selamat datang, ' . $name . '!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $token)
    {
        $myRegions = Tokeniser::select('region', 'zone')->where('token', $token)->latest()->first();

        $evaluation = Evaluator::whereHas('tokeniser', function($query) use($token) {
            return $query->where('token', $token);
        })->with(['evaluations'])->get();

        $context = [
            'token' => $token,
            'evaluation' => $evaluation,
            'myRegions' => $myRegions
        ];
        return view('pages.evaluator.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluator $evaluator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluator $evaluator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluator $evaluator)
    {
        //
    }
}
