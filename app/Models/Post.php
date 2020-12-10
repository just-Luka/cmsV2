<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Translations\Post as PostT;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use ModelHelper;

    protected $table = 'posts';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(PostT::class,'post_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->first() ?: abort(404);
    }
}
