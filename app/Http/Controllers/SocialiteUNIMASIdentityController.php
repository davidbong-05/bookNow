<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class SocialiteUNIMASIdentityController extends Controller
{
    public function redirectToUNIMASIdentity()
    {
        return Socialite::driver('unimas_identity')->redirect();
    }

    public function UNIMASIdentitySignIn()
    {
        try {

            $user = Socialite::driver('unimas_identity')
                ->stateless()
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->user();
            $unimas_id = User::where('unimas_id', $user->id)->first();

            if ($unimas_id) {
                Auth::login($unimas_id);
                return redirect('/');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'unimas_id' => $user->id,
                    'role' => 'Student',
                    'faculty' => 'FCSIT',
                    'mobileNum' => rand(1000, 10000),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                Auth::login($createUser);
                return redirect('/');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}