<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperUserController extends Controller
{
    public function __construct() {
    	$this->middleware(['auth', 'super', 'verified'])
    }
}
