<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;

class PageController extends BaseController
{
    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'pages';
        $this->templateName = 'modules.'.$this->moduleName.'.templates.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param $locale
     * @param $slug
     * @param Page $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Page $page)
    {
        $this->data['item'] = $page->frontItem($slug);
        $this->templateName .= $this->data['item']->template;

        return view($this->templateName, $this->data);
    }
}
