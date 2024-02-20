<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Produksi Sampah</h2>
        <div class="col-12">
            <form action="/dataPengolahanSampah/tambah_data_panen/<?= $id_data_sampah['id_data_sampah']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_data_sampah" value="<?php $id_data_sampah['id_data_sampah'] ?>">
                <section>
                    <!-- <label for="data_panen">Data Panen</label> -->
                    <div class="container mt-3">
                        <div class="row mb-3">
                            <label for="jenis_pengolahan" class="col-sm-2 col-form-label">Jenis Olahan</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value="<?= $id_data_sampah['jenis_pengolahan']; ?>" name="jenis_pengolahan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="produk_hasil" class="col-sm-2 col-form-label">Produk Hasil</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('produk_hasil')) ? 'is-invalid' : ''; ?>" name="produk_hasil" id="produk_hasil" value="<?= $id_data_sampah['produk_hasil']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="waktu_sebaran" class="col-sm-2 col-form-label">Waktu Sebaran</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control <?= ($validation->hasError('waktu_sebaran')) ? 'is-invalid' : ''; ?>" id="waktu_sebaran" name="waktu_sebaran" value="<?= $id_data_sampah['waktu_sebaran']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('waktu_sebaran'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <!-- <label for="sebaran_hasil">Sebaran Hasil</label> -->
                    <div class="container">
                        <div class="row mb-3">
                            <label for="penggunaan_lokal" class="col-sm-2 col-form-label">Pengunaan Lokal (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" class="form-control <?= ($validation->hasError('penggunaan_lokal')) ? 'is-invalid' : ''; ?>" id="penggunaan_lokal" name="penggunaan_lokal" value="<?= $id_data_sampah['penggunaan_lokal']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('penggunaan_lokal'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah_jual" class="col-sm-2 col-form-label">Jumlah Jual (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_jual')) ? 'is-invalid' : ''; ?>" id="jumlah_jual" name="jumlah_jual" value="<?= $id_data_sampah['jumlah_jual']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_jual'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga_jual" class="col-sm-2 col-form-label">Total Harga Jual (Rp)</label>
                            <div class="col-sm-10">
                                <input type="number" min="1000" class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" value="<?= $id_data_sampah['harga_jual']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('harga_jual'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lokasi_pembeli" class="col-sm-2 col-form-label">Lokasi Pembeli</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('lokasi_pembeli')) ? 'is-invalid' : ''; ?>" name="lokasi_pembeli" value="<?= $id_data_sampah['lokasi_pembeli']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('lokasi_pembeli'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <!-- <label for="program_pendukung">Data Pendukung</label> -->
                    <div class="container">
                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Upload Foto Hasil Panen</label>
                            <div class="col-sm-10">
                                <input class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambar'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="dukungan_program_lain" class="col-sm-2 col-form-label">Dukungan Program Lainnya</label>
                            <div class="col-sm-10">
                                <textarea class="form-control <?= ($validation->hasError('dukungan_program_lain')) ? 'is-invalid' : ''; ?>" id="dukungan_program_lain" rows="3" id="dukungan_program_lain" name="dukungan_program_lain"></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('dukungan_program_lain'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="program_pendukung" class="col-sm-2 col-form-label">Data Pendukung</label>
                            <div class="col-sm-10">
                                <textarea class="form-control <?= ($validation->hasError('program_pendukung')) ? 'is-invalid' : ''; ?>" id="program_pendukung" name="program_pendukung" rows="3"></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('program_pendukung'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataPengolahanSampah" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>