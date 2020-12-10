<?php

namespace App;

use App\Models\Media;
use App\Models\RefMedia;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'email_verified_at', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The att to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roles()
    {
        return $this->hasOne(Role::class , 'id', 'role_id');
    }

    /**
     * @param null $roleID
     * @param null $orderBy
     * @return mixed
     */
    public function getListWithRoles($roleID=null,$orderBy=null)
    {
        if ($roleID){
            return $this->where('role_id', $roleID)->LeftJoin('roles', 'users.role_id', '=', 'roles.id') // some role_ids -eq null
                ->select('users.*', 'roles.status')->orderBy($orderBy ?? 'id','DESC');
        }
        return $this->LeftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.status')->orderBy($orderBy ?? 'id','DESC');
    }

}
