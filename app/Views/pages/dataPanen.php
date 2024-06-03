<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
    <div class="tittle">
        <h1 class="label-tambah-data my-5">Data Panen</h1>
    </div>

<div class="container data-panen mb-5">
    <div class="nav-tabel">
        <ul class="nav nav-tabs">
            <li class="nav-item btn1">
                <a class="nav-link" href="#">Sayur</a>
            </li>
            <li class="nav-item btn2">
                <a class="nav-link" href="#">Tanaman Obat</a>
            </li>
            <li class="nav-item btn3 ">
                <a class="nav-link" href="#">Ternak</a>
            </li>
            <li class="nav-item btn4">
                <a class="nav-link" href="#">Ikan</a>
            </li>
            <li class="nav-item btn5">
                <a class="nav-link" href="#">Buah</a>
            </li>
            <li class="nav-item btn6">
                <a class="nav-link" href="#">Olahan Hasil</a>
            </li>
            <li class="nav-item btn7">
                <a class="nav-link" href="#">Sampah</a>
            </li>
        </ul>
    </div>

    <section class="tab-active" id="table-sayur">      
        <table id="tablePanensayur" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Kelompok</th>
            <th scope="col">Waktu Tanam</th>
            <th scope="col">Waktu Panen</th>
            <th scope="col">Nama Sayur</th>
            <th scope="col">Kategori Tumbuhan</th>
            <th scope="col">Jumlah Panen (Kg)</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Rp)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_sayur as $sayur) :
                if($sayur['waktu_panen'] != null){ ?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $sayur['nama_kelompok']; ?></td>
            <td><?= $sayur['tanggal_tanam']; ?></td>
            <td><?= $sayur['waktu_panen']; ?></td>
            <td><?= $sayur['nama_sayur']; ?></td>
            <td><?= $sayur['kategori_tumbuhan']; ?></td>
            <td><?= $sayur['jumlah_panen']; ?></td>
            <td><?= $sayur['konsumsi_lokal_kg']; ?></td>
            <td><?= $sayur['jumlah_jual']; ?></td>
            <td><?= $sayur['harga_jual']; ?></td>
            <td><?= $sayur['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $sayur['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
            
            <?php 
            }   
            endforeach; ?>
        </tbody>
        </table>
    </section>
    <section class="tab" id="table-tanamanObat">
        <table id="tablePanenobat" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Kelompok</th>
            <th scope="col">Waktu Tanam</th>
            <th scope="col">Waktu Panen</th>
            <th scope="col">Nama Tanaman Obat</th>
            <th scope="col">Kategori Tumbuhan</th>
            <th scope="col">Jumlah Panen (Kg)</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Rp)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data_tanaman_obat as $obat) :
                if($obat['waktu_panen'] != null){ ?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $obat['nama_kelompok']; ?></td>
            <td><?= $obat['tanggal_tanam']; ?></td>
            <td><?= $obat['waktu_panen']; ?></td>
            <td><?= $obat['nama_tanaman_obat']; ?></td>
            <td><?= $obat['kategori_tumbuhan']; ?></td>
            <td><?= $obat['jumlah_panen']; ?></td>
            <td><?= $obat['konsumsi_lokal_kg']; ?></td>
            <td><?= $obat['jumlah_jual']; ?></td>
            <td><?= $obat['harga_jual']; ?></td>
            <td><?= $obat['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $obat['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
            <?php 
            }   
            endforeach; ?>
        </tbody>
        </table>
    </section>
    <section class="tab" id="table-ternak">
        <table id="tablePanenternak" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Waktu Pakan</th>
            <th scope="col">Waktu Panen</th>
            <th scope="col">Jenis Ternak</th>
            <th scope="col">Jumlah (Kg)</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Rp)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($ternak as $ternak) :
            if ($ternak['waktu_panen'] != null) {?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $ternak['waktu_pakan']; ?></td>
            <td><?= $ternak['waktu_panen']; ?></td>
            <td><?= $ternak['jenis_ternak']; ?></td>
            <td><?= $ternak['jumlah_panen']; ?></td>
            <td><?= $ternak['konsumsi_lokal_kg']; ?></td>
            <td><?= $ternak['jumlah_jual']; ?></td>
            <td><?= $ternak['harga_jual']; ?></td>
            <td><?= $ternak['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $ternak['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
        <?php 
        }
        endforeach; ?>
        </tbody>
        </table>
    </section>
    <section class="tab" id="table-ikan">
        <table id="tablePanenikan" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Waktu Pakan</th>
            <th scope="col">Waktu Panen</th>
            <th scope="col">Jenis Ikan</th>
            <th scope="col">Jumlah (Kg)</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Kg)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($ikan as $ikan) :
            if ($ikan['waktu_panen'] != null) {?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $ikan['waktu_pakan']; ?></td>
            <td><?= $ikan['waktu_panen']; ?></td>
            <td><?= $ikan['jenis_ikan']; ?></td>
            <td><?= $ikan['jumlah_panen']; ?></td>
            <td><?= $ikan['konsumsi_lokal_kg']; ?></td>
            <td><?= $ikan['jumlah_jual']; ?></td>
            <td><?= $ikan['harga_jual']; ?></td>
            <td><?= $ikan['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $ikan['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
        <?php 
        } 
        endforeach; ?>
        </tbody>
        </table>
    </section>
    <section class="tab" id="table-buah">
        <table id="tablePanenbuah" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Waktu Tanam</th>
            <th scope="col">Waktu Panen</th>
            <th scope="col">Nama Buah</th>
            <th scope="col">Kategori Tumbuhan</th>
            <th scope="col">Jumlah Panen (Kg)</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Rp)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($buah as $buah) : 
                if ($buah['waktu_panen'] != null) {?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $buah['tanggal_tanam']; ?></td>
            <td><?= $buah['waktu_panen']; ?></td>
            <td><?= $buah['nama_buah']; ?></td>
            <td><?= $buah['kategori_tumbuhan']; ?></td>
            <td><?= $buah['jumlah_panen']; ?></td>
            <td><?= $buah['konsumsi_lokal_kg']; ?></td>
            <td><?= $buah['jumlah_jual']; ?></td>
            <td><?= $buah['harga_jual']; ?></td>
            <td><?= $buah['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $buah['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
            <?php 
            }
            endforeach; ?>        
        </tbody>
        </table>
    </section>
    <section class="tab" id="table-olahanHasil">
        <table id="tablePanenolahan" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Tanggal Produksi</th>
            <th scope="col">Tanggal Penjualan</th>
            <th scope="col">Jenis Olahan</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Rp)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($olahan_hasil as $olahan) :
            if ($olahan['waktu_jual'] != null) {?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $olahan['tanggal_produksi']; ?></td>
            <td><?= $olahan['waktu_jual']; ?></td>
            <td><?= $olahan['jenis_olahan']; ?></td>
            <td><?= $olahan['konsumsi_lokal_kg']; ?></td>
            <td><?= $olahan['jumlah_jual']; ?></td>
            <td><?= $olahan['harga_jual']; ?></td>
            <td><?= $olahan['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $olahan['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
        <?php } endforeach; ?>
        </tbody>
        </table>
    </section>
    <section class="tab" id="table-sampah">
        <table id="tablePanensampah" class="table table-bordered table-hover w-100">
        <thead class="table-dark">
            <tr class="align-middle">
            <th scope="col">No</th>
            <th scope="col">Tanggal Masuk</th>
            <th scope="col">Waktu Sebaran</th>
            <th scope="col">Jenis Pengolahan</th>
            <th scope="col">Komsumsi Lokal (Kg)</th>
            <th scope="col">Jumlah Jual (Kg)</th>
            <th scope="col">Total Harga Jual (Rp)</th>
            <th scope="col">Lokasi Pembeli</th>
            <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($sampah as $sampah) :
        if ($sampah['waktu_sebaran'] != null) {?>
            <tr class="align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $sampah['tanggal_masuk']; ?></td>
            <td><?= $sampah['waktu_sebaran']; ?></td>
            <td><?= $sampah['jenis_pengolahan']; ?></td>
            <td><?= $sampah['penggunaan_lokal']; ?></td>
            <td><?= $sampah['jumlah_jual']; ?></td>
            <td><?= $sampah['harga_jual']; ?></td>
            <td><?= $sampah['lokasi_pembeli']; ?></td>
            <td><img src="/asset/<?= $sampah['gambar']; ?>" class="gambar-panen" alt=""></td>
            </tr>
        <?php } endforeach; ?>
        </tbody>
        </table>
    </section>
</div>

<script src="script.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace()
</script>



<?= $this->endSection(); ?>