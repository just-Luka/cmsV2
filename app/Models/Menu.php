<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use App\Models\Translations\Menu as MenuT;

class Menu extends Model
{
    use ModelHelper;

    protected $table = 'menu';
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        return $this->hasOne(MenuT::class, 'menu_id', 'id')->where('lang_slug', App::getLocale());
    }

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
