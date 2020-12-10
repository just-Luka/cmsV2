<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use App\Models\Translations\Product as ProductT;

class Product extends Model
{
    use ModelHelper;

    protected $table = 'products';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(ProductT::class, 'product_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param array|object $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function myProducts($id)
    {
        return $this->with('translation')->whereIn('id', $id)->get();
    }

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->first() ?: abort(404);
    }
}
