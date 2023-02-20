<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uiController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function location(){
        return view('location');
    }
    public function user(){
        return view('user');
    }
    public function about(){
        return view('about');
    }
}
