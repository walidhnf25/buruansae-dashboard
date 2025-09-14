<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container tambah my-5 mb-3">
    <h2 class="label-tambah-data mb-5">Edit Data Kelompok</h2>
    <form class="row g-3 need-validation" action="<?= base_url(); ?>/DataKelompok/update/<?= $kelompok['id_kelompok']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="col-12 mb-3">
            <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('nama_kelompok')) ? 'is-invalid' : ''; ?>" 
                id="nama_kelompok" 
                name="nama_kelompok" 
                value="<?= old('nama_kelompok', $kelompok['nama_kelompok'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('nama_kelompok'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="nama_ketua" class="form-label">Nama Ketua</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('nama_ketua')) ? 'is-invalid' : ''; ?>" 
                id="nama_ketua" 
                name="nama_ketua" 
                value="<?= old('nama_ketua', $kelompok['nama_ketua'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('nama_ketua'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="nomor_kontak" class="form-label">Nomor Kontak</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('nomor_kontak')) ? 'is-invalid' : ''; ?>" 
                id="nomor_kontak" 
                name="nomor_kontak" 
                value="<?= old('nomor_kontak', $kelompok['nomor_kontak'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('nomor_kontak'); ?>
            </div>
        </div>

        <div class="col-md-6">
            <label for="penyuluh" class="form-label">Penyuluh</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('penyuluh')) ? 'is-invalid' : ''; ?>" 
                id="penyuluh" 
                name="penyuluh" 
                value="<?= old('penyuluh', $kelompok['penyuluh'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('penyuluh'); ?>
            </div>
        </div>

        <div class="col-md-6">
            <label for="pendamping" class="form-label">Pendamping</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('pendamping')) ? 'is-invalid' : ''; ?>" 
                id="pendamping" 
                name="pendamping" 
                value="<?= old('pendamping', $kelompok['pendamping'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('pendamping'); ?>
            </div>
        </div>

        <div class="col-md-6">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" 
                id="kecamatan" 
                name="kecamatan" 
                value="<?= old('kecamatan', $kelompok['kecamatan'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('kecamatan'); ?>
            </div>
        </div>

        <div class="col-md-4">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" 
                id="kelurahan" 
                name="kelurahan" 
                value="<?= old('kelurahan', $kelompok['kelurahan'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('kelurahan'); ?>
            </div>
        </div>

        <div class="col-md-2">
            <label for="rw" class="form-label">RW</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ''; ?>" 
                id="rw" 
                name="rw" 
                value="<?= old('rw', $kelompok['rw'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('rw'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="luas_lahan" class="form-label">Luas Lahan (m&sup2;)</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('luas_lahan')) ? 'is-invalid' : ''; ?>" 
                id="luas_lahan" 
                name="luas_lahan" 
                value="<?= old('luas_lahan', $kelompok['luas_lahan'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('luas_lahan'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="status_lahan" class="form-label">Status Kepemilikan Lahan</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('status_lahan')) ? 'is-invalid' : ''; ?>" 
                id="status_lahan" 
                name="status_lahan" 
                value="<?= old('status_lahan', $kelompok['status_lahan'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('status_lahan'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label d-block">Status</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                    type="radio" 
                    name="status_keaktifan" 
                    id="status_aktif" 
                    value="Aktif"
                    <?= old('status_keaktifan', $kelompok['status_keaktifan'] ?? '') == 'Aktif' ? 'checked' : ''; ?>>
                <label class="form-check-label" for="status_aktif">Aktif</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                    type="radio" 
                    name="status_keaktifan" 
                    id="status_tidak_aktif" 
                    value="Tidak Aktif"
                    <?= old('status_keaktifan', $kelompok['status_keaktifan'] ?? '') == 'Tidak Aktif' ? 'checked' : ''; ?>>
                <label class="form-check-label" for="status_tidak_aktif">Tidak Aktif</label>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="keterangan_status" class="form-label">Keterangan Status</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('keterangan_status')) ? 'is-invalid' : ''; ?>" 
                id="keterangan_status" 
                name="keterangan_status" 
                value="<?= old('keterangan_status', $kelompok['keterangan_status'] ?? ''); ?>"
                <?= old('status_keaktifan', $kelompok['status_keaktifan'] ?? '') == 'Tidak Aktif' ? '' : 'disabled'; ?>>
            <div class="invalid-feedback">
                <?= $validation->getError('keterangan_status'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="link_deskripsi" class="form-label">Link Deskripsi</label>
            <input type="text" 
                class="form-control <?= ($validation->hasError('link_deskripsi')) ? 'is-invalid' : ''; ?>" 
                id="link_deskripsi" 
                name="link_deskripsi" 
                value="<?= old('link_deskripsi', $kelompok['link_deskripsi'] ?? ''); ?>" 
                required>
            <div class="invalid-feedback">
                <?= $validation->getError('link_deskripsi'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="foto_lahan" class="form-label">Upload Foto Lahan</label>
            <input type="file" class="form-control <?= ($validation->hasError('foto_lahan')) ? 'is-invalid' : ''; ?>" id="foto_lahan" name="foto_lahan">
            <div class="invalid-feedback">
                <?= $validation->getError('foto_lahan'); ?>
            </div>
        </div>

        <div class="col-12 mb-3">
            <label for="foto_ketua" class="form-label">Upload Foto Ketua</label>
            <input type="file" class="form-control <?= ($validation->hasError('foto_ketua')) ? 'is-invalid' : ''; ?>" id="foto_ketua" name="foto_ketua">
            <div class="invalid-feedback">
                <?= $validation->getError('foto_ketua'); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Edit Data</button>
    </form>
</div>

<?= $this->endSection(); ?>