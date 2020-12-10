<?php

namespace App\Http\Controllers\Frontend;

use App\GraphQL\Queries\Courses;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Controller;
use App\Models\Translations\Page as PageT;

class IndexController extends Controller
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
