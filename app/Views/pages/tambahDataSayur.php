<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container tambah my-5">
    <div class="row">
        <h2 class="label-tambah-data mb-3">Tambah Data Sayur</h2>
        <div class="col-12">
            <form action="<?= base_url(); ?>/dataSayur/save" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama_sayur" class="form-label">Nama Sayur</label>
                    <select class="form-select <?= ($validation->hasError('nama_sayur')) ? 'is-invalid' : ''; ?>" 
                            name="nama_sayur" 
                            id="nama_sayur" 
                            onchange="updatePrakiraanPanen()">
                        <option value="" class="hidden" style="display: none;">--Pilih Sayur--</option>
                        <?php foreach ($komoditi as $k) : ?>
                            <option value="<?= $k['nama_komoditi'] ?>" data-durasi="<?= $k['durasi_tanam'] ?>">
                                <?= $k['nama_komoditi'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_sayur'); ?>
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
                    <label for="waktu_prakiraan_panen" class="form-label">Waktu Prakiraan Panen</label>
                    <input type="date" 
                        class="form-control" 
                        id="waktu_prakiraan_panen" 
                        name="waktu_prakiraan_panen" 
                        readonly>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="<?= base_url(); ?>/dataSayur" class="btn btn-secondary" type="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Update input field values when id_kelompok is changed
        $('select[name="id_kelompok"]').change(function() {
            const selectedOption = $(this).find('option:selected');
            const penyuluh = selectedOption.data('penyuluh') || '';
            const pendamping = selectedOption.data('pendamping') || '';
            const kecamatan = selectedOption.data('kecamatan') || '';
            const kelurahan = selectedOption.data('kelurahan') || '';
            
            // Set the values in the respective input fields
            $('input[name="penyuluh"]').val(penyuluh);
            $('input[name="pendamping"]').val(pendamping);
            $('input[name="kecamatan"]').val(kecamatan);
            $('input[name="kelurahan"]').val(kelurahan);
        });

        // Update waktu_prakiraan_panen when nama_sayur or tanggal_tanam changes
        $('#nama_sayur, #tanggal_tanam').on('change', updatePrakiraanPanen);
    });

    // Function to calculate and update waktu_prakiraan_panen
    function updatePrakiraanPanen() {
        // Get elements
        const namaSayurSelect = document.getElementById('nama_sayur');
        const tanggalTanamInput = document.getElementById('tanggal_tanam');
        const waktuPrakiraanPanenInput = document.getElementById('waktu_prakiraan_panen');
        
        // Get durasi tanam from selected option
        const selectedOption = namaSayurSelect.options[namaSayurSelect.selectedIndex];
        const durasiTanam = parseInt(selectedOption.getAttribute('data-durasi')) || 0;
        
        // Get tanggal_tanam value
        const tanggalTanam = tanggalTanamInput.value;

        if (tanggalTanam && durasiTanam) {
            // Parse tanggal_tanam into a date object
            const tanamDate = new Date(tanggalTanam);

            // Add durasiTanam days to the date
            tanamDate.setDate(tanamDate.getDate() + durasiTanam);

            // Format date into yyyy-mm-dd
            const panenDate = tanamDate.toISOString().split('T')[0];

            // Set value to waktu_prakiraan_panen input
            waktuPrakiraanPanenInput.value = panenDate;
        } else {
            // Clear waktu_prakiraan_panen if inputs are invalid
            waktuPrakiraanPanenInput.value = '';
        }
    }
</script>
<?= $this->endSection(); ?>