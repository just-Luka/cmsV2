<?php

namespace App\Http\Controllers\Traits;

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

/* TODO I don't like here, code must be reduced!!!!! plus need to add some events On Delete */
trait AttachableTrait
{
    /**
     * @param $id
     */
    public function attachCategory($id)
    {
        $object = new RefCategory();

        $links = $object->getList($this->moduleName, $id);
        if ($links->get()) {
            $links->delete();
        }

        foreach ($this->request->all() as $key => $value) {
            if (preg_match('/category_/', $key)){
                $object->create([
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
        $object = new RefTag();

        $links = $object->getList($this->moduleName, $id);
        if ($links->get()) {
            $links->delete();
        }

        foreach ($this->request->all() as $key => $value) {
            if (preg_match('/tag_/', $key)){
                $object->create([
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
    public function attachOffer($id)
    {
        $object = new OfferProduct();

        $links = $object->getList($id);
        if ($links->get()) {
            $links->delete();
        }

        foreach ($this->request->all() as $key => $value) {
            if (preg_match('/product_/', $key)){
                $object->create([
                    'offer_id' => $id,
                    'product_id' => $value,
                ]);
            }
        }
    }

}
