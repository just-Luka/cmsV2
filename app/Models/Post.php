<?php

namespace App\Models;

class Post extends RootModel
{
    protected $table = 'posts';
    protected $guarded = [];

    /**
     * @param $slug
     * @return mixed
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->firstOrFail();
    }
}
