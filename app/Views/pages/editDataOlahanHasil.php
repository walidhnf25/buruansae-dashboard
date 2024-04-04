<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Olahan Hasil</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataOlahanHasil/update/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="tanggal_produksi" class="form-label">Tanggal Produksi</label>
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_produksi')) ? 'is-invalid' : ''; ?>" id="tanggal_produksi" name="tanggal_produksi" value="<?= (old('tanggal_produksi')) ? old('tanggal_produksi') : $olahan_hasil['tanggal_produksi']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_produksi'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jenis_olahan" class="form-label">Jenis Olahan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('jenis_olahan')) ? 'is-invalid' : ''; ?>" id="jenis_olahan" name="jenis_olahan" value="<?= (old('jenis_olahan')) ? old('jenis_olahan') : $olahan_hasil['jenis_olahan']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('jenis_olahan'); ?>
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
                    <label for="bahan_dasar" class="form-label">Bahan Dasar</label>                
                    <input type="text" class="form-control <?= ($validation->hasError('bahan_dasar')) ? 'is-invalid' : ''; ?>" id="bahan_dasar" name="bahan_dasar" value="<?= (old('bahan_dasar')) ? old('bahan_dasar') : $olahan_hasil['bahan_dasar']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('bahan_dasar'); ?>
                    </div> 
                </div>
                <div class="mb-3">
                    <label for="merk" class="form-label">Merk</label>
                    <input type="text" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" id="merk" name="merk" value="<?= (old('merk')) ? old('merk') : $olahan_hasil['merk']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('merk'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="resep" class="form-label">Resep</label>
                    <input type="text" class="form-control <?= ($validation->hasError('resep')) ? 'is-invalid' : ''; ?>" id="resep" name="resep" value="<?= (old('resep')) ? old('resep') : $olahan_hasil['resep']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('resep'); ?>
                    </div>
                </div>  
                <div class="mb-3">
                    <label for="izin_pirt" class="form-label">Izin PIRT</label>
                    <input type="text" class="form-control <?= ($validation->hasError('izin_pirt')) ? 'is-invalid' : ''; ?>" id="izin_pirt" name="izin_pirt" value="<?= (old('izin_pirt')) ? old('izin_pirt') : $olahan_hasil['izin_pirt']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('izin_pirt'); ?>
                    </div>
                </div>  
                <div class="mb-3">
                    <label for="izin_halal" class="form-label">Izin Halal</label>
                    <input type="text" class="form-control <?= ($validation->hasError('izin_halal')) ? 'is-invalid' : ''; ?>" id="izin_halal" name="izin_halal" value="<?= (old('izin_halal')) ? old('izin_halal') : $olahan_hasil['izin_halal']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('izin_halal'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="uji_lab" class="form-label">Hasil Uji Lab</label>
                    <input type="text" class="form-control <?= ($validation->hasError('uji_lab')) ? 'is-invalid' : ''; ?>" id="uji_lab" name="uji_lab" value="<?= (old('uji_lab')) ? old('uji_lab') : $olahan_hasil['uji_lab']; ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('uji_lab'); ?>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataOlahanHasil" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>