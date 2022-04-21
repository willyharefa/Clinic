<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $title = "Praktik Dokter - Pelayanan Kesehatan Online";
        return view('homepage', compact('title'));
    }

    public function register()
    {
        $title = "Registrasi Akun Baru";
        return view('register', compact('title'));
    }

    public function login()
    {
        $title = "Login user";
        return view('login', compact('title'));
    }
}
