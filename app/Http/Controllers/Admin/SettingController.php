<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    // TODO
    public function index()
    {
        return view('admin.setting.index');
    }

    public function safety()
    {
        return view('admin.setting.safety');
    }

    public function person()
    {
        return view('admin.setting.person');
    }
}