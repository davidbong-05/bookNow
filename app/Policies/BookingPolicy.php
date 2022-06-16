<?php

namespace App\Policies;

use App\Models\Bookings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        $canBook = true;

        if ($user->freshBooking()->isNotEmpty() || Carbon::now()->format('D') == 'Fri' || Carbon::now()->format('D') == 'Sat' || Carbon::now()->format('D') == 'Sun') {
            $canBook = false;
        };

        return $canBook;
    }


    public function update(User $user, Bookings $bookings)
    {
        //
    }


    public function delete(User $user, Bookings $bookings)
    {
        //
    }
}