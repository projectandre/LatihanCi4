<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Contact</h1>
            <?php foreach ($alamat as $alm) : ?>
                <ul>
                    <li><?= $alm['tipey']; ?></li>
                    <li><?= $alm['alamat']; ?></li>
                    <li><?= $alm['kota']; ?></li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>