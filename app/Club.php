<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    //TODO:

    protected $fillable = [
        'name',
        'phone',
        'email',
        'country',
        'user_id',
        'owner_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
