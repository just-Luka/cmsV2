<?php


namespace App\Facades;


use App\Models\Category;
use App\Models\RefCategory;

class CategoryFacade extends BaseFacade
{
    private $moduleName;
    private $category;

    public function __construct($moduleName)
    {
        $this->moduleName = $moduleName;
        $this->category = new Category();
    }

    public function relatedItems($id)
    {
        (array) $itemId = (new RefCategory())->getList($this->moduleName, $id)->pluck('category_id');

        return $this->category->myCategories($itemId);
    }
}
