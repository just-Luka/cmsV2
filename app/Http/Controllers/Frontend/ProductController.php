<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;
use App\Models\Category;
use App\Models\RefCategory;
use App\Models\RefTag;
use App\Models\Tag;
use App\Models\Translations\Brand as BrandT;
use App\Models\Media;
use App\Models\Product;
use App\Models\Translations\Category as CategoryT;
use Illuminate\Http\Request;
use App\Models\Translations\Product as ProductT;


class ProductController extends Controller
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
