<?php


namespace App\Console\Commands\Modules\Controllers;

use Illuminate\Support\Str;

class BackendController extends BaseController
{
    /**
     * @return string
     * @Override
     */
    public function template(): String
    {
        return "<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use Illuminate\Http\Request;

class ".ucfirst($this->moduleName)."Controller extends Controller
{

    /**
     * ".ucfirst($this->moduleName)."Controller constructor.
     * @param Request dollar|request
     */
    public function __construct(Request dollar|request)
    {
        dollar|this->moduleName = '".Str::plural($this->moduleName)."';
        dollar|this->templateName = 'modules.'.dollar|this->moduleName.'.';
        dollar|this->data['moduleName'] = lang(dollar|this->moduleName);
    }

    /**
     * @param dollar|locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(dollar|locale)
    {
        dollar|this->templateName .= 'wrapper';

        return view(dollar|this->templateName, dollar|this->data);
    }
}
        ";
    }
}
