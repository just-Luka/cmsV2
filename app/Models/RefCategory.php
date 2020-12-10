<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Translations\Category as CategoryT;

class RefCategory extends Model
{
    protected $table = 'ref_category';
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @param $moduleName
     * @param $attachId
     * @return mixed
     */
    public function getList($moduleName, $attachId)
    {
        return $this->where('attached_to', $moduleName)->where('attachment_id', $attachId);
    }
}
