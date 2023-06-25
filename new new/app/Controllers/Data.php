<?php

namespace App\Controllers;

use App\Models\DataModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class Data extends Controller
{
    public function index()
    {
        return view('tampil_home');
    }

    public function lempar()
    {

        $model = new DataModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas')
        ];
        $model->insertData($data);

        return redirect()->to('/Data::index')->with('success', 'Data berhasil disimpan.');
    }
}
