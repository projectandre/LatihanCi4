<div class="container">
    <div class="row">
        <div class="col">
            <h1>Home <?= $nama; ?></h1>



            <h2>Array <?= $tes[2]; ?></h2>

            <?php foreach ($tes as $t) : ?>

                <?= $t; ?>

            <?php endforeach; ?>

            <!-- cek data tanpa die -->
            <?php d($tes) ?>
            <!-- cek data dengan die -->
            <?php dd($tes) ?>

        </div>
    </div>
</div>