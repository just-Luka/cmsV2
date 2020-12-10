<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * BrandController constructor.
     */
    public function __construct()
    {
        $this->moduleName = 'brands';
        $this->templateName = 'modules.'.$this->moduleName.'.';
        $this->data['moduleName'] = lang($this->moduleName);
    }

    /**
     * @param $locale
     * @param $slug
     * @param Brand $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, $slug, Brand $brand)
    {
        $this->templateName .= 'index';
        $this->data['item'] = $brand->frontItem($slug);

        return view($this->templateName, $this->data);
    }
}
