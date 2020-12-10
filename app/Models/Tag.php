<?php


namespace App\Models;


use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\Tag as TagT;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Tag extends Model
{
    use ModelHelper;

    protected $table = 'tags';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(TagT::class, 'tag_id', 'id')->where('lang_slug', App::getLocale());
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function myTags($id)
    {
        return $this->with('translation')->whereIn('id', $id)->get();
    }

    /**
     * @param null $tagType
     * @return mixed
     */
    public function getList($tagType=null)
    {
        return $this->where('tag_of', $tagType ?: 'like', '%')->with('translation');
    }

    /**
     * @param $slug
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->first() ?: abort(404);
    }
}
