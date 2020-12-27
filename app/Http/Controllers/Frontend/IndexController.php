<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;

class IndexController extends BaseController
{
    /**
     * @param $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale)
    {
        $this->templateName .= 'index';
        $this->data['item'] = Page::where('visible', 1)->where('is_main', 1)->first() ?: abort(404);

        return view($this->templateName,$this->data);
    }
}
