<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\Country as Country;

class Club extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'clubs';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'country_code',
        'user_id',
        'owner_id',
        'administrator_id',
    ];

    protected $with = [
        //
    ];

    protected $dates = [
        'approved_at',
        'activated_at',
    ];

    public function country_name()
    {
        return Country::get($this->country_code);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function administrators()
    {
        return $this->belongsToMany(User::class)->withTimestamps();;
    }
}
