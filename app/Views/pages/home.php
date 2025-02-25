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
        <div class="catalog">
            <img src="asset/sayur.jpg" class="card-img-top" alt="asset/sayur.jpg">
            <h4 class="text-center mt-2 mb-3">Data Sayur</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataSayur" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog">
            <img src="asset/tanaman herbal.jpg" class="card-img-top" alt="asset/tanaman herbal.jpg" >
            <h4 class="text-center mt-2 mb-3">Data Tanaman Obat</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataTanamanObat" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog">
            <img src="asset/buah.jpg" class="card-img-top" alt="asset/buah.jpg">
            <h4 class="text-center mt-2 mb-3">Data Buah</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataBuah" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog">
            <img src="asset/ternak.jpg" class="card-img-top" alt="asset/ternak.jpg" >
            <h4 class="text-center mt-2 mb-3">Data Ternak</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataTernak" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog">
            <img src="asset/ikan.jpg" class="card-img-top" alt="asset/ikan.jpg" >
            <h4 class="text-center mt-2 mb-3">Data Ikan</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataIkan" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog">
            <img src="asset/banana chips2.jpg" class="card-img-top" alt="asset/banana chips2.jpg">
            <h4 class="text-center mt-2 mb-3">Data Olahan Hasil</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataOlahanHasil" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
        <div class="catalog">
            <img src="asset/olahan sampah.jpg" class="card-img-top" alt="asset/olahan sampah.jpg" >
            <h4 class="text-center mt-2 mb-3">Data Olahan Sampah</h4>
            <div class="d-grid gap-2 col-6 mx-auto mt-5 mb-3">
                <a href="dataPengolahanSampah" class="btn btn-primary" type="button">Input Data</a>
            </div>
        </div>
    </section>
    
<?= $this->endSection(); ?>