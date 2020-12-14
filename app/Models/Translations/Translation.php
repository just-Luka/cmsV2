<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Translation extends Model implements ITranslate
{
    protected $table = 'translation_trans';
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo('App\Models\Translation','translation_id','id');
    }

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getItem($lang, $id)
    {
        return $this->where('lang_slug', $lang)->where('translation_id', $id)->first();
    }

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public static function getItemS($lang, $id)
    {
        return (new self)->getItem($lang, $id);
    }

    /**
     * @param $lang
     * @param $id
     * @param null $word
     * @return string
     */
    public function getMeaning($lang, $id, $word=null)
    {
        $row = $this->getItem($lang, $id);

        return $row ? $row->means : 'lang('.$word.')';
    }
}
