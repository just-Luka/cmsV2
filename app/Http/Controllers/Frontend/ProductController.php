<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;

class ProductController extends BaseController
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'products';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);

    }

    /**
     * @param $locale
     * @param $slug
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Product $product)
    {
        $this->templateName .= 'index';
        $this->data['item'] = $product->frontItem($slug);

        return view($this->templateName, $this->data);
    }
}
