<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Banner as BannerT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Banner extends Model
{
    use ModelHelper;

    protected $table = 'banners';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(BannerT::class, 'banner_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param null $type
     * @return mixed
     */
    public function getList($type=null)
    {
        return $this->where('type', $type ?: 'like', '%')->orderBy('sort')->with('translation');
    }
}
