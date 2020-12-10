<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements ITranslate
{
    protected $table = 'post_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('post_id', $id)->first();
    }

}
