<?php


namespace App\Facades;


use App\Models\OfferProduct;
use App\Models\Product;

class ProductFacade extends BaseFacade
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function relatedItems($id)
    {
        (array) $itemId = (new OfferProduct())->getList($id)->pluck('product_id');

        return $this->product->myProducts($itemId);
    }
}
