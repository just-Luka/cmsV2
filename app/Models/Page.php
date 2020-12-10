<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Page as PageT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Page extends Model
{
    use ModelHelper;

    protected $table = 'pages';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(PageT::class, 'page_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->first() ?: abort(404);
    }
}
