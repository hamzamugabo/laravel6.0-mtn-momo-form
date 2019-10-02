<?php

namespace App\Http\Controllers;

use App\Donation;
use App\MtnPayment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $id)
    {

        $users = User::all();
        $donations = Donation::all();

        return view('welcome', compact('donations', 'users'));
    }
}
