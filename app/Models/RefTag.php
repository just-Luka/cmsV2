<?php


namespace App\Models;

class RefTag extends RootModel
{
    protected $table = 'ref_tag';
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
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
