<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Tanaman Obat</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataTanamanObat/save" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama_tanaman_obat" class="form-label">Nama Tanaman Obat</label>
                    <select class="form-select <?= ($validation->hasError('nama_tanaman_obat')) ? 'is-invalid' : ''; ?>" 
                            name="nama_tanaman_obat" 
                            id="nama_tanaman_obat" 
                            onchange="updatePrakiraanPanen()">
                        <option value="" class="hidden" style="display: none;">Pilih Tanaman Obat</option>
                        <?php foreach ($komoditi as $k) : ?>
                            <option value="<?= $k['nama_komoditi'] ?>" 
                                    data-durasi="<?= $k['durasi_tanam'] ?>">
                                <?= $k['nama_komoditi'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_tanaman_obat'); ?>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_kelompok" class="form-label">Assign Kelompok</label>
                    <select name="id_kelompok" class="form-select">
                        <option value="" style="display: none;" class="hidden">--Pilih Nama Kelompok--</option>
                        <?php foreach ($kelompok as $key => $value) { ?>
                            <option value="<?php echo $value['id_kelompok']; ?>" data-penyuluh="<?php echo $value['penyuluh']; ?>" data-pendamping="<?php echo $value['pendamping']; ?>" data-kecamatan="<?php echo $value['kecamatan']; ?>" data-kelurahan="<?php echo $value['kelurahan']; ?>"><?php echo $value['nama_kelompok']; ?></option>
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
                    <label for="kategori_tumbuhan" class="form-label">Kategori Tumbuhan</label>
                    <input hidden type="text" class="form-control <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="kategori_tumbuhan" name="kategori_tumbuhan">
                    <div class="radio">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio1" name="kategori_tumbuhan" value="Benih">
                            <label class="form-check-label" for="radio1">Benih</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input <?= ($validation->hasError('kategori_tumbuhan')) ? 'is-invalid' : ''; ?>" id="radio2" name="kategori_tumbuhan" value="Bibit">
                            <label class="form-check-label" for="radio2">Bibit</label>
                        </div>
                    </div>
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
                <div class="mb-3">
                    <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                    <input type="date" 
                        class="form-control <?= ($validation->hasError('tanggal_tanam')) ? 'is-invalid' : ''; ?>" 
                        id="tanggal_tanam" 
                        name="tanggal_tanam" 
                        onchange="updatePrakiraanPanen()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_tanam'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="prakiraan_jumlah_panen" class="form-label">Prakiraan Jumlah Panen (kg)</label>
                    <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('prakiraan_jumlah_panen')) ? 'is-invalid' : ''; ?>" id="prakiraan_jumlah_panen" name="prakiraan_jumlah_panen">
                    <div class="invalid-feedback">
                        <?= $validation->getError('prakiraan_jumlah_panen'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="waktu_prakiraan_panen" class="form-label">Waktu Prakiraan Panen</label>
                        <input type="date" class="form-control" id="waktu_prakiraan_panen" name="waktu_prakiraan_panen" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="durasi_tanam" class="form-label">Durasi Tanam (Hari)</label>
                        <input type="text" class="form-control" id="durasi_tanam" readonly>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataTanamanObat" class="btn btn-secondary" type="button">Kembali</a>
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

    // Function to calculate and update waktu_prakiraan_panen
    function updatePrakiraanPanen() {
        const namaTanamanObatSelect = document.getElementById('nama_tanaman_obat');
        const tanggalTanamInput = document.getElementById('tanggal_tanam');
        const waktuPrakiraanPanenInput = document.getElementById('waktu_prakiraan_panen');
        const durasiTanamInput = document.getElementById('durasi_tanam');

        // Ambil data durasi dari opsi yang dipilih
        const selectedOption = namaTanamanObatSelect.options[namaTanamanObatSelect.selectedIndex];
        const durasiTanam = parseInt(selectedOption.getAttribute('data-durasi')) || 0;
        const tanggalTanam = tanggalTanamInput.value;

        if (tanggalTanam) {
            // Update durasi tanam field only if tanggal_tanam is filled
            durasiTanamInput.value = durasiTanam;

            if (durasiTanam) {
                const tanamDate = new Date(tanggalTanam);
                tanamDate.setDate(tanamDate.getDate() + durasiTanam);
                const panenDate = tanamDate.toISOString().split('T')[0];
                waktuPrakiraanPanenInput.value = panenDate;
            } else {
                waktuPrakiraanPanenInput.value = '';
            }
        } else {
            // Clear durasi_tanam and waktu_prakiraan_panen if tanggal_tanam is empty
            durasiTanamInput.value = '';
            waktuPrakiraanPanenInput.value = '';
        }
    }
</script>

<?= $this->endSection(); ?>