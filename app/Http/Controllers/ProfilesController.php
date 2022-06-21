<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class ProfilesController extends Controller
{
    public function show(User $user)
    {

        return view('Profiles.show', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()]
        ]);

        $user->update($attributes);

        return 'Success';
    }
}