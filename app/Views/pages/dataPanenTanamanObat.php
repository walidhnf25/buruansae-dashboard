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
                            <label for="gambar" class="col-sm-2 col-form-label">Upload Foto Hasil Panen</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar">
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
                                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_berat_kp_kg')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_berat_kp_kg" name="jumlah_berat_kp_kg" 
                                                value="<?= (old('jumlah_berat_kp_kg')) ? old('jumlah_berat_kp_kg') : ($id_tanaman_obat['jumlah_berat_kp_kg'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_berat_kp_kg'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_kepala_keluarga_kp_kk" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_kp_kk')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_kp_kk" name="jumlah_kepala_keluarga_kp_kk" value="<?= (old('jumlah_kepala_keluarga_kp_kk')) ? old('jumlah_kepala_keluarga_kp_kk') : ($id_tanaman_obat['jumlah_kepala_keluarga_kp_kk'] ?? 0); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_kepala_keluarga_kp_kk'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_orang_kp" class="col-sm-2 col-form-label">Jumlah Orang</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_kp')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_kp" name="jumlah_orang_kp" value="<?= (old('jumlah_orang_kp')) ? old('jumlah_orang_kp') : ($id_tanaman_obat['jumlah_orang_kp'] ?? 0); ?>">
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
                                        <!-- Accordion Nested -->
                                        <div class="accordion" id="nestedAccordion">
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="nestedHeadingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseOne" aria-expanded="false" aria-controls="nestedCollapseOne">
                                                        Keluarga Risiko Stunting
                                                    </button>
                                                </h2>
                                                <div id="nestedCollapseOne" class="accordion-collapse collapse" aria-labelledby="nestedHeadingOne" data-bs-parent="#nestedAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row mb-3">
                                                            <label for="jumlah_berat_dibagikan_stunting_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                                            <div class="col-sm-10">
                                                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_berat_dibagikan_stunting_kg')) ? 'is-invalid' : ''; ?>" 
                                                                id="jumlah_berat_dibagikan_stunting_kg" name="jumlah_berat_dibagikan_stunting_kg" 
                                                                value="<?= (old('jumlah_berat_dibagikan_stunting_kg')) ? old('jumlah_berat_dibagikan_stunting_kg') : ($id_tanaman_obat['jumlah_berat_dibagikan_stunting_kg'] ?? 0); ?>" 
                                                                oninput="calculateJumlahPanen()">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_berat_dibagikan_stunting_kg'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_kepala_keluarga_dibagikan_stunting" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_dibagikan_stunting')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_dibagikan_stunting" name="jumlah_kepala_keluarga_dibagikan_stunting" value="<?= (old('jumlah_kepala_keluarga_dibagikan_stunting')) ? old('jumlah_kepala_keluarga_dibagikan_stunting') : ($id_tanaman_obat['jumlah_kepala_keluarga_dibagikan_stunting'] ?? 0); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_kepala_keluarga_dibagikan_stunting'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_orang_dibagikan_stunting" class="col-sm-2 col-form-label">Jumlah Orang</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dibagikan_stunting')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dibagikan_stunting" name="jumlah_orang_dibagikan_stunting" value="<?= (old('jumlah_orang_dibagikan_stunting')) ? old('jumlah_orang_dibagikan_stunting') : ($id_tanaman_obat['jumlah_orang_dibagikan_stunting'] ?? 0); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_orang_dibagikan_stunting'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="nestedHeadingTwo">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseTwo" aria-expanded="false" aria-controls="nestedCollapseTwo">
                                                        Masyarakat Miskin
                                                    </button>
                                                </h2>
                                                <div id="nestedCollapseTwo" class="accordion-collapse collapse" aria-labelledby="nestedHeadingTwo" data-bs-parent="#nestedAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row mb-3">
                                                            <label for="jumlah_berat_dibagikan_mm_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                                            <div class="col-sm-10">
                                                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_berat_dibagikan_mm_kg')) ? 'is-invalid' : ''; ?>" 
                                                                id="jumlah_berat_dibagikan_mm_kg" name="jumlah_berat_dibagikan_mm_kg" 
                                                                value="<?= (old('jumlah_berat_dibagikan_mm_kg')) ? old('jumlah_berat_dibagikan_mm_kg') : ($id_tanaman_obat['jumlah_berat_dibagikan_mm_kg'] ?? 0); ?>" 
                                                                oninput="calculateJumlahPanen()">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_berat_dibagikan_mm_kg'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_kepala_keluarga_dibagikan_mm" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_dibagikan_mm')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_dibagikan_mm" name="jumlah_kepala_keluarga_dibagikan_mm" value="<?= (old('jumlah_kepala_keluarga_dibagikan_mm')) ? old('jumlah_kepala_keluarga_dibagikan_mm') : ($id_tanaman_obat['jumlah_kepala_keluarga_dibagikan_mm'] ?? 0); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_kepala_keluarga_dibagikan_mm'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_orang_dibagikan_mm" class="col-sm-2 col-form-label">Jumlah Orang</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dibagikan_mm')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dibagikan_mm" name="jumlah_orang_dibagikan_mm" value="<?= (old('jumlah_orang_dibagikan_mm')) ? old('jumlah_orang_dibagikan_mm') : ($id_tanaman_obat['jumlah_orang_dibagikan_mm'] ?? 0); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_orang_dibagikan_mm'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="nestedHeadingThree">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseThree" aria-expanded="false" aria-controls="nestedCollapseThree">
                                                        Lansia
                                                    </button>
                                                </h2>
                                                <div id="nestedCollapseThree" class="accordion-collapse collapse" aria-labelledby="nestedHeadingThree" data-bs-parent="#nestedAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row mb-3">
                                                            <label for="jumlah_berat_dibagikan_lansia_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                                            <div class="col-sm-10">
                                                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_berat_dibagikan_lansia_kg')) ? 'is-invalid' : ''; ?>" 
                                                                id="jumlah_berat_dibagikan_lansia_kg" name="jumlah_berat_dibagikan_lansia_kg" 
                                                                value="<?= (old('jumlah_berat_dibagikan_lansia_kg')) ? old('jumlah_berat_dibagikan_lansia_kg') : ($id_tanaman_obat['jumlah_berat_dibagikan_lansia_kg'] ?? 0); ?>" 
                                                                oninput="calculateJumlahPanen()">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_berat_dibagikan_lansia_kg'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_kepala_keluarga_dibagikan_lansia" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_dibagikan_lansia')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_dibagikan_lansia" name="jumlah_kepala_keluarga_dibagikan_lansia" value="<?= old('jumlah_kepala_keluarga_dibagikan_lansia') ?: 0; ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_kepala_keluarga_dibagikan_lansia'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_orang_dibagikan_lansia" class="col-sm-2 col-form-label">Jumlah Orang</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dibagikan_lansia')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dibagikan_lansia" name="jumlah_orang_dibagikan_lansia" value="<?= old('jumlah_orang_dibagikan_lansia') ?: 0; ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_orang_dibagikan_lansia'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="nestedHeadingFour">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseFour" aria-expanded="false" aria-controls="nestedCollapseFour">
                                                        Posyandu
                                                    </button>
                                                </h2>
                                                <div id="nestedCollapseFour" class="accordion-collapse collapse" aria-labelledby="nestedHeadingFour" data-bs-parent="#nestedAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row mb-3">
                                                            <label for="jumlah_berat_dibagikan_posyandu_kg" class="col-sm-2 col-form-label">Jumlah Berat (kg)</label>
                                                            <div class="col-sm-10">
                                                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_berat_dibagikan_posyandu_kg')) ? 'is-invalid' : ''; ?>" 
                                                                id="jumlah_berat_dibagikan_posyandu_kg" name="jumlah_berat_dibagikan_posyandu_kg" 
                                                                value="<?= (old('jumlah_berat_dibagikan_posyandu_kg')) ? old('jumlah_berat_dibagikan_posyandu_kg') : ($id_tanaman_obat['jumlah_berat_dibagikan_posyandu_kg'] ?? 0); ?>" 
                                                                oninput="calculateJumlahPanen()">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_berat_dibagikan_posyandu_kg'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_kepala_keluarga_dibagikan_posyandu" class="col-sm-2 col-form-label">Jumlah Kepala Keluarga (KK)</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga_dibagikan_posyandu')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga_dibagikan_posyandu" name="jumlah_kepala_keluarga_dibagikan_posyandu" value="<?= old('jumlah_kepala_keluarga_dibagikan_posyandu') ?: 0; ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_kepala_keluarga_dibagikan_posyandu'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="jumlah_orang_dibagikan_posyandu" class="col-sm-2 col-form-label">Jumlah Orang</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dibagikan_posyandu')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dibagikan_posyandu" name="jumlah_orang_dibagikan_posyandu" value="<?= old('jumlah_orang_dibagikan_posyandu') ?: 0; ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('jumlah_orang_dibagikan_posyandu'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_berat_dijual_kg')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_berat_dijual_kg" name="jumlah_berat_dijual_kg" 
                                                value="<?= (old('jumlah_berat_dijual_kg')) ? old('jumlah_berat_dijual_kg') : ($id_tanaman_obat['jumlah_berat_dijual_kg'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_berat_dijual_kg'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jumlah_orang_dijual" class="col-sm-2 col-form-label">Jumlah Orang</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('jumlah_orang_dijual')) ? 'is-invalid' : ''; ?>" id="jumlah_orang_dijual" name="jumlah_orang_dijual" value="<?= old('jumlah_orang_dijual') ?: 0; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_orang_dijual'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="harga_jual" class="col-sm-2 col-form-label">Total Harga Jual (Rp)</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" value="<?= old('harga_jual') ?: 0; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('harga_jual'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah_panen" class="col-sm-2 col-form-label">Jumlah Panen (kg)</label>
                            <div class="col-sm-10">
                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_panen')) ? 'is-invalid' : ''; ?>" 
                                id="jumlah_panen" name="jumlah_panen" 
                                value="<?= (old('jumlah_panen')) ? old('jumlah_panen') : ($id_tanaman_obat['jumlah_panen'] ?? 0); ?>" 
                                readonly>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_panen'); ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function calculateJumlahPanen() {
        // Ambil nilai dari setiap input yang terkait
        const jumlahBeratKp = parseFloat(document.getElementById('jumlah_berat_kp_kg').value) || 0;
        const jumlahBeratStunting = parseFloat(document.getElementById('jumlah_berat_dibagikan_stunting_kg').value) || 0;
        const jumlahBeratMm = parseFloat(document.getElementById('jumlah_berat_dibagikan_mm_kg').value) || 0;
        const jumlahBeratLansia = parseFloat(document.getElementById('jumlah_berat_dibagikan_lansia_kg').value) || 0;
        const jumlahBeratPosyandu = parseFloat(document.getElementById('jumlah_berat_dibagikan_posyandu_kg').value) || 0;
        const jumlahBeratDijual = parseFloat(document.getElementById('jumlah_berat_dijual_kg').value) || 0;

        // Hitung total jumlah panen
        const totalPanen = jumlahBeratKp + jumlahBeratStunting + jumlahBeratMm + jumlahBeratLansia + jumlahBeratPosyandu + jumlahBeratDijual;

        // Set nilai ke field jumlah_panen
        document.getElementById('jumlah_panen').value = totalPanen.toFixed(2);
    }
</script>
<?= $this->endSection(); ?>