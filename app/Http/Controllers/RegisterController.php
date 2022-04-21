<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:patients',
            'email' => 'required|unique:patients|email:dns',
            'phoneNumber' => 'required|numeric',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ],
        [
            'username.required' => 'Username anda masih kosong',
            'email' => 'Email anda tidak dikenali',
            'username.unique' => 'Username anda harus unik',
            'email.required' => 'Email masih kosong',
            'email.unique' => 'Email anda harus unik',
            'username.unique' => 'Email anda harus unik',
            'phoneNumber.required' => 'No telepon masih kosong',
            'phoneNumber.numeric' => 'No telepon harus angka',
            'password.required' => 'Password anda masih kosong',
            'password.min' => 'Password anda minimal 6 karakter',
            'password_confirmation.same' => 'Konfirmasi password anda tidak sesuai',
        ]
    );

        Patient::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'phone' => $request->phoneNumber,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Berhasil buat akun, silahkan login.');
    }
}
