<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;

class CategoryController extends BaseController
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'categories';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param $locale
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Category $category)
    {
        $this->templateName .= 'index';
        $this->data['item'] = $category->frontItem($slug);

        return view($this->templateName, $this->data);
    }
}
