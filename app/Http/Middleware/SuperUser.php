<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class SuperUser
{
    public function handle(Request $request, Closure $next): Response
    {
    	if (auth()->check()) {
	    	if (auth()->user()->hasRole(1)) {
	            return $next($request);
	    	} else {
		        alert()->error('Kesalahan', 'Hak akses terbatas.')->autoClose(false);
		    	return redirect()->route('home.index');
	        }
    	}
    	return redirect()->route('login');
    }
}
