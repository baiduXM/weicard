<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    // TODO
    public function index()
    {
        return view('admin.template.index');
    }
}