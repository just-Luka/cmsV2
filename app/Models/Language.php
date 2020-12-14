<?php

namespace App\Models;

class Language extends RootModel
{
    protected $fillable = [
        'lang',
        'country'
    ];

    /**
     * @return array
     */
    public static function getList()
    {
        return self::pluck('lang');
    }

    /**
     * @param $lang
     * @return mixed
     */
    public function findByLang($lang)
    {
        return $this->where('lang', $lang)->first();
    }
}
