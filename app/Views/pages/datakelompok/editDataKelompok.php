<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Kelompok</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/DataKelompok/update/<?= $kelompok['id_kelompok']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="penyuluh" clases="form-label">Penyuluh</label>
                    <input type="text" class="form-control <?= ($validation->hasError('penyuluh')) ? 'is-invalid' : ''; ?>" id="penyuluh" name="penyuluh" value="<?= (old('penyuluh')) ? old('penyuluh') : $kelompok['penyuluh']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('penyuluh'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pendamping" class="form-label">Pendamping</label>
                    <input type="text" class="form-control <?= ($validation->hasError('pendamping')) ? 'is-invalid' : ''; ?>" id="pendamping" name="pendamping" value="<?= (old('pendamping')) ? old('pendamping') : $kelompok['pendamping']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('pendamping'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" value="<?= (old('kecamatan')) ? old('kecamatan') : $kelompok['kecamatan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('kecamatan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" id="kelurahan" name="kelurahan" value="<?= (old('kelurahan')) ? old('kelurahan') : $kelompok['kelurahan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('kelurahan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="rw" class="form-label">RW</label>
                    <input type="text" class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ''; ?>" id="rw" name="rw" value="<?= (old('rw')) ? old('rw') : $kelompok['rw']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('rw'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_kelompok" class="form-label
                    ">Nama Kelompok</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_kelompok')) ? 'is-invalid' : ''; ?>" id="nama_kelompok" name="nama_kelompok" value="<?= (old('nama_kelompok')) ? old('nama_kelompok') : $kelompok['nama_kelompok']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_kelompok'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>