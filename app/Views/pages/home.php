<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<title><?= $tittle ?></title>


    <header class="banner">
        <div class="teksbanner">
            <h2>Selamat Datang</h2>
            <h3>Di Halaman BURUAN SAE</h3>
            <h4>BURUAN SAE gerakan urban farming terintegrasi dari Dinas Ketahanan Pangan dan Pertanian Kota Bandung</h4>
        </div>
    </header>

    <section class="catalogs">
        <div class="catalog card">
            <?php if ($jumlahSayur > 0) : ?>
                <span class="badge-count"><?= $jumlahSayur; ?></span>
            <?php endif; ?>
            <img src="asset/sayur.jpg" class="card-img-top" alt="asset/sayur.jpg">
            <h5 class="text-center mt-2 mb-3">Data Sayur</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataSayur" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahTanamanObat > 0) : ?>
                <span class="badge-count"><?= $jumlahTanamanObat; ?></span>
            <?php endif; ?>
            <img src="asset/tanaman herbal.jpg" class="card-img-top" alt="asset/tanaman herbal.jpg" >
            <h5 class="text-center mt-2 mb-3">Data Tanaman Obat</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataTanamanObat" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahBuah > 0) : ?>
                <span class="badge-count"><?= $jumlahBuah; ?></span>
            <?php endif; ?>
            <img src="asset/buah.jpg" class="card-img-top" alt="asset/buah.jpg">
            <h5 class="text-center mt-2 mb-3">Data Buah</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataBuah" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahTernak > 0) : ?>
                <span class="badge-count"><?= $jumlahTernak; ?></span>
            <?php endif; ?>
            <img src="asset/ternak.jpg" class="card-img-top" alt="asset/ternak.jpg" >
            <h5 class="text-center mt-2 mb-3">Data Ternak</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataTernak" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahIkan > 0) : ?>
                <span class="badge-count"><?= $jumlahIkan; ?></span>
            <?php endif; ?>
            <img src="asset/ikan.jpg" class="card-img-top" alt="asset/ikan.jpg" >
            <h5 class="text-center mt-2 mb-3">Data Ikan</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataIkan" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahOlahanHasil > 0) : ?>
                <span class="badge-count"><?= $jumlahOlahanHasil; ?></span>
            <?php endif; ?>
            <img src="asset/banana chips2.jpg" class="card-img-top" alt="asset/ikan.jpg" >
            <h5 class="text-center mt-2 mb-3">Data Olahan Hasil</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataOlahanHasil" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahOlahanSampah > 0) : ?>
                <span class="badge-count"><?= $jumlahOlahanSampah; ?></span>
            <?php endif; ?>
            <img src="asset/olahan sampah.jpg" class="card-img-top" alt="asset/olahan sampah.jpg" >
            <h5 class="text-center mt-2 mb-3">Data Olahan Sampah</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataPengolahanSampah" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog card">
            <?php if ($jumlahBibit > 0) : ?>
                <span class="badge-count"><?= $jumlahBibit; ?></span>
            <?php endif; ?>
            <img src="asset/bibit.jpg" class="card-img-top" alt="asset/bibit.jpg" >
            <h5 class="text-center mt-2 mb-3">Data Bibit</h4>
            <div class="d-grid gap-2 col-8 mx-auto mt-5 mb-3">
                <a href="dataPembibitan" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
    </section>
    
<?= $this->endSection(); ?>