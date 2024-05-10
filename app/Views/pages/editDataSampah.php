<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Sampah</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataPengolahanSampah/update/<?= $sampah['id_data_sampah']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>" id="tanggal_masuk" name="tanggal_masuk" value="<?= (old('tanggal_masuk')) ? old('tanggal_masuk') : $sampah['tanggal_masuk']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_masuk'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jenis_pengolahan" class="form-label">Jenis Pengolahan</label>
                    <select class="form-select <?= ($validation->hasError('jenis_pengolahan')) ? 'is-invalid' : ''; ?>" name="jenis_pengolahan" id="jenis_pengolahan">
                        <option value="" class="hidden" style="display: none;">Pilih Olahan Sampah</option>
                        <?php foreach ($komoditi as $k) : ?>
                            <option value="<?= $k['nama_komoditi'] ?>" <?= old('jenis_pengolahan') == $k['nama_komoditi'] ? 'selected' : ''; ?>><?= $k['nama_komoditi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_pengolahan'); ?>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_kelompok" class="form-label">Assign Tugas Kelompok</label>
                    <select name="id_kelompok" class="form-select">
                        <option value="" style="display: none;" class="hidden" disabled>--Pilih Nama Kelompok--</option>
                        <?php foreach ($kelompok as $key => $value) { ?>
                            <option value="<?php echo $value['id_kelompok']; ?>" data-penyuluh="<?php echo $value['penyuluh']; ?>" data-pendamping="<?php echo $value['pendamping']; ?>" data-kecamatan="<?php echo $value['kecamatan']; ?>" data-kelurahan="<?php echo $value['kelurahan']; ?>" <?php echo old('id_kelompok', $sampah['id_kelompok']) == $value['id_kelompok'] ? 'selected' : ''; ?>><?php echo $value['nama_kelompok']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3 form-group">
                    <label for="penyuluh">Penyuluh</label>
                    <input type="text" name="penyuluh" id="penyuluh" class="form-control" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="pendamping">Pendamping</label>
                    <input type="text" name="pendamping" id="pendamping" class="form-control" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan" class="form-control" readonly>
                </div>
                <div class="mb-3 form-group">
                    <label for="kelurahan">Kelurahan</label>
                    <input type="text" name="kelurahan" id="kelurahan" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah_sampah" class="form-label">Jumlah Sampah</label>
                    <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_sampah')) ? 'is-invalid' : ''; ?>" id="jumlah_sampah" name="jumlah_sampah" value="<?= (old('jumlah_sampah')) ? old('jumlah_sampah') : $sampah['jumlah_sampah']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_sampah'); ?>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataPengolahanSampah" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>