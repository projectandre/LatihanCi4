<?php

namespace App\Controllers;

use App\Models\DataModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class Data extends Controller
{
    public function index()
    {
        return view('map');
    }

    public function bsmap()
    {
        return view('base_map');
    }
}
