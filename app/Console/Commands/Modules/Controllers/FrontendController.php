<?php


namespace App\Console\Commands\Modules\Controllers;


use Illuminate\Support\Str;

class FrontendController extends BaseController
{
    /**
     * @return string
     * @Override
     */
    public function template(): String
    {
        return "<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;
use Illuminate\Http\Request;

class ".ucfirst($this->moduleName)."Controller extends Controller
{

    /**
     * ".ucfirst($this->moduleName)."Controller constructor.
     * @param Request dollar|request
     */
    public function __construct()
    {
        dollar|this->moduleName = '".Str::plural($this->moduleName)."';
        dollar|this->templateName = 'modules.'.dollar|this->moduleName.'.';
        dollar|this->data['moduleName'] = lang(dollar|this->moduleName);
    }

    /**
     * @param dollar|locale
     * @param dollar|slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(dollar|locale, dollar|slug)
    {
        dollar|this->templateName .= 'index';

        return view(dollar|this->templateName, dollar|this->data);
    }
}
        ";
    }
}
