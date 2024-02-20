<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Ikan</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataIkan/update/<?= $ikan['id_ikan']; ?>" method="post">
            <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="jenis_ikan" class="form-label">Jenis Ikan</label>
                    <select class="form-select <?= ($validation->hasError('jenis_ikan')) ? 'is-invalid' : ''; ?>" name="jenis_ikan" id="jenis_ikan">
                        <option value="" class="hidden" style="display: none;" >Pilih Jenis Ikan</option>
                        <option disabled>Pilih Jenis Ikan</option>
                        <option value="Lele <?php (old('jenis_ikan')==='Lele')? 'selected' :'' ; ?>">Lele</option>
                        <option value="Nila <?php (old('jenis_ikan')==='Nila')? 'selected' :'' ; ?>">Nila</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_ikan'); ?>
                    </div>
                </div> 
                <div class="mb-3">
                    <label for="waktu_pakan" class="form-label">Waktu Pakan</label>
                    <input type="date" class="form-control <?= ($validation->hasError('waktu_pakan')) ? 'is-invalid' : ''; ?>" id="waktu_pakan" name="waktu_pakan" value="<?= (old('waktu_pakan')) ? old('waktu_pakan') : $ikan['waktu_pakan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('waktu_pakan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_ikan" class="form-label">Jumlah Ikan</label>                
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_ikan')) ? 'is-invalid' : ''; ?>" id="jumlah_ikan" name="jumlah_ikan" value="<?= (old('jumlah_ikan')) ? old('jumlah_ikan') : $ikan['jumlah_ikan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_ikan'); ?>
                    </div>       
                </div>
                <div class="mb-3">
                    <label for="jumlah_pakan" class="form-label">Jumlah Pakan</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_pakan')) ? 'is-invalid' : ''; ?>" id="jumlah_pakan" name="jumlah_pakan" value="<?= (old('jumlah_pakan')) ? old('jumlah_pakan') : $ikan['jumlah_pakan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_pakan'); ?>
                    </div>
                </div>    
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataIkan" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>