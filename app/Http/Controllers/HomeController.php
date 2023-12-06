<?php

namespace App\Http\Controllers;

use App\Models\Tokeniser;

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
        Alert::warning('Perhatian', 'Silakan coba kembali.');
        return redirect()->back()->with([
        	'code' => 401,
        	'message' => 'Silakan coba kembali.',
        	'variant' => 'info',
            'icon' => 'info-circle'
        ]);
    }

    public function truncate(string $table) {
    	if (!Schema::hasTable($table)) {
		   	alert()->error('Kesalahan', 'Table is not found.');
	    	return redirect()->route('home.index')->with([
	    		'code' => 403,
	    		'message' => 'Table is not found',
	    		'variant' => 'question',
                'icon' => 'question-circle'
	    	]);
    	}

	    DB::table($table)->truncate();

	   	alert()->success('Sukses', 'Table ('. $table .') has been sanitized.');
    	return redirect()->route('home.index')->with([
    		'code' => 200,
    		'message' => 'Table ('. $table .') has been sanitized.'
    	]);
    }

    public function settings()
    {
        return view('pages.home.settings');
    }
}
