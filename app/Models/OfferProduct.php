<?php


namespace App\Models;

class OfferProduct extends BaseModel
{
    protected $table = 'offer_product';
    protected $guarded = [];

    public function getList($id)
    {
        return $this->where('offer_id', $id);
    }
}
