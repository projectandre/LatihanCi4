<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Detail Komik</h1>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url("/img") . '/' . $komik['sampul']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['judul']; ?></h5>
                            <p class="card-text"><b><?= $komik['penulis']; ?></b></p>
                            <p class="card-text"><small class="text-muted"><b><?= $komik['penerbit']; ?></b></small></p>

                            <a href="<?= base_url('/komik/edit') . '/' . $komik['slug']; ?>" class="btn btn-sm btn-warning"> Edit</a>
                            <a href="<?= base_url('/komik/delete') . '/' . $komik['id']; ?>" class="btn btn-sm btn-danger"> Hapus</a>

                            <form action="<?= base_url('/komik/delete') . '/' . $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <br><br>
                            <a href="<?= base_url('/komik'); ?>">Kembali ke daftar komik</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>