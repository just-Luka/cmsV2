<?php


namespace App\Models\Translations;


use App\Contracts\ITranslate;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel implements ITranslate
{
    protected $table = 'tag_trans';
    protected $guarded = [];

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('tag_id', $id)->first();
    }
}
