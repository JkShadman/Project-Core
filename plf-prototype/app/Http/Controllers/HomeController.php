<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome'); // loads resources/views/welcome.blade.php
    }
}