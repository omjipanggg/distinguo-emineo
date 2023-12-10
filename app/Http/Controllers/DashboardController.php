<?php

namespace App\Http\Controllers;

use App\Models\Evaluatee;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Project;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'has.dashboard', 'verified']);
	}

    public function index() {
        $evaluatee = Evaluatee::count();
        $evaluation = Evaluation::count();
        $evaluator = Evaluator::count();
        $project = Project::count();

        $scores = Evaluation::select('remarks')
            ->selectRaw('COUNT(*) as total')
            ->where('criteria_id', 999)
            ->groupBy('remarks')
            ->orderByDesc('remarks')
        ->get();

    	$context = [
            'evaluatee' => $evaluatee,
            'evaluation' => $evaluation,
            'evaluator' => $evaluator,
            'project' => $project,
            'scores' => $scores
        ];

    	return view('pages.dashboard.index', $context);
    }

    public function search(Request $request) {
    	$context = [];
    	return view('pages.dashboard.index', $context);
    }

    public function config() {
        $context = [];
        return view('pages.dashboard.config', $context);
    }

    public function material() {
        $context = [];
        return view('pages.dashboard.config', $context);
    }

    public function user() {
        $context = [];
        return view('pages.dashboard.config', $context);
    }
}
