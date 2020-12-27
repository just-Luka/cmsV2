<?php


namespace App\Models\Translations;

use App\Contracts\ITranslate;
use App\Models\BaseModel;

class Offer extends BaseModel implements ITranslate
{
    protected $table = 'offer_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('offer_id', $id)->first();
    }
}
