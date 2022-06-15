<?php

namespace App\Http\Controllers;

use App\Mail\EnquiriesMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiriesController extends Controller
{
    public function store()
    {
        $email = request()->validate(['email' => 'required|email']);
        $details = request()->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:255'
        ]);
        Mail::to($email)->send(new EnquiriesMail(
            $details
        ));
        return response()->json([
            'message' => 'Submitted Successfully'
        ]);
    }
}