<?php


namespace App\Contracts;


interface ITranslate
{
    public function getItem($lang, $id);
}
