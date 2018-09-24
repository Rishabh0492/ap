<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $customer=Customer::count();
        $user=user::count();
        return view('admin.dashboard',compact('customer','user'));
    }

    public function edit()
    {
        return view('admin.user.edit');
    }
}
