<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends RootModel
{
    protected $table = 'menu';
    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('translation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getList()
    {
        return $this->with('translation');
    }

    /**
     * @param $menuID
     * @return mixed
     */
    public function getChildren($menuID)
    {
        return $this->where('parent_id', $menuID);
    }
}
