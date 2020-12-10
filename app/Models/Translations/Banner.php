<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model implements ITranslate
{
    protected $table = 'banner_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('banner_id', $id)->first();
    }
}
