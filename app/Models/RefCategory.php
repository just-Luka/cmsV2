<?php


namespace App\Models;

class RefCategory extends BaseModel
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
