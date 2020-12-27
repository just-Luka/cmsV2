<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use App\Models\BaseModel;

class Page extends BaseModel implements ITranslate
{
    protected $table = 'page_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('page_id', $id)->first();
    }
}
