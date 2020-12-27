<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $table = 'categories';
    protected $guarded = [];

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
     * @return mixed
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->firstOrFail();
    }
}
