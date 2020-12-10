<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use ModelHelper;

    protected $table = 'translation';

    protected $fillable = [
        'key',
        'sort',
        'is_backend'
    ];

    /**
     * @param $side
     * @param $order
     * @return mixed
     */
    public function getList($side, $order)
    {
        $item = $this->where('is_backend', $side ?: 'like', "%");
        switch ($order){
            case 'a_to_z':
                $item->orderBy('key', 'ASC');
                break;
            case 'z_to_a':
                $item->orderBy('key', 'DESC');
                break;
            case 'id_asc':
                $item->orderBy('id', 'ASC');
                break;
            case 'id_desc':
                $item->orderBy('id', 'DESC');
                break;
            default:
                $item->orderBy('key', 'ASC');
        }

        return $item;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getItem($key)
    {
        return $this->where('key', $key)->first();
    }
}
