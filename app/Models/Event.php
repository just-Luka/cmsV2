<?php


namespace App\Models;


use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Event as EventT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Event extends Model
{
    use ModelHelper;

    protected $table = "events";
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(EventT::class, 'event_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @return mixed
     */
    public function getFrontList()
    {
        return $this->where('visible', 1)->orderBy('sort')->with('translation')->get();
    }
}
