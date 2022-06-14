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

    public function edit(User $user)
    {
        return view('Profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'mobileNum' => ['numeric', 'required'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()]

        ]);

        $user->update($attributes);

        return redirect($user->path());
    }
}