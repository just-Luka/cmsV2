<?php


namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\View\View;

class ProductComposer
{
    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        $menu = new Menu();
        $menu = $menu->where('visible', 1)->where('position', 'product')->orderBy('sort')->with('translation')->get();
        $product = new Product();
        $product = $product->where('visible', 1)->orderBy('sort')->with('translation')->get();

        return $view->with('productData', ['menu' => $menu, 'products' => $product]);
    }
}
