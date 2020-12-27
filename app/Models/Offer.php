<?php


namespace App\Models;

class Offer extends BaseModel
{
    protected $table = 'offers';
    protected $guarded = [];

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->firstOrFail();
    }
}
