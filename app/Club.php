<?php

namespace App;

use App\Http\Utilities\Country as Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopeInvolved($query)
    {
        $id = 0;

        if (Auth::user()) {
            $id = Auth::id();
        }

        $query
            ->where('owner_id', $id)
            ->orWhereHas('administrators', function ($q) use ($id) {
                $q->where('user_id', $id);
            });

        return $query;
    }

    public function is_owner()
    {
        if (Auth::user()) {
            if ($this->owner_id == Auth::user()->id) {
                return true;
            }
        }

        return false;
    }

    public function is_admin()
    {
        if (Auth::user()) {
            if (! Auth::user()->adminClubs()->wherePivot('club_id', $this->id)->get()->isEmpty()) {
                return true;
            }
        }

        return false;
    }

    public function is_activated()
    {
        return $this->activated_at != null
            && $this->activated_at->lessThanOrEqualTo(now());
    }

    public function is_approved()
    {
        return $this->approved_at != null
            && $this->approved_at->lessThanOrEqualTo(now());
    }
}
