<?php


namespace App\Models;

class Brand extends BaseModel
{
    protected $table ='brands';
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
