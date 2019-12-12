<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Assignment;

class DashboardController extends Controller
{
    public function index() 
    {
        $assigned = Assignment::where('user_id', Auth::user()->id)->get();

        return view('dashboard', compact('assigned'));
    }

    public function permissionDenied() 
    {
        return view('permission-denied');
    }
}
