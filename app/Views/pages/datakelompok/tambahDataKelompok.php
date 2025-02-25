<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5 mb-3">
    <h2 class="label-tambah-data mb-5">Tambah Data Kelompok</h2>
    <form class="row g-3 need-validation" novalidate action="<?php base_url();  ?> /DataKelompok/save" method="post">
        <?= csrf_field(); ?>
        <div class="col-md-6">
            <label for="penyuluh" class="form-label">Tambahkan Penyuluh</label>
            <input type="text" class="form-control <?= ($validation->hasError('penyuluh')) ? 'is-invalid' : ''; ?>" id="penyuluh" name="penyuluh" required>
            <div class="invalid-feedback">
                <?= $validation->getError('penyuluh'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="pendamping" class="form-label">Tambahkan Pedamping</label>
            <input type="text" class="form-control <?= ($validation->hasError('pendamping')) ? 'is-invalid' : ''; ?>" id="pendamping" name="pendamping" required>
            <div class="invalid-feedback">
                <?= $validation->getError('pendamping'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" required>
            <div class="invalid-feedback">
                <?= $validation->getError('kecamatan'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <input type="text" class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" id="kelurahan" name="kelurahan" required>
            <div class="invalid-feedback">
                <?= $validation->getError('kelurahan'); ?>
            </div>
        </div>
        <div class="col-md-2">
            <label for="rw" class="form-label">RW</label>
            <input type="text" class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ''; ?>" id="rw" name="rw" required>
            <div class="invalid-feedback">
                <?= $validation->getError('rw'); ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="map" class="form-label">Tambahkan Link Alamat</label>
            <input type="text" class="form-control <?= ($validation->hasError('map')) ? 'is-invalid' : ''; ?>" id="map" name="map" required>
            <div class="invalid-feedback">
                <?= $validation->getError('map'); ?>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="nama_kelompok" class="form-label">Insert Nama Kelompok</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_kelompok')) ? 'is-invalid' : ''; ?>" id="nama_kelompok" name="nama_kelompok" required>
            <div class="invalid-feedback">
                <?= $validation->getError('nama_kelompok'); ?>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
            <a href="<?= base_url(); ?>/DataKelompok" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>