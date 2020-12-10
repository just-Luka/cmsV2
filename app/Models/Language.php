<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
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
