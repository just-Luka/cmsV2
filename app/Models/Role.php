<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends RootModel
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @param $userRoleID
     * @return mixed
     */
    public static function getAllowedModules($userRoleID)
    {
        $arrayAvailableModules = self::find($userRoleID);

        return json_decode($arrayAvailableModules ? $arrayAvailableModules->permissions : -1, true);
    }

    /**
     * @param null $status
     * @return mixed
     */
    public function getList($status=null)
    {
        return $this->where('status', $status ?: 'like', '%')->get();
    }
}
