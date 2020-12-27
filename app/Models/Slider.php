<?php


namespace App\Models;

class Slider extends BaseModel
{
    protected $table = 'sliders';
    protected $fillable = [
        'attachment',
        'image',
        'visible',
        'sort',
        'attachment_id',
        'position'
    ];

    /**
     * @param null $attachment
     * @return mixed
     */
    public function getList($attachment=null)
    {
        return $this->where('attachment', $attachment ?: 'like', '%')->with('translation');
    }

    /**
     * @param $position
     * @return mixed
     */
    public function getFrontList($position)
    {
        return $this->where('visible', 1)->where('position', $position)->orderBy('sort')->with('translation')->get();
    }
}
