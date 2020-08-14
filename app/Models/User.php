<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

/**
 * Class User
 * @package App\Models
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function permissions()
    {
        return $this->hasManyThrough(
            RolePermission::class,
            Role::class,
            'id', // Foreign key on roles table
            'role_id', // Foreign key on role_permissions table
            'role_id', // Local key on users table
            'id' // Local key on roles table
        );
    }

    /**
     * @param string $ability
     * @return bool
     */
    public function hasPermissionTo(string $ability): bool
    {
        $permission = RolePermission::where('ability', $ability)->first();

        return (! $permission)
            ? false
            : $this->permissions->contains('id', $permission->id);
    }
}
