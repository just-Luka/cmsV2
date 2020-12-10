<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Language;
use App\Models\OfferProduct;
use App\Models\Product;
use App\Models\RefCategory;
use App\Models\RefTag;
use App\Models\Translations\Category as CategoryT;
use App\Models\Translations\Tag as TagT;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

trait ControllerHelper
{
    /**TODO when attached is deleting, references are not deleting
     * @param $id
     */
    public function attachCategory($id)
    {
        $refCategory = new RefCategory();

        $getCategoryReference = $refCategory->getList($this->moduleName, $id);
        if ($getCategoryReference->get()) {
            $getCategoryReference->delete();
        }

        foreach ($this->request->all() as $key => $value) {
            if (preg_match('/category_/', $key)){
                $refCategory->create([
                    'attached_to'   => $this->moduleName,
                    'attachment_id' => $id,
                    'category_id'   => $value,
                ]);
            }
        }
    }

    /**
     * @param $id
     */
    public function attachTag($id)
    {
        $refTag = new RefTag();

        $getTagReference = $refTag->getList($this->moduleName, $id);
        if ($getTagReference->get()) {
            $getTagReference->delete();
        }

        foreach ($this->request->all() as $key => $value) {
            if (preg_match('/tag_/', $key)){
                $refTag->create([
                    'attached_to'   => $this->moduleName,
                    'attachment_id' => $id,
                    'tag_id'   => $value,
                ]);
            }
        }
    }

    /**
     * @param $id
     */
    public function attachOffers($id)
    {
        $productOffer = new OfferProduct();
        $productOfferRef = $productOffer->getList($id);

        if ($productOfferRef->get()) {
            $productOfferRef->delete();
        }

        foreach ($this->request->all() as $key => $value) {
            if (preg_match('/product_/', $key)){
                $productOffer->create([
                    'offer_id' => $id,
                    'product_id' => $value,
                ]);
            }
        }
    }
}
