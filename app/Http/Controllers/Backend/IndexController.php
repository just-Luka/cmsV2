<?php

namespace App\Http\Controllers\Backend;


class IndexController extends BaseController
{
    public function index()
    {
        return view('modules.dashboard.wrapper');
    }
}
