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
        echo view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'alamat' => [
                [
                    'tipey' => 'rumah',
                    'alamat' => 'Jl. ABC No.192',
                    'kota' => 'Kobum'
                ],
                [
                    'tipey' => 'kantor',
                    'alamat' => 'Jl. ZA No.12',
                    'kota' => 'Kobum'
                ],
            ]
        ];
        return view('pages/contact', $data);
    }
}
