<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container tambah my-5 mb-3">
    <h2 class="label-tambah-data mb-5">Edit Data Komoditi</h2>
    <form class="col g-3 need-validation" novalidate action="<?php base_url();  ?> /DataKomoditi/update/<?= $komoditi['id_komoditi']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="col form-group mb-2">
            <label for="nama_komoditi" class="form-label">Nama Komoditi</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_komoditi')) ? 'is-invalid' : ''; ?>" id="nama_komoditi" name="nama_komoditi" value="<?= old('nama_komoditi', $komoditi['nama_komoditi']) ?>" required>
            <div class="invalid-feedback">
                <?= $validation->getError('nama_komoditi'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="sektor" class="form-label">Sektor</label>
            <select class="form-select <?= ($validation->hasError('sektor')) ? 'is-invalid' : ''; ?>" id="sektor" name="sektor" required>
                <option selected>Choose...</option>
                <option value="PERTANIAN" <?= old('sektor', $komoditi['sektor']) == 'PERTANIAN' ? 'selected' : '' ?>>PERTANIAN</option>
                <option value="PETERNAKAN" <?= old('sektor', $komoditi['sektor']) == 'PETERNAKAN' ? 'selected' : '' ?>>PETERNAKAN</option>
                <option value="PERIKANAN" <?= old('sektor', $komoditi['sektor']) == 'PERIKANAN' ? 'selected' : '' ?>>PERIKANAN</option>
                <option value="OLAHAN SAMPAH" <?= old('sektor', $komoditi['sektor']) == 'OLAHAN SAMPAH' ? 'selected' : '' ?>>OLAHAN SAMPAH</option>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('sektor'); ?>
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control <?= ($validation->hasError('start_date')) ? 'is-invalid' : ''; ?>" id="start_date" name="start_date" value="<?= old('start_date') ? old('start_date') : $komoditi['start_date']; ?>" required>
            <div class="invalid-feedback">
                <?= $validation->getError('start_date'); ?>
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control <?= ($validation->hasError('end_date')) ? 'is-invalid' : ''; ?>" id="end_date" name="end_date" value="<?= old('end_date') ? old('end_date') : $komoditi['end_date']; ?>" required>
            <div class="invalid-feedback">
                <?= $validation->getError('end_date'); ?>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
            <a href="<?= base_url(); ?>/DataKomoditi" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>