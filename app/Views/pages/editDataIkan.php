<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Edit Data Ikan</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataIkan/update/<?= $ikan['id_ikan']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="jenis_ikan" class="form-label">Jenis Ikan</label>
                    <select class="form-select <?= ($validation->hasError('jenis_ikan')) ? 'is-invalid' : ''; ?>" name="jenis_ikan" id="jenis_ikan">
                        <option value="" class="hidden" style="display: none;" disabled>Pilih Ikan</option>
                        <?php foreach ($komoditi as $k) : ?>
                            <option value="<?= $k['nama_komoditi'] ?>" <?= old('jenis_ikan') == $k['nama_komoditi'] ? 'selected' : ''; ?>><?= $k['nama_komoditi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_ikan'); ?>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_kelompok" class="form-label">Assign Tugas Kelompok</label>
                    <select name="id_kelompok" class="form-select">
                        <option value="" style="display: none;" class="hidden" disabled>--Pilih Nama Kelompok--</option>
                        <?php foreach ($kelompok as $key => $value) { ?>
                            <option value="<?php echo $value['id_kelompok']; ?>" data-penyuluh="<?php echo $value['penyuluh']; ?>" data-pendamping="<?php echo $value['pendamping']; ?>" data-kecamatan="<?php echo $value['kecamatan']; ?>" data-kelurahan="<?php echo $value['kelurahan']; ?>" <?php echo old('id_kelompok', $ikan['id_kelompok']) == $value['id_kelompok'] ? 'selected' : ''; ?>><?php echo $value['nama_kelompok']; ?></option>
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
                    <input type="date" class="form-control <?= ($validation->hasError('waktu_pakan')) ? 'is-invalid' : ''; ?>" id="waktu_pakan" name="waktu_pakan" value="<?= (old('waktu_pakan')) ? old('waktu_pakan') : $ikan['waktu_pakan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('waktu_pakan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_ikan" class="form-label">Jumlah Ikan</label>
                    <input type="number" min="1" class="form-control <?= ($validation->hasError('jumlah_ikan')) ? 'is-invalid' : ''; ?>" id="jumlah_ikan" name="jumlah_ikan" value="<?= (old('jumlah_ikan')) ? old('jumlah_ikan') : $ikan['jumlah_ikan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah_ikan'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="prakiraan_jumlah_panen" class="form-label">Prakiraan Jumlah Panen (kg)</label>
                    <input type="number" min="0" step="any" class="form-control <?= ($validation->hasError('prakiraan_jumlah_panen')) ? 'is-invalid' : ''; ?>" id="prakiraan_jumlah_panen" name="prakiraan_jumlah_panen" value="<?= (old('prakiraan_jumlah_panen')) ? old('prakiraan_jumlah_panen') : $ikan['prakiraan_jumlah_panen']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('prakiraan_jumlah_panen'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="waktu_prakiraan_panen" class="form-label">Waktu Prakiraan Panen</label>
                        <input type="date" class="form-control <?= ($validation->hasError('waktu_prakiraan_panen')) ? 'is-invalid' : ''; ?>" id="waktu_prakiraan_panen" name="waktu_prakiraan_panen" value="<?= (old('waktu_prakiraan_panen')) ? old('waktu_prakiraan_panen') : $ikan['waktu_prakiraan_panen']; ?>">
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
                    <a href="<?= base_url(); ?>/dataIkan" class="btn btn-secondary" type="button">Kembali</a>
                    <button class="btn btn-primary me-md-2" type="submit">Ubah</button>
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
    function updateDurasiTanam() {
        const jenisIkanSelect = document.getElementById('jenis_ikan');
        const durasiTanamInput = document.getElementById('durasi_tanam');

        if (!jenisIkanSelect || !durasiTanamInput) return;

        const selectedOption = jenisIkanSelect.options[jenisIkanSelect.selectedIndex];
        const durasiTanam = parseInt(selectedOption.getAttribute('data-durasi')) || 0;

        durasiTanamInput.value = durasiTanam;

        updatePrakiraanPanen();
    }

    function updatePrakiraanPanen() {
        const waktuPakanInput = document.getElementById('waktu_pakan');
        const durasiTanamInput = document.getElementById('durasi_tanam');
        const waktuPrakiraanPanenInput = document.getElementById('waktu_prakiraan_panen');

        if (!waktuPakanInput || !durasiTanamInput || !waktuPrakiraanPanenInput) return;

        const waktuPakan = waktuPakanInput.value;
        const durasiTanam = parseInt(durasiTanamInput.value) || 0;

        if (waktuPakan && durasiTanam) {
            const pakanDate = new Date(waktuPakan);
            pakanDate.setDate(pakanDate.getDate() + durasiTanam);

            const prakiraanPanenDate = pakanDate.toISOString().split('T')[0];
            waktuPrakiraanPanenInput.value = prakiraanPanenDate;
        } else {
            waktuPrakiraanPanenInput.value = '';
        }
    }

    document.getElementById('waktu_pakan')?.addEventListener('change', updatePrakiraanPanen);
    document.getElementById('jenis_ikan')?.addEventListener('change', updateDurasiTanam);
</script>

<?= $this->endSection(); ?>