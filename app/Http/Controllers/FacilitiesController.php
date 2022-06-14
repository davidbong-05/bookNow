<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facilities;
use App\Models\Reviews;
// use App\Models\Announcements;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;

class FacilitiesController extends Controller
{
    public function show(Facilities $facility)
    {
        return view('Facilities.show', [
            'facility' => $facility,
            // 'announcements' => Announcements::paginate(5),
            'reviews' => $facility->reviews()
                ->latest()
                ->paginate(5),
        ]);
    }
}