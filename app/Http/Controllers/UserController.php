<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        return view('dashboard.user-pages.edit-account', [
            'user' => auth()->user()
        ]);
    }

    public function update(User $user, Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'name' => 'required|string',
            'no_wa' => 'required|string'
        ]);

        $pattern = '#^(\\+62|0)\\d{9,12}$#';
        if (preg_match($pattern, $validated['no_wa'])) {
            if (substr($validated['no_wa'], 0, 1) === '0') {
                $modifiedPhoneNumber = '62' . substr($validated['no_wa'], 1);
                $validated['no_wa'] = $modifiedPhoneNumber;
            } else if (substr($validated['no_wa'], 0, 1) === '+') {
                $modifiedPhoneNumber = '62' . substr($validated['no_wa'], 1);
                $validated['no_wa'] = $modifiedPhoneNumber;
            }
            // return $phoneNumber;
        } else {
            return back()->withErrors("Nomor tidak valid")->withInput();
        }

        $user->update($validated);

        return back()->with("succes", "Berhasil di update");
    }
}
