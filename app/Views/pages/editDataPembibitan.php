<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Pembibitan</h2>
        <div class="col-12">
            <form action="/dataPembibitan/update/<?= $bibit['id_bibit']; ?>" method="post">
                <?= csrf_field(); ?> 
                <div class="mb-3">
                    <label for="tanggal_pembibitan" class="form-label">Tanggal Pembibitan</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_pembibitan')) ? 'is-invalid' : ''; ?>" id="tanggal_pembibitan" name="tanggal_pembibitan" value="<?= (old('tanggal_pembibitan')) ? old('tanggal_pembibitan') : $bibit['tanggal_pembibitan']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_pembibitan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kategori_pembibitan" class="form-label">Kategori Pembibitan</label>                
                    <select class="form-select <?= ($validation->hasError('kategori_pembibitan')) ? 'is-invalid' : ''; ?>" name="kategori_pembibitan" id="kategori_pembibitan">
                        <option value="" class="hidden" style="display: none;" >Pilih Sayur</option>
                        <option disabled>Pilih Sayur</option>
                        <option value="Albasiah <?php (old('kategori_pembibitan')==='Albasiah')? 'selected' :'' ; ?>">Albasiah</option>
                        <option value="Kangkung <?php (old('kategori_pembibitan')==='Kangkung')? 'selected' :'' ; ?>">Kangkung</option>
                        <option value="Sawi <?php (old('kategori_pembibitan')==='Sawi')? 'selected' :'' ; ?>">Sawi</option>
                        <option value="Bayam <?php (old('kategori_pembibitan')==='Bayam')? 'selected' :'' ; ?>">Bayam</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('kategori_pembibitan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tipe_tumbuhan" class="form-label">Tipe Tumbuhan</label>
                    <div class="radio">                
                    <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio1" name="tipe_tumbuhan" value="Benih <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>">
                    <label class="form-check-label" for="radio1">Benih</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio2" name="tipe_tumbuhan" value="Bibit <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>">
                    <label class="form-check-label" for="radio2">Bibit</label>
                    </div>
                </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tipe_tumbuhan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_pembibitan" class="form-label">Jumlah Pembibitan</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_pembibitan')) ? 'is-invalid' : ''; ?>" id="jumlah_pembibitan" name="jumlah_pembibitan" value="<?= (old('jumlah_pembibitan')) ? old('jumlah_pembibitan') : $bibit['jumlah_pembibitan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_pembibitan'); ?>
                    </div>
                </div>    
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataPembibitan" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>