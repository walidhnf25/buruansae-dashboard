<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class='label-tambah-data mb-3'>Tambah Data Buah</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataBuah/save" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama_buah" class="form-label">Nama Buah</label>
                    <select class="form-select <?= ($validation->hasError('nama_buah')) ? 'is-invalid' : ''; ?>" name="nama_buah" id="nama_buah">
                        <option value="" class="hidden" style="display: none;" >Pilih Buah</option>
                        <option disabled>Pilih Buah</option>
                        <option value="Mangga">Mangga</option>
                        <option value="Jeruk">Jeruk</option>
                        <option value="Jambu">Jambu</option>
                        <option value="Arbei">Arbei</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_buah'); ?>
                    </div>
                </div> 
                <div class="form-group mb-3">
                    <label for="nama_kelompok" class="form-label">Assign Tugas Kelompok</label>
                    <select name="id_kelompok" class="form-select">
                        <option value="" style="display: none;" class="hidden">--Pilih Nama Kelompok--</option>
                        <?php foreach ($kelompok as $key => $value) { ?>
                            <option 
                            value="<?php echo $value['id_kelompok']; ?>" 
                            data-penyuluh="<?php echo $value['penyuluh']; ?>" 
                            data-pendamping="<?php echo $value['pendamping']; ?>" 
                            data-kecamatan="<?php echo $value['kecamatan']; ?>"
                            data-kelurahan="<?php echo $value['kelurahan']; ?>"
                            ><?php echo $value['nama_kelompok']; ?></option>
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
                    <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_tanam')) ? 'is-invalid' : ''; ?>" id="tanggal_tanam" name="tanggal_tanam">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_tanam'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kategori_tumbuhan" class="form-label">Kategori Tumbuhan</label>                
                    <input hidden type="text" class="form-control <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="kategori_tumbuhan" name="kategori_tumbuhan">
                    <select class="form-select <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" name="kategori_tumbuhan" id="kategori_tumbuhan">
                        <option value="" class="hidden" style="display: none;" >Pilih Kategori Tumbuhan</option>
                        <option disabled>Pilih Kategori Tumbuhan</option>
                        <option value="Pohon">Pohon</option>
                        <option disabled value="Bibit">Bibit</option>
                        <option disabled value="Benih">Benih</option>
                    </select>
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
                <div class="modal-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="<?= base_url(); ?>/dataBuah" class="btn btn-secondary" type="button">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>