<?php


namespace App\Models;


use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use App\Models\Translations\Offer as OfferT;

class Offer extends Model
{
    use ModelHelper;

    protected $table = 'offers';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(OfferT::class, 'offer_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->first() ?: abort(404);
    }
}
