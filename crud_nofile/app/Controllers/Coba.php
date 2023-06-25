<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        return "hello cb";
    }

    public function about($nama = null, $umur = null)
    {
        // return view('welcome_message');
        return "hello cb $nama , saya berumur $umur";
    }
}
