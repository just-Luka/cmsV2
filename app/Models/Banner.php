<?php

namespace App\Models;

class Banner extends RootModel
{
    protected $table = 'banners';
    protected $guarded = [];

    /**
     * @param null $type
     * @return mixed
     */
    public function getList($type=null)
    {
        return $this->where('type', $type ?: 'like', '%')->orderBy('sort')->with('translation');
    }
}
