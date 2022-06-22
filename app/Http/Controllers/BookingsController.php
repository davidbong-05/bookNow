<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facilities;
use App\Models\Bookings;
use App\Models\Courts;
use App\Models\User;

class BookingsController extends Controller
{

    public function show(User $user)
    {

        return view('Bookings.show', [

            'bookings' => $user->bookHistory()
        ]);
    }

    public function create(Facilities $facility)
    {
        return view('Bookings.create', compact('facility'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'courts_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'remark' => 'required',
        ]);

        Bookings::create([
            'user_id'   => $validated['user_id'],
            'courts_id' => $validated['courts_id'],
            'date'      => $validated['date'],
            'time'      => $validated['time'],
            'remark'    => $validated['remark'],
            'status'    => 'Pending',
        ]);
        return current_user()->freshBooking()->first()->id;
    }

    public function update(Bookings $booking)
    {
        $attributes = request()->validate([
            'status' => ['required']
        ]);
        $booking->update($attributes);

        return 'Success';
    }

    public function destroy(Bookings $booking)
    {
        $booking->delete();
        return 'deleted';
    }
}