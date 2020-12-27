<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use App\Models\BaseModel;

class Menu extends BaseModel implements ITranslate
{
    protected $table = 'menu_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('menu_id', $id)->first();
    }
}
