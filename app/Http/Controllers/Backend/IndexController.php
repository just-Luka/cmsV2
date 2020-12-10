<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('modules.dashboard.wrapper');
    }

}
