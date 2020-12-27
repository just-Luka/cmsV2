<?php

namespace App\Models;

class Page extends BaseModel
{
    protected $table = 'pages';
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
