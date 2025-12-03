<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        // if (Auth::check()) {
        //     if(Auth::user()->role == 'admin') {
        //         return view('dashboard.admin.home');
        //     } if(Auth::user()->role == 'teacher'){

        //         return view('dashboard.teacher.home');
        //     }
        //     else {
        //         return view('dashboard.student.home');
        //     }
        // } else {
        //     // return view('welcome');
        // }
        return view('wel2');
    }
}
