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
                    <input type="text" class="form-control <?= ($validation->hasError('jenis_pengolahan')) ? 'is-invalid' : ''; ?>" id="jenis_pengolahan" name="jenis_pengolahan" value="<?= (old('jenis_pengolahan')) ? old('jenis_pengolahan') : $sampah['jenis_pengolahan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_pengolahan'); ?>
                    </div>
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