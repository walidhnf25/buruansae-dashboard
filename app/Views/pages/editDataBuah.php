<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Buah</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataBuah/update/<?= $buah['id_buah']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama_buah" class="form-label">Nama Buah</label>
                    <select class="form-select <?= ($validation->hasError('nama_buah')) ? 'is-invalid' : ''; ?>" name="nama_buah" id="nama_buah">
                        <option value="" class="hidden" style="display: none;" disabled>Pilih Sayur</option>
                        <?php foreach ($komoditi as $k) : ?>
                            <option value="<?= $k['nama_komoditi'] ?>" <?= old('nama_buah') == $k['nama_komoditi'] ? 'selected' : ''; ?>><?= $k['nama_komoditi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_buah'); ?>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_kelompok" class="form-label">Assign Kelompok</label>
                    <select name="id_kelompok" class="form-select">
                        <option value="" style="display: none;" class="hidden" disabled>--Pilih Nama Kelompok--</option>
                        <?php foreach ($kelompok as $key => $value) { ?>
                            <option value="<?php echo $value['id_kelompok']; ?>" data-penyuluh="<?php echo $value['penyuluh']; ?>" data-pendamping="<?php echo $value['pendamping']; ?>" data-kecamatan="<?php echo $value['kecamatan']; ?>" data-kelurahan="<?php echo $value['kelurahan']; ?>" <?php echo old('id_kelompok', $buah['id_kelompok']) == $value['id_kelompok'] ? 'selected' : ''; ?>><?php echo $value['nama_kelompok']; ?></option>
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
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_tanam')) ? 'is-invalid' : ''; ?>" id="tanggal_tanam" name="tanggal_tanam" value="<?= (old('tanggal_tanam')) ? old('tanggal_tanam') : $buah['tanggal_tanam']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_tanam'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kategori_tumbuhan" class="form-label">Kategori Tumbuhan</label>
                    <input hidden type="text" class="form-control <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="kategori_tumbuhan" name="kategori_tumbuhan">
                    <select class="form-select <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" name="kategori_tumbuhan" id="kategori_tumbuhan">
                        <!-- <option value="" class="hidden" style="display: none;" >Pilih Kategori Tumbuhan</option>
                        <option disabled>Pilih Kategori Tumbuhan</option> -->
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
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_tanam')) ? 'is-invalid' : ''; ?>" id="jumlah_tanam" name="jumlah_tanam" value="<?= (old('jumlah_tanam')) ? old('jumlah_tanam') : $buah['jumlah_tanam']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_tanam'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="prakiraan_jumlah_panen" class="form-label">Prakiraan Jumlah Panen (kg)</label>
                    <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('prakiraan_jumlah_panen')) ? 'is-invalid' : ''; ?>" id="prakiraan_jumlah_panen" name="prakiraan_jumlah_panen" value="<?= (old('prakiraan_jumlah_panen')) ? old('prakiraan_jumlah_panen') : $buah['prakiraan_jumlah_panen']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('prakiraan_jumlah_panen'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="waktu_prakiraan_panen" class="form-label">Waktu Prakiraan Panen</label>
                        <input type="date" class="form-control <?= ($validation->hasError('waktu_prakiraan_panen')) ? 'is-invalid' : ''; ?>" id="waktu_prakiraan_panen" name="waktu_prakiraan_panen" value="<?= (old('waktu_prakiraan_panen')) ? old('waktu_prakiraan_panen') : $buah['waktu_prakiraan_panen']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('waktu_prakiraan_panen'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="durasi_tanam" class="form-label">Durasi Tanam (Hari)</label>
                        <input type="number" min="1" class="form-control <?= ($validation->hasError('durasi_tanam')) ? 'is-invalid' : ''; ?>" 
                            id="durasi_tanam" name="durasi_tanam" 
                            value="<?= (old('durasi_tanam')) ? old('durasi_tanam') : $durasi_tanam; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('durasi_tanam'); ?>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataBuah" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateDurasiTanam() {
        const namaBuahSelect = document.getElementById('nama_buah'); // Perbaiki ID
        const durasiTanamInput = document.getElementById('durasi_tanam');

        // Ambil data durasi dari opsi yang dipilih
        const selectedOption = namaBuahSelect.options[namaBuahSelect.selectedIndex];
        const durasiTanam = parseInt(selectedOption.getAttribute('data-durasi')) || 0;

        // Update field durasi tanam
        durasiTanamInput.value = durasiTanam;

        // Panggil updatePrakiraanPanen untuk memperbarui prakiraan panen
        updatePrakiraanPanen();
    }

    function updatePrakiraanPanen() {
        const tanggalTanamInput = document.getElementById('tanggal_tanam');
        const waktuPrakiraanPanenInput = document.getElementById('waktu_prakiraan_panen');
        const durasiTanamInput = document.getElementById('durasi_tanam');

        const tanggalTanam = tanggalTanamInput.value;
        const durasiTanam = parseInt(durasiTanamInput.value) || 0;

        if (tanggalTanam && durasiTanam) {
            const tanamDate = new Date(tanggalTanam);

            // Tambahkan durasi tanam ke tanggal tanam
            tanamDate.setDate(tanamDate.getDate() + durasiTanam);

            // Format tanggal menjadi yyyy-mm-dd
            const panenDate = tanamDate.toISOString().split('T')[0];

            // Update field waktu prakiraan panen
            waktuPrakiraanPanenInput.value = panenDate;
        } else {
            // Kosongkan field jika input tidak valid
            waktuPrakiraanPanenInput.value = '';
        }
    }

    // Pasang event listener untuk input tanggal_tanam
    document.getElementById('tanggal_tanam').addEventListener('change', updatePrakiraanPanen);
</script>
<?= $this->endSection(); ?>