<?php

use App\Models\Translation;
use App\Models\Translations\Translation as TranslationT;

if(!function_exists('lang')){
    /**
     * @param $word
     * @return string
     */
    function lang($word)
    {
        $item = (new Translation())->getItem($word);

        return (new TranslationT())->getMeaning(App::getLocale(), $item ? $item->id : null, $word);
    }
}

if (!function_exists('str_limit')) {
    /**
     * @param $text
     * @param $limit
     * @param $delimiter
     * @return string
     */
    function str_limit($text, $limit, $delimiter = '...')
    {
        return Str::limit($text, $limit, $delimiter);
    }
}
