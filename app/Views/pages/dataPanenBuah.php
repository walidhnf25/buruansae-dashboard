<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Panen Buah</h2>
        <div class="col-12">
            <form action="/dataBuah/tambah_data_panen/<?= $buah['id_buah']; ?>" method="post" enctype="multipart/form-data">
                <?php csrf_field() ?>
                <input type="hidden" name="id_buah" value="<?= $buah['id_buah'] ?>">
                <section>
                    <!-- <label for="data_panen">Data Panen</label> -->
                    <div class="container mt-3">
                        <div class="row mb-3">
                            <label for="nama_buah" class="col-sm-2 col-form-label">Nama Buah</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value="<?= $buah['nama_buah']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="waktu_panen" class="col-sm-2 col-form-label">Waktu Panen</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control <?= ($validation->hasError('waktu_panen')) ? 'is-invalid' : ''; ?>" id="waktu_panen" name="waktu_panen" value="<?= $buah['waktu_panen']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('waktu_panen'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah_panen" class="col-sm-2 col-form-label">Jumlah Panen (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_panen')) ? 'is-invalid' : ''; ?>" id="jumlah_panen" name="jumlah_panen" value="<?= $buah['jumlah_panen']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_panen'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="waktu_pupuk" class="col-sm-2 col-form-label">Waktu Pupuk</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control <?= ($validation->hasError('waktu_pupuk')) ? 'is-invalid' : ''; ?>" id="waktu_pupuk" name="waktu_pupuk" value="<?= $buah['waktu_pupuk']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('waktu_pupuk'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah_pupuk" class="col-sm-2 col-form-label">Jumlah Pupuk (kg)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_pupuk')) ? 'is-invalid' : ''; ?>" id="jumlah_pupuk" name="jumlah_pupuk" value="<?= $buah['jumlah_pupuk']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_pupuk'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jenis_pupuk" class="col-sm-2 col-form-label">Jenis Pupuk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('jenis_pupuk')) ? 'is-invalid' : ''; ?>" id="jenis_pupuk" name="jenis_pupuk" value="<?= $buah['jenis_pupuk']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jenis_pupuk'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Upload Foto Hasil Panen</label>
                            <div class="col-sm-10">
                                <input class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewImg()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambar'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <!-- Accordion Item 1 -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Konsumsi Pribadi
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Form Input Konsumsi Lokal -->
                                        <div class="row mb-3">
                                            <label for="jumlah_berat_kp_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_berat_kp_kg')) ? 'is-invalid' : ''; ?>" id="jumlah_berat_kp_kg" name="jumlah_berat_kp_kg" value="<?= (old('jumlah_berat_kp_kg')) ? old('jumlah_berat_kp_kg') : $buah['jumlah_berat_kp_kg']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_berat_kp_kg'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_kepala_keluarga_kp_kk" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_kp_kk')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_kp_kk" name="jumlah_kepala_keluarga_kp_kk" value="<?= (old('jumlah_kepala_keluarga_kp_kk')) ? old('jumlah_kepala_keluarga_kp_kk') : $buah['jumlah_kepala_keluarga_kp_kk']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_kepala_keluarga_kp_kk'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_orang_kp" class="col-sm-2 col-form-label">Jumlah Orang (Orang)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_kp')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_kp" name="jumlah_orang_kp" value="<?= (old('jumlah_orang_kp')) ? old('jumlah_orang_kp') : $buah['jumlah_orang_kp']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_orang_kp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 2 -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Dibagikan
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                    <div class="row mb-3">
                                            <label for="dibagikan" class="col-sm-2 col-form-label">Dibagikan Ke</label>
                                            <div class="col-sm-10">
                                                <!-- Pilihan Kategori -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="kategori1" name="dibagikan[]" value="Keluarga Risiko Stunting" 
                                                        <?= (is_array(old('dibagikan')) && in_array('Keluarga Risiko Stunting', old('dibagikan'))) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="kategori1">Keluarga Risiko Stunting</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="kategori2" name="dibagikan[]" value="Masyarakat Miskin" 
                                                        <?= (is_array(old('dibagikan')) && in_array('Masyarakat Miskin', old('dibagikan'))) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="kategori2">Masyarakat Miskin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="kategori3" name="dibagikan[]" value="Lansia" 
                                                        <?= (is_array(old('dibagikan')) && in_array('Lansia', old('dibagikan'))) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="kategori3">Lansia</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="kategori4" name="dibagikan[]" value="Posyandu" 
                                                        <?= (is_array(old('dibagikan')) && in_array('Posyandu', old('dibagikan'))) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="kategori4">Posyandu</label>
                                                </div>

                                                <!-- Error Feedback -->
                                                <div class="invalid-feedback d-block">
                                                    <?= $validation->getError('dibagikan'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_berat_dibagikan_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_berat_dibagikan_kg')) ? 'is-invalid' : ''; ?>" id="jumlah_berat_dibagikan_kg" name="jumlah_berat_dibagikan_kg" value="<?= (old('jumlah_berat_dibagikan_kg')) ? old('jumlah_berat_dibagikan_kg') : $buah['jumlah_berat_dibagikan_kg']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_berat_dibagikan_kg'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_kepala_keluarga_dibagikan_kk" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_dibagikan_kk')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_dibagikan_kk" name="jumlah_kepala_keluarga_dibagikan_kk" value="<?= (old('jumlah_kepala_keluarga_dibagikan_kk')) ? old('jumlah_kepala_keluarga_dibagikan_kk') : $buah['jumlah_kepala_keluarga_dibagikan_kk']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_kepala_keluarga_dibagikan_kk'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_orang_dibagikan" class="col-sm-2 col-form-label">Jumlah Orang (Orang)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dibagikan')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dibagikan" name="jumlah_orang_dibagikan" value="<?= (old('jumlah_orang_dibagikan')) ? old('jumlah_orang_dibagikan') : $buah['jumlah_orang_dibagikan']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_orang_dibagikan'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 3 -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        Dijual
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mb-3">
                                            <label for="jumlah_berat_dijual_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_berat_dijual_kg')) ? 'is-invalid' : ''; ?>" id="jumlah_berat_dijual_kg" name="jumlah_berat_dijual_kg" value="<?= (old('jumlah_berat_dijual_kg')) ? old('jumlah_berat_dijual_kg') : $buah['jumlah_berat_dijual_kg']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_berat_dijual_kg'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_kepala_keluarga_dijual_kk" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_dijual_kk')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_dijual_kk" name="jumlah_kepala_keluarga_dijual_kk" value="<?= (old('jumlah_kepala_keluarga_dijual_kk')) ? old('jumlah_kepala_keluarga_dijual_kk') : $buah['jumlah_kepala_keluarga_dijual_kk']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_kepala_keluarga_dijual_kk'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_orang_dijual" class="col-sm-2 col-form-label">Jumlah Orang (Orang)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dijual')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dijual" name="jumlah_orang_dijual" value="<?= (old('jumlah_orang_dijual')) ? old('jumlah_orang_dijual') : $buah['jumlah_orang_dijual']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_orang_dijual'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataBuah" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>