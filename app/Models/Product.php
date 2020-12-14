<?php

namespace App\Models;

class Product extends RootModel
{
    protected $table = 'products';
    protected $guarded = [];

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
     * @return mixed
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->firstOrFail();
    }
}
