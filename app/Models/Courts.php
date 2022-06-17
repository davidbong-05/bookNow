<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courts extends Model
{
    use HasFactory;

    protected $fillable = [
        'facilities_id',
        'name'
    ];

    public function pending()
    {
        return Bookings::where('courts_id', $this->id)
            ->where('status', 'Pending')
            ->get();
    }

    public function booked()
    {
        return Bookings::where('courts_id', $this->id)
            ->where('status', 'Approved')
            ->get();
    }

    public function facilities()
    {
        return $this->belongsTo(Facilities::class);
    }
    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}