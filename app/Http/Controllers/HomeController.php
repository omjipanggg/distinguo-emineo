<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $context = [];
        return view('pages.home.index', $context);
    }

    public function vanish() {
        Alert::warning('Perhatian', 'Please try again later.');
        return redirect()->back()->with([
        	'code' => 401,
        	'message' => 'Please try again later.',
        	'variant' => 'success'
        ]);
    }

    public function truncate(string $table) {
    	if (!Schema::hasTable($table)) {
		   	alert()->error('Kesalahan', 'Table is not found.');
	    	return redirect()->route('home.index')->with([
	    		'code' => 403,
	    		'message' => 'Table is not found',
	    		'variant' => 'success'
	    	]);
    	}

	    DB::table($table)->truncate();

	   	alert()->success('Sukses', 'Table ('. $table .') has been sanitized.');
    	return redirect()->route('home.index')->with([
    		'code' => 200,
    		'message' => 'Table has been sanitized.',
    		'variant' => 'success'
    	]);
    }

    public function settings() {
        return view('pages.home.settings');
    }
}
