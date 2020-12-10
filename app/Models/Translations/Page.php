<?php

namespace App\Models\Translations;

use App\Contracts\ITranslate;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements ITranslate
{
    protected $table = 'page_trans';
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pages()
    {
        return $this->belongsTo(Page::class);
    }

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
