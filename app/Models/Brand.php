<?php


namespace App\Models;


use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Brand as BrandT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Brand extends Model
{
    use ModelHelper;

    protected $table ='brands';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(BrandT::class, 'brand_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->first() ?: abort(404);
    }
}
