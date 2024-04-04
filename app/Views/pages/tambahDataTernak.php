<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Ternak</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataTernak/save" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="jenis_ternak" class="form-label">Jenis Ternak</label>
                    <select class="form-select <?= ($validation->hasError('jenis_ternak')) ? 'is-invalid' : ''; ?>" name="jenis_ternak" id="jenis_ternak">
                        <option value="" class="hidden" style="display: none;" >Pilih Jenis Ternak</option>
                        <option disabled>Pilih Jenis Ternak</option>
                        <option value="Ayam Petelur">Ayam Petelur</option>
                        <option value="Kelinci">Kelinci</option>
                        <option value="Ayam Joper">Ayam Joper</option>
                        <option value="Bebek">Bebek</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_ternak'); ?>
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
                    <label for="waktu_pakan" class="form-label">Waktu Pakan</label>
                    <input type="date" class="form-control <?= ($validation->hasError('waktu_pakan')) ? 'is-invalid' : ''; ?>" id="waktu_pakan" name="waktu_pakan">
                    <div class="invalid-feedback">
                    <?= $validation->getError('waktu_pakan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_ternak" class="form-label">Jumlah Ternak (Ekor)</label>                
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_ternak')) ? 'is-invalid' : ''; ?>" id="jumlah_ternak" name="jumlah_ternak">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_ternak'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_pakan" class="form-label">Jumlah Pakan</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_pakan')) ? 'is-invalid' : ''; ?>" id="jumlah_pakan" name="jumlah_pakan">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_pakan'); ?>
                    </div>
                </div>    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="<?= base_url(); ?>/dataTernak" class="btn btn-secondary" type="button">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('select[name="id_kelompok"]').change(function() {
            var selectedOption = $(this).find('option:selected');
            var penyuluh = selectedOption.data('penyuluh');
            var pendamping = selectedOption.data('pendamping');
            var kecamatan = selectedOption.data('kecamatan');
            var kelurahan = selectedOption.data('kelurahan');
            $('input[name="penyuluh"]').val(penyuluh);
            $('input[name="pendamping"]').val(pendamping);
            $('input[name="kecamatan"]').val(kecamatan);
            $('input[name="kelurahan"]').val(kelurahan);
        });
    });
</script>

<?= $this->endSection(); ?>