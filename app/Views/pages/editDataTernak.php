<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Ternak</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataTernak/update/<?= $ternak['id_ternak']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="jenis_ternak" class="form-label">Jenis Ternak</label>
                    <select class="form-select <?= ($validation->hasError('jenis_ternak')) ? 'is-invalid' : ''; ?>" name="jenis_ternak" id="jenis_ternak">
                        <option value="" class="hidden" style="display: none;" >Pilih Jenis Ternak</option>
                        <option disabled>Pilih Jenis Ternak</option>
                        <option value="Ayam Petelur <?php (old('jenis_ternak')==='Ayam Petelur')? 'selected' :'' ; ?>">Ayam Petelur</option>
                        <option value="Kelinci <?php (old('jenis_ternak')==='Kelinci')? 'selected' :'' ; ?>">Kelinci</option>
                        <option value="Ayam Joper <?php (old('jenis_ternak')==='Ayam Joper')? 'selected' :'' ; ?>">Ayam Joper</option>
                        <option value="Bebek <?php (old('jenis_ternak')==='Bebek')? 'selected' :'' ; ?>">Bebek</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_ternak'); ?>
                    </div>
                </div> 
                <div class="mb-3">
                    <label for="waktu_pakan" class="form-label">Waktu Pakan</label>
                    <input type="date" class="form-control <?= ($validation->hasError('waktu_pakan')) ? 'is-invalid' : ''; ?>" id="waktu_pakan" name="waktu_pakan" value="<?= (old('waktu_pakan')) ? old('waktu_pakan') : $ternak['waktu_pakan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('waktu_pakan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_ternak" class="form-label">Jumlah Ternak</label>                
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_ternak')) ? 'is-invalid' : ''; ?>" id="jumlah_ternak" name="jumlah_ternak" value="<?= (old('jumlah_ternak')) ? old('jumlah_ternak') : $ternak['jumlah_ternak']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_ternak'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_pakan" class="form-label">Jumlah Pakan</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_pakan')) ? 'is-invalid' : ''; ?>" id="jumlah_pakan" name="jumlah_pakan" value="<?= (old('jumlah_pakan')) ? old('jumlah_pakan') : $ternak['jumlah_pakan']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('jumlah_pakan'); ?>
                    </div>
                </div>    
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataTernak" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>