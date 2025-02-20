<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboardcontroller extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth']);
    }
    public function index()
    {
        $user = Auth::user();
        // dd($user);
        return view('dashboard.index', compact('user'));
    }
}
