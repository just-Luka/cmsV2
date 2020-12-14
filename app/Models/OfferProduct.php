<?php


namespace App\Models;

class OfferProduct extends RootModel
{
    protected $table = 'offer_product';
    protected $guarded = [];

    public function getList($id)
    {
        return $this->where('offer_id', $id);
    }
}
