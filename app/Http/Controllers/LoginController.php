<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function authenticate(Request $request) {

        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('patient')->attempt($request->only(['username', 'password']))) {
            return redirect()->route('dashboard_patient');
        } 

        if(Auth::guard('doctor')->attempt($credentials)) {
            return redirect()->route('dashboard_doctor');
        }

        if(Auth::guard('pharmacist')->attempt($credentials)) {
            return redirect()->route('dashboard_pharmacist');
        }

        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard_admin');
        }
        
        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();
        
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}