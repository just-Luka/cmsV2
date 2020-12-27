<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class SoldController extends BaseController
{
    /**
     * UserController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->moduleName = 'sales';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->templateName .= 'wrapper';

        return view($this->templateName, $this->data);
    }
}
