<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'nama' => 'Agung',
            'tes' => [2, 3, 4, 5]
        ];
        echo view('layout/header', $data);
        echo view('pages/home', $data);
        echo view('layout/footer');
    }

    public function about()
    {
        $data = [
            'title' => 'About'
        ];
        echo view('layout/header', $data);
        echo view('pages/about');
        echo view('layout/footer');
    }
}
