<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'has.dashboard', 'verified']);
	}

    public function index() {
    	$context = [];
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
}
