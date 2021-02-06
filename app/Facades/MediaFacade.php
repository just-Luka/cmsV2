<?php


namespace App\Facades;


use App\Models\Media;

class MediaFacade
{
    private $media;

    public function __construct($moduleName)
    {
        $this->media = new Media();
    }

    // ...
}
