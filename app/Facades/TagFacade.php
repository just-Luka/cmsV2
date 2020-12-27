<?php


namespace App\Facades;

use App\Models\RefTag;
use App\Models\Tag;

class TagFacade extends BaseFacade
{
    private $moduleName;
    private $tag;

    public function __construct($moduleName)
    {
        $this->moduleName = $moduleName;
        $this->tag = new Tag();
    }

    public function relatedItems($id)
    {
        (array) $itemId = (new RefTag())->getList($this->moduleName, $id)->pluck('tag_id');

        return $this->tag->myTags($itemId);
    }
}
