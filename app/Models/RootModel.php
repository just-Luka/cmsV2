<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

abstract class RootModel extends Model
{
    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->max('sort') + 1;
    }

    /**
     * @return HasOne
     */
    public function translation(): HasOne
    {
        $class = (new \ReflectionClass($this))->getShortName();

        return $this->hasOne("App\\Models\\Translations\\$class")->where('lang_slug', App::getLocale());
    }
}
