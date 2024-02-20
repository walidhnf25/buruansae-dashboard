<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Panen Tanaman Obat</h2>
        <div class="col-12">
            <form action="/dataTanamanObat/updateDataPanen/<?= $id_tanaman_obat['id_tanaman_obat']; ?>" method="post" enctype="multipart/form-data">
                <?php csrf_field() ?>
                <input type="hidden" name="id_tanaman_obat" value="<?= $id_tanaman_obat['id_tanaman_obat'] ?>">
                <section>
                    <!-- <label for="data_panen">Data Panen</label> -->
                    <div class="container mt-3">
                        <div class="row mb-3">
                            <label for="nama_tanaman_obat" class="col-sm-2 col-form-label">Nama Tanaman</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value="<?= $id_tanaman_obat['nama_tanaman_obat']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="waktu_panen" class="col-sm-2 col-form-label">Waktu Panen</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control <?= ($validation->hasError('waktu_panen')) ? 'is-invalid' : ''; ?>" id="waktu_panen" name="waktu_panen" value="<?= (old('waktu_panen')) ? old('waktu_panen') : $id_tanaman_obat['waktu_panen']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('waktu_panen'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah_panen" class="col-sm-2 col-form-label">Jumlah Panen (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_panen')) ? 'is-invalid' : ''; ?>" id="jumlah_panen" name="jumlah_panen" value="<?= (old('jumlah_panen')) ? old('jumlah_panen') : $id_tanaman_obat['jumlah_panen']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_panen'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <!-- <label for="sebaran_hasil">Sebaran Hasil</label> -->
                    <div class="container">
                        <div class="row mb-3">
                            <label for="konsumsi_lokal" class="col-sm-2 col-form-label">Konsumsi Lokal (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control <?= ($validation->hasError('konsumsi_lokal_kg')) ? 'is-invalid' : ''; ?>" id="konsumsi_lokal_kg" name="konsumsi_lokal_kg" value="<?= (old('konsumsi_lokal_kg')) ? old('konsumsi_lokal_kg') : $id_tanaman_obat['konsumsi_lokal_kg']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('konsumsi_lokal_kg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="konsumsi_kk" class="col-sm-2 col-form-label">Konsumsi Lokal (KK)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control <?= ($validation->hasError('konsumsi_kk')) ? 'is-invalid' : ''; ?>" id="konsumsi_kk" name="konsumsi_kk" value="<?= (old('konsumsi_kk')) ? old('konsumsi_kk') : $id_tanaman_obat['konsumsi_kk']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('konsumsi_kk'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="konsumsi_orang" class="col-sm-2 col-form-label">Konsumsi Lokal (orang)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control <?= ($validation->hasError('konsumsi_orang')) ? 'is-invalid' : ''; ?>" id="konsumsi_orang" name="konsumsi_orang" value="<?= (old('konsumsi_orang')) ? old('konsumsi_orang') : $id_tanaman_obat['konsumsi_orang']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('konsumsi_orang'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah_jual" class="col-sm-2 col-form-label">Jumlah Jual (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_jual')) ? 'is-invalid' : ''; ?>" id="jumlah_jual" name="jumlah_jual" value="<?= (old('jumlah_jual')) ? old('jumlah_jual') : $id_tanaman_obat['jumlah_jual']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_jual'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga_jual" class="col-sm-2 col-form-label">Total Harga Jual (Rp)</label>
                            <div class="col-sm-10">
                                <input type="number" min="1000" class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" value="<?= (old('harga_jual')) ? old('harga_jual') : $id_tanaman_obat['harga_jual']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('harga_jual'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lokasi_pembeli" class="col-sm-2 col-form-label">Lokasi Pembeli</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('lokasi_pembeli')) ? 'is-invalid' : ''; ?>" name="lokasi_pembeli" value="<?= (old('lokasi_pembeli')) ? old('lokasi_pembeli') : $id_tanaman_obat['lokasi_pembeli']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('lokasi_pembeli'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <!-- <label for="data_pendukung">Data Pendukung</label> -->
                    <div class="container">
                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Upload Foto Hasil Panen</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambar'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Preview gambar</label>
                            <div class="col-sm-10">
                                <img src="/asset/default_photo.jpg" class="img-thumbnail img-preview">
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <label for="dukungan_program_lain" class="col-sm-2 col-form-label">Dukungan Program Lainnya</label>
                            <div class="col-sm-10">
                                <textarea class="form-control <?= ($validation->hasError('dukungan_program_lain')) ? 'is-invalid' : ''; ?>" id="dukungan_program_lain" rows="3" id="dukungan_program_lain" name="dukungan_program_lain"><?= (old('dukungan_program_lain')) ? old('dukungan_program_lain') : $id_tanaman_obat['dukungan_program_lain']; ?></textarea>
                                <div class=" invalid-feedback">
                                    <?= $validation->getError('dukungan_program_lain'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="data_pendukung" class="col-sm-2 col-form-label">Data Pendukung</label>
                            <div class="col-sm-10">
                                <textarea class="form-control <?= ($validation->hasError('data_pendukung')) ? 'is-invalid' : ''; ?>" id="data_pendukung" name="data_pendukung" rows="3"><?= (old('data_pendukung')) ? old('data_pendukung') : $id_tanaman_obat['data_pendukung']; ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('data_pendukung'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataTanamanObat" class="btn btn-secondary" type="button">Kembali</a>
                    <input value="Submit" type="Submit" class="btn btn-primary me-md-2"></input>
                    <!-- <button class="btn btn-primary me-md-2" type="submit">Simpan</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>