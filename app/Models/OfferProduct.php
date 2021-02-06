<?php


namespace App\Models;

class OfferProduct extends BaseModel
{
    protected $table = 'offer_product';
    protected $guarded = [];

    /**
     * @param $id
     * @return mixed
     */
    public function getList($id)
    {
        return $this->where('offer_id', $id);
    }
}
