<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ControllerHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ControllerHelper;

    protected $data;
    protected $templateName;
    protected $request;
    protected $moduleName;

    const PAG_NUM = 20;
}
