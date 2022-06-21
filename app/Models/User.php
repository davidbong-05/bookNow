<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'unimas_id',
        'role',
        'faculty',
        'mobileNum'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function freshBooking()
    {
        return Bookings::where('user_id', $this->id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(function (Builder $query) {
                return $query->where('status', 'Approved')
                    ->orWhere('status', 'Pending');
            })
            ->latest()
            ->get();
    }

    public function bookHistory()
    {
        return Bookings::where('user_id', $this->id)
            ->latest()
            ->paginate(10);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function path($append = '')
    {
        $path = route('profile.show', $this->id);

        return $path ? "{$path}/{$append}" : $path;
    }
}