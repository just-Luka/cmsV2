<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ModelToolsTrait;


class BaseController extends Controller
{
    /**
     * That provide some tools to interactive with our models
     */
    use ModelToolsTrait;

    /** That is simple request
     * @var $request
     */
    protected $request;

    /**
     * That is default pagination number on pages
     */
    const PAG_NUM = 20;
}
