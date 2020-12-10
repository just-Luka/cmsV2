<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Category as CategoryT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use ModelHelper;

    protected $table = 'categories';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(CategoryT::class, 'category_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param null $type
     * @return mixed
     */
    public function getList($type=null)
    {
        return $this->where('category_of', $type ?: 'like', '%')->with('translation');
    }

    /**
     * @param array|object $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function myCategories($id)
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
