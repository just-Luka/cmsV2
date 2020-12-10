<?php


namespace App\Models\Translations;


use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model implements ITranslate
{
    protected $table = 'offer_trans';
    protected $guarded = [];

    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('offer_id', $id)->first();
    }
}
