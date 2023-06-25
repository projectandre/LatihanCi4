<?php

namespace App\Controllers;

use App\Models\KomikModel;
use Config\Services;


class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $komik = $this->komikModel->getKomik();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $komik
        ];

        // cara konek db tanpa model

        // $db = \config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row) {
        //     d($row);
        // }

        // pake model

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan.');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Komik',
            'validation' => \Config\Services::validation()
        ];
        return view('komik/create', $data);
    }

    public function save()
    {


        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus di isi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_unique[komik.penerbit]',
                'errors' => [
                    'required' => '{field} komik harus di isi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }

        // dd($this->request->getVar());
        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // nama acak
            $namaSampul = $fileSampul->getRandomName();

            //pindah file ke folder
            $fileSampul->move('img', $namaSampul);
        }



        // ambil nama
        // $namaSampul = $fileSampul->getName();

        // true biar kecil semua
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambah');


        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $komik = $this->komikModel->find($id);

        // cek jika default gambar

        if ($komik['sampul'] != 'default.png') {
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');

        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];
        return view('komik/edit', $data);
    }

    public function update($id)
    {
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus di isi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus di isi.',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} komik harus di bawah 1 mb.',
                    'mime_in' => '{field} harus di isi gambar ekstensi jpg jpeg png.',
                    'is_image' => '{field} harus di isi gambar ekstensi jpg jpeg png.',

                ]

            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            // return redirect()->to('/komik/edit/' . $this->request->getVar('slug'));
            $errors = [
                'sampul' => $validation->getError('sampul'),
            ];
            // Lakukan sesuatu dengan daftar error, seperti meneruskannya ke view
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('errors', $errors);
        }

        // dd($this->request->getFile('sampul'));

        // ambil gambar 
        $fileSampul = $this->request->getFile('sampul');

        // ambil gambar apakahh berubah ?

        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // nama acak
            $namaSampul = $fileSampul->getRandomName();

            //pindah file ke folder
            $fileSampul->move('img', $namaSampul);

            // hapus
            unlink('img/' . $this->request->getVar('sampulLama'));
        }



        // ambil nama
        // $namaSampul = $fileSampul->getName();

        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');


        return redirect()->to('/komik');
    }
}
