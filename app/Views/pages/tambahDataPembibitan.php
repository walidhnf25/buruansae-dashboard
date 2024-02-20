<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Bibit</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataPembibitan/save" method="post">
                <?= csrf_field(); ?> 
                <div class="mb-3">
                    <label for="tanggal_pembibitan" class="form-label">Tanggal Pembibitan</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_pembibitan')) ? 'is-invalid' : ''; ?>" id="tanggal_pembibitan" name="tanggal_pembibitan">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_pembibitan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kategori_pembibitan" class="form-label">Kategori Pembibitan</label>                
                    <select class="form-select <?= ($validation->hasError('kategori_pembibitan')) ? 'is-invalid' : ''; ?>" name="kategori_pembibitan" id="kategori_pembibitan">
                        <option value="" class="hidden" style="display: none;" >Pilih Sayur</option>
                        <option disabled>Pilih Sayur</option>
                        <option value="Albasiah">Albasiah</option>
                        <option value="Kangkung">Kangkung</option>
                        <option value="Sawi">Sawi</option>
                        <option value="Bayam">Bayam</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('kategori_pembibitan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tipe_tumbuhan" class="form-label">Tipe Tumbuhan</label>
                    <input hidden type="text" class="form-control <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>" id="tipe_tumbuhan" name="tipe_tumbuhan">
                    <div class="radio">                
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio1" name="tipe_tumbuhan" value="Benih">
                            <label class="form-check-label" for="radio1">Benih</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input <?= ($validation->hasError('tipe_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio2" name="tipe_tumbuhan" value="Bibit">
                            <label class="form-check-label" for="radio2">Bibit</label>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tipe_tumbuhan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_pembibitan" class="form-label">Jumlah Pembibitan</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_pembibitan')) ? 'is-invalid' : ''; ?>" id="jumlah_pembibitan" name="jumlah_pembibitan">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_pembibitan'); ?>
                    </div>
                </div>    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="http://localhost:8080/dataPembibitan" class="btn btn-secondary" type="button">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>