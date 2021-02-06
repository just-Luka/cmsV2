<?php


namespace App\Models;

class Offer extends BaseModel
{
    protected $table = 'offers';
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
