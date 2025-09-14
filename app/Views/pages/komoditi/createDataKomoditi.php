<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container tambah my-5 mb-3">
    <h2 class="label-tambah-data mb-5">Tambah Data Komoditi</h2>
    <form class="col g-3 need-validation" novalidate action="<?php base_url();  ?> /DataKomoditi/save" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col form-group mb-2">
            <label for="nama_komoditi" class="form-label">Nama Komoditi</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_komoditi')) ? 'is-invalid' : ''; ?>" id="nama_komoditi" name="nama_komoditi" required>
            <div class="invalid-feedback">
                <?= $validation->getError('nama_komoditi'); ?>
            </div>
        </div>
        <div class="col form-group mb-2">
            <div class="form-group">
                <label for="sektor" class="form-label">Sektor</label>
                <select class="form-select <?= ($validation->hasError('sektor')) ? 'is-invalid' : ''; ?>" id="sektor" name="sektor" required>
                    <option selected>Choose...</option>
                    <option value="SAYUR">SAYUR</option>
                    <option value="TANAMAN OBAT">TANAMAN OBAT</option>
                    <option value="TERNAK">TERNAK</option>
                    <option value="IKAN">IKAN</option>
                    <option value="BUAH">BUAH</option>
                    <option value="OLAHAN HASIL">OLAHAN HASIL</option>
                    <option value="OLAHAN SAMPAH">OLAHAN SAMPAH</option>
                    <option value="OLAHAN Bibit">Bibit</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('sektor'); ?>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <label for="durasi_tanam" class="form-label">Durasi Tanam</label>
            <div class="input-group">
                <input type="number" min=1 class="form-control" id="durasi_tanam" placeholder="Masukkan Durasi Tanam" <?= ($validation->hasError('durasi_tanam')) ? 'is-invalid' : ''; ?>" id="durasi_tanam" name="durasi_tanam">
                <div class="invalid-feedback">
                    <?= $validation->getError('durasi_tanam'); ?>
                </div>
                <span class="input-group-text" id="basic-addon2">Hari</span>
            </div>
        </div>
        <div class="col mb-2">
            <label for="gambar" class="col-sm-2 col-form-label">Upload Foto Komoditi</label>
            <div class="col-sm-12">
                <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar">
                <div class="invalid-feedback">
                    <?= $validation->getError('gambar'); ?>
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
            <a href="<?= base_url('DataKomoditi'); ?>" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>