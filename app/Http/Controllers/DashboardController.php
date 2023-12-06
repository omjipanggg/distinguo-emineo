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
    	dd($request->all());
    	$context = [];
    	return view('pages.dashboard.index', $context);
    }
}
