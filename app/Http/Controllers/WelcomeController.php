<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $prefs = config('pref');
        return view('welcome');         
    }
}
