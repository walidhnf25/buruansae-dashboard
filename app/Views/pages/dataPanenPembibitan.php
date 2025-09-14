<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Panen Bibit</h2>
        <div class="col-12">
            <form action="/dataPembibitan/updateDataPanen/<?= $id_bibit['id_bibit']; ?>" method="post" enctype="multipart/form-data">
                <?php csrf_field() ?>
                <input type="hidden" name="id_bibit" value="<?= $id_bibit['id_bibit'] ?>">
                <section>
                    <!-- <label for="data_panen">Data Panen</label> -->
                    <div class="container mt-3">
                        <div class="row mb-3">
                            <label for="nama_sayur" class="col-sm-2 col-form-label">Nama Sayur</label>
                            <div class="col-sm-10">
                                <input disabled type="text" class="form-control" value="<?= $id_bibit['nama_sayur']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="waktu_panen" class="col-sm-2 col-form-label">Waktu Panen</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control <?= ($validation->hasError('waktu_panen')) ? 'is-invalid' : ''; ?>" id="waktu_panen" name="waktu_panen" value="<?= (old('waktu_panen')) ? old('waktu_panen') : $id_bibit['waktu_panen']; ?>">
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
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Konsumsi Pribadi
                                </button>
                            </h2>

                            <div id="collapseOne" class="accordion-collapse collapse" 
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label for="jumlah_kp" class="col-sm-2 col-form-label">
                                            Jumlah Konsumsi Sendiri (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_kp')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_kp" 
                                                name="jumlah_kp" 
                                                value="<?= (old('jumlah_kp')) 
                                                    ? old('jumlah_kp') 
                                                    : ($id_sayur['jumlah_kp'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_kp'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Dibagikan
                                </button>
                            </h2>

                            <div id="collapseTwo" class="accordion-collapse collapse" 
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label for="jumlah_ms" class="col-sm-2 col-form-label">
                                            Jumlah Masyarakat Sekitar (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_ms')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_ms" 
                                                name="jumlah_ms" 
                                                value="<?= (old('jumlah_ms')) 
                                                    ? old('jumlah_ms') 
                                                    : ($id_sayur['jumlah_ms'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_ms'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_sekolah" class="col-sm-2 col-form-label">
                                            Jumlah Sekolah (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_sekolah')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_sekolah" 
                                                name="jumlah_sekolah" 
                                                value="<?= (old('jumlah_sekolah')) 
                                                    ? old('jumlah_sekolah') 
                                                    : ($id_sayur['jumlah_sekolah'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_sekolah'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_pkk" class="col-sm-2 col-form-label">
                                            Jumlah PKK (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_pkk')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_pkk" 
                                                name="jumlah_pkk" 
                                                value="<?= (old('jumlah_pkk')) 
                                                    ? old('jumlah_pkk') 
                                                    : ($id_sayur['jumlah_pkk'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_pkk'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_posyandu" class="col-sm-2 col-form-label">
                                            Jumlah Posyandu (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_posyandu')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_posyandu" 
                                                name="jumlah_posyandu" 
                                                value="<?= (old('jumlah_posyandu')) 
                                                    ? old('jumlah_posyandu') 
                                                    : ($id_sayur['jumlah_posyandu'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_posyandu'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_lainnya" class="col-sm-2 col-form-label">
                                            Jumlah Lainnya (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_lainnya')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_lainnya" 
                                                name="jumlah_lainnya" 
                                                value="<?= (old('jumlah_lainnya')) 
                                                    ? old('jumlah_lainnya') 
                                                    : ($id_sayur['jumlah_lainnya'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_lainnya'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_kk" class="col-sm-2 col-form-label">
                                            Jumlah Dibagikan (kk)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_kk')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_kk" 
                                                name="jumlah_kk" 
                                                value="<?= (old('jumlah_kk')) 
                                                    ? old('jumlah_kk') 
                                                    : ($id_sayur['jumlah_kk'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_kk'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_orang" class="col-sm-2 col-form-label">
                                            Jumlah Orang (orang)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_orang')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_orang" 
                                                name="jumlah_orang" 
                                                value="<?= (old('jumlah_orang')) 
                                                    ? old('jumlah_orang') 
                                                    : ($id_sayur['jumlah_orang'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_orang'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Dijual
                                </button>
                            </h2>

                            <div id="collapseThree" class="accordion-collapse collapse" 
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mb-3">
                                        <label for="jumlah_dijual_pohon" class="col-sm-2 col-form-label">
                                            Jumlah Dijual (pohon)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_dijual_pohon')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_dijual_pohon" 
                                                name="jumlah_dijual_pohon" 
                                                value="<?= (old('jumlah_dijual_pohon')) 
                                                    ? old('jumlah_dijual_pohon') 
                                                    : ($id_sayur['jumlah_dijual_pohon'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_dijual_pohon'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jumlah_dijual_orang" class="col-sm-2 col-form-label">
                                            Jumlah Dijual (orang)
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="any" 
                                                class="form-control <?= ($validation->hasError('jumlah_dijual_orang')) ? 'is-invalid' : ''; ?>" 
                                                id="jumlah_dijual_orang" 
                                                name="jumlah_dijual_orang" 
                                                value="<?= (old('jumlah_dijual_orang')) 
                                                    ? old('jumlah_dijual_orang') 
                                                    : ($id_sayur['jumlah_dijual_orang'] ?? 0); ?>" 
                                                oninput="calculateJumlahPanen()">

                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_dijual_orang'); ?>
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
                        <div class="row mb-3">
                            <label for="jumlah_panen" class="col-sm-2 col-form-label">Jumlah Panen (pohon)</label>
                            <div class="col-sm-10">
                            <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('jumlah_panen')) ? 'is-invalid' : ''; ?>" 
                                id="jumlah_panen" name="jumlah_panen" 
                                value="<?= (old('jumlah_panen')) ? old('jumlah_panen') : ($id_bibit['jumlah_panen'] ?? 0); ?>" 
                                readonly>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jumlah_panen'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataPembibitan" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function calculateJumlahPanen() {
        // Ambil nilai dari setiap input yang ada di accordion
        const jumlahKp        = parseFloat(document.getElementById('jumlah_kp').value) || 0;
        const jumlahMmMs      = parseFloat(document.getElementById('jumlah_ms').value) || 0;
        const jumlahSekolah   = parseFloat(document.getElementById('jumlah_sekolah').value) || 0;
        const jumlahPkk       = parseFloat(document.getElementById('jumlah_pkk').value) || 0;
        const jumlahPosyandu  = parseFloat(document.getElementById('jumlah_posyandu').value) || 0;
        const jumlahLainnya   = parseFloat(document.getElementById('jumlah_lainnya').value) || 0;
        const jumlahDijualPohon    = parseFloat(document.getElementById('jumlah_dijual_pohon').value) || 0;

        // Hitung total jumlah panen
        const totalPanen = jumlahKp + jumlahMmMs + jumlahSekolah + jumlahPkk + jumlahPosyandu + jumlahLainnya + jumlahDijualPohon;

        // Set nilai ke field jumlah_panen (pastikan ada field hidden / readonly di form)
        document.getElementById('jumlah_panen').value = totalPanen;
    }
</script>
<?= $this->endSection(); ?>