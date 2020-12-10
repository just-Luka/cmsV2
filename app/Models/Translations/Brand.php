<?php


namespace App\Models\Translations;


use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements ITranslate
{
    protected $table = 'brand_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('brand_id', $id)->first();
    }
}
