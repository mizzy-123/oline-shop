<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "firstname" => "required|string",
            "lastname" => "required|string",
            "name" => "required|string",
            "email" => "required|string|email:dns|unique:users",
            "password" => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $phoneNumber = $request->no_wa;
        $pattern = '#^(\\+62|0)\\d{9,12}$#';
        if (preg_match($pattern, $phoneNumber)) {
            if (substr($phoneNumber, 0, 1) === '0') {
                $modifiedPhoneNumber = '62' . substr($phoneNumber, 1);
                $phoneNumber = $modifiedPhoneNumber;
            } else if (substr($phoneNumber, 0, 1) === '+') {
                $modifiedPhoneNumber = '62' . substr($phoneNumber, 1);
                $phoneNumber = $modifiedPhoneNumber;
            }
            // return $phoneNumber;
        } else {
            return back()->withErrors("Nomor tidak valid")->withInput();
        }

        $validated['no_wa'] = $phoneNumber;

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->role()->attach(1);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('verification.notice'))->with('verif', 'verifikasi email telah dikirim');
    }
}
