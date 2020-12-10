<?php


namespace App\Models;


use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Slider as SliderT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Slider extends Model
{
    use ModelHelper;

    protected $table = 'sliders';
    protected $fillable = [
        'attachment',
        'image',
        'visible',
        'sort',
        'attachment_id',
        'position'
    ];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(SliderT::class, 'slider_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param null $attachment
     * @return mixed
     */
    public function getList($attachment=null)
    {
        return $this->where('attachment', $attachment ?: 'like', '%')->with('translation');
    }

    /**
     * @param $position
     * @return mixed
     */
    public function getFrontList($position)
    {
        return $this->where('visible', 1)->where('position', $position)->orderBy('sort')->with('translation')->get();
    }
}
