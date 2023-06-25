<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel  extends Model
{
    protected $table = 'tabel_user'; // Ganti "nama_tabel" dengan nama tabel yang sesuai

    protected $allowedFields = ['nama', 'kelas']; // Daftar kolom yang diizinkan untuk dimasukkan (nama kolom dalam array)

    // Fungsi untuk memasukkan data ke database
    public function insertData($data)
    {
        return $this->insert($data);
    }
}
