<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    protected $table = 'offer_product';
    protected $guarded = [];

    public function getList($id)
    {
        return $this->where('offer_id', $id);
    }
}
