<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-Data mb-3">Tambah Data Tanaman Obat</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataTanamanObat/save" method="post">
            <?= csrf_field(); ?>
                <div class="mb-3">
                <label for="nama_tanaman_obat" class="form-label">Nama Tanaman Obat</label>
                <select class="form-select <?= ($validation->hasError('nama_tanaman_obat')) ? 'is-invalid' : ''; ?>" name="nama_tanaman_obat" id="nama_tanaman_obat">
                        <option value="" class="hidden" style="display: none;" >Pilih Tanaman</option>
                        <option disabled>Pilih Tanaman Obat</option>
                        <option value="Daun Dewa">Daun Dewa</option>
                        <option value="Sereh">Sereh</option>
                        <option value="Jahe">Jahe</option>
                        <option value="Kayu Manis">Kayu Manis</option>
                        <option value="Kencur">Kencur</option>
                        <option value="Lengkuas">Lengkuas</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_tanaman_obat'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_tanam')) ? 'is-invalid' : ''; ?>" id="tanggal_tanam" name="tanggal_tanam">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_tanam'); ?>
                    </div>
                </div>
                <div class="mb-3">
                <label for="kategori_tumbuhan" class="form-label">Kategori Tumbuhan</label>                
                    <input hidden type="text" class="form-control <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="kategori_tumbuhan" name="kategori_tumbuhan">
                <div class="radio">                
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio1" name="kategori_tumbuhan" value="Benih">
                        <label class="form-check-label" for="radio1">Benih</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio2" name="kategori_tumbuhan" value="Bibit">
                        <label class="form-check-label" for="radio2">Bibit</label>
                    </div>
                </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('kategori_tumbuhan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_tanam" class="form-label">Jumlah Tanam</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_tanam')) ? 'is-invalid' : ''; ?>" id="jumlah_tanam" name="jumlah_tanam">
                    <div class="invalid-feedback">
                    <?= $validation->getError('jumlah_tanam'); ?>
                    </div>
                </div>  
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="<?= base_url(); ?>/dataTanamanObat" class="btn btn-secondary" type="button">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>       
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>