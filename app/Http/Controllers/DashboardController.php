<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            return view('welcome');
        } else if (!Auth::user()->hasVerifiedEmail()) {
            return view('auth.verify-email');
        }
        return view('dashboard');
    }
}
