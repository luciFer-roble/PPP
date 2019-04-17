<?php

namespace App;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    use Notifiable;
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**

     * Check multiple roles

     * @param array $roles

     */

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**

     * Check one role

     * @param string $role

     */

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function estudiante(){
        return $this->hasOne('App\Estudiante','iduser', 'id');
    }
    public function profesor(){
        return $this->hasOne('App\Profesor', 'iduser', 'id');
    }
    public function tutore(){
        return $this->hasOne('App\TutorE','iduser', 'id');
    }
    protected $fillable = [
        'name', 'email', 'password','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
