<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        return view('home.group.index');
    }
}