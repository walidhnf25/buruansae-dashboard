<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Tanaman Obat</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataTanamanObat/update/<?= $obat['id_tanaman_obat']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_tanaman_obat" value="<?= $obat['id_tanaman_obat'] ?>">
                <div class="mb-3">
                    <label for="nama_tanaman_obat" class="form-label">Nama Tanaman Obat</label>
                    <select class="form-select <?= ($validation->hasError('nama_tanaman_obat')) ? 'is-invalid' : ''; ?>" name="nama_tanaman_obat" id="nama_tanaman_obat">
                        <option value="" class="hidden" style="display: none;">Pilih Tanaman</option>
                        <option disabled>Pilih Tanaman Obat</option>
                        <option value="Daun Dewa <?php (old('nama_tanaman_obat') === 'Daun Dewa') ? 'selected' : ''; ?>">Daun Dewa</option>
                        <option value="Sereh <?php (old('nama_tanaman_obat') === 'Sereh') ? 'selected' : ''; ?>">Sereh</option>
                        <option value="Jahe <?php (old('nama_tanaman_obat') === 'Jahe') ? 'selected' : ''; ?>">Jahe</option>
                        <option value="Kayu Manis <?php (old('nama_tanaman_obat') === 'Kayu Manis') ? 'selected' : ''; ?>">Kayu Manis</option>
                        <option value="Kencur <?php (old('nama_tanaman_obat') === 'Kencur') ? 'selected' : ''; ?>">Kencur</option>
                        <option value="Lengkuas <?php (old('nama_tanaman_obat') === 'Lengkuas') ? 'selected' : ''; ?>">Lengkuas</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_tanaman_obat'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_tanam')) ? 'is-invalid' : ''; ?>" id="tanggal_tanam" name="tanggal_tanam" value="<?= (old('tanggal_tanam')) ? old('tanggal_tanam') : $obat['tanggal_tanam']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_tanam'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kategori_tumbuhan" class="form-label">Kategori Tumbuhan</label>
                    <div class="radio">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio1" name="kategori_tumbuhan" value="Benih ">
                            <label class="form-check-label" for="radio1">Benih</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio2" name="kategori_tumbuhan" value="Bibit ">
                            <label class="form-check-label" for="radio2">Bibit</label>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('kategori_tumbuhan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_tanam" class="form-label">Jumlah Tanam</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_tanam')) ? 'is-invalid' : ''; ?>" id="jumlah_tanam" name="jumlah_tanam" value="<?= (old('jumlah_tanam')) ? old('jumlah_tanam') : $obat['jumlah_tanam']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_tanam'); ?>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataTanamanObat" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>