<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('/komik/create'); ?>" class="btn btn-primary mt-2">Tambah Data</a>
            <h1 class="mt-2">Daftar Komik</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($komik as $k) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><img src="<?= base_url("/img") . '/' . $k['sampul']; ?>" class="sampul" alt=""></td>
                            <td><?= $k['judul']; ?></td>
                            <td><a href="<?= base_url("/komik") . '/' . $k['slug']; ?>" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php
                    endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>