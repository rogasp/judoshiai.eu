<?php

namespace App;

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
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'admin_since',
    ];

    public function clubs()
    {
        return $this->hasMany(Club::class, 'user_id');
    }

    public function ownedClubs()
    {
        return $this->hasMany(Club::class, 'owner_id');
    }

    public function adminClubs()
    {
        return $this->belongsToMany(Club::class)->withTimestamps();;
    }

    public function isAdmin()
    {
        return $this->admin_since != null
            && $this->admin_since->lessThanOrEqualTo(now());
    }
}
