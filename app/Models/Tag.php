<?php


namespace App\Models;

class Tag extends RootModel
{
    protected $table = 'tags';
    protected $guarded = [];

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
     * @return mixed
     */
    public function frontItem($slug)
    {
        return $this->where('visible', 1)->where('slug', $slug)->firstOrFail();
    }
}
