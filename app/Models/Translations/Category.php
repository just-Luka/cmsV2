<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements ITranslate
{
    protected $table = 'category_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('category_id', $id)->first();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getItemByName($name)
    {
        return $this->where('name', $name)->first();
    }
}
