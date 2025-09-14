<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container w-100" style="max-width: 90%;">
  <div class="tittle">
    <h1 class="label-tambah-data"><b>Data Olahan Hasil</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="row mt-3">
    <div class="col-3">
      <a href="<?= base_url(); ?>/dataOlahanHasil/tambahDataOlahanHasil" class="btn btn-primary">Tambah Data</a>
    </div>
    
    <div class="col-6 d-flex justify-content-center">
      <!-- Tombol Sudah Panen -->
      <a href="<?= base_url(); ?>/dataOlahanHasil?filter=sudah_panen" 
        class="btn btn-primary mx-2 d-flex align-items-center" 
        id="btnSudahPanen">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check me-2">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M5 12l5 5l10 -10" />
          </svg>
          Sudah Panen
      </a>

      <!-- Tombol Akan Panen -->
      <a href="<?= base_url(); ?>/dataOlahanHasil?filter=akan_panen" 
        class="btn btn-primary position-relative mx-2 d-flex align-items-center" 
        id="btnAkanPanen">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icon-tabler-clock-hour-4 me-2">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-5 2.66a1 1 0 0 0 -1 1v5.026l.009 .105l.02 .107l.04 .129l.048 .102l.046 .078l.042 .06l.069 .08l.088 .083l.083 .062l3 2a1 1 0 1 0 1.11 -1.664l-2.555 -1.704v-4.464a1 1 0 0 0 -.883 -.993z"/>
          </svg>
          Akan Panen
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-6">
            <?= $jumlahTerlambatPanen; ?>
        </span>
      </a>
    </div>
  </div>

  <?php if ($filter == 'akan_panen' && $jumlahTerlambatPanen > 0) : ?>
    <div class="alert alert-light shadow-sm rounded-pill px-4 py-3 mt-4 text-center custom-alert-text" role="alert">
      <strong>Terdapat <?= $jumlahTerlambatPanen; ?> Komoditi yang Sudah Melewati Waktu Panen</strong>
    </div>
  <?php endif; ?>

  <div class="table-responsive-sm">
    <table id="tablehome" class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Jenis Olahan</th>
          <th scope="col">Kelompok</th>
          <th scope="col">Penyuluh</th>
          <th scope="col">Pendamping</th>
          <th scope="col">Kecamatan</th>
          <th scope="col">Kelurahan</th>
          <th scope="col">RW</th>
          <th scope="col">Bahan Dasar</th>
          <th scope="col">Merk</th>
          <th scope="col">Resep</th>
          <th scope="col">PIRT</th>
          <th scope="col">Halal</th>
          <th scope="col">Uji Lab</th>
          <th scope="col">
            <?php if (!empty($data_olahan_hasil)) : ?>
                <?php 
                    $hasNull = false;
                    $hasNonNull = false;
                    
                    foreach ($data_olahan_hasil as $item) {
                        if ($item['waktu_panen'] === null) {
                            $hasNull = true;
                        } else {
                            $hasNonNull = true;
                        }
                        
                        // Jika sudah ditemukan kedua kondisi, tidak perlu lanjut
                        if ($hasNull && $hasNonNull) break;
                    }
                ?>
                
                <?php if ($hasNull && $hasNonNull) : ?>
                    Waktu Panen/Tanggal Produksi
                <?php elseif ($hasNull) : ?>
                    Tanggal Produksi
                <?php elseif ($hasNonNull) : ?>
                    Waktu Panen
                <?php endif; ?>
            <?php else : ?>
                Waktu Panen/Tanggal Produksi
            <?php endif; ?>
          </th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_olahan_hasil as $olahan_hasil) : ?>
          <?php
            // Konversi tanggal_produksi ke timestamp
            $waktuProduksi = isset($olahan_hasil['tanggal_produksi']) ? strtotime($olahan_hasil['tanggal_produksi']) : null;
            $hariIni = strtotime(date('Y-m-d'));

            // Jika waktu_panen NULL dan tanggal_produksi adalah hari ini atau sudah lewat, beri warna merah
            $highlight = (is_null($olahan_hasil['waktu_panen']) && $waktuProduksi !== null && $waktuProduksi <= $hariIni) ? 'table-color' : '';
          ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $olahan_hasil['jenis_olahan']; ?></td>
            <td><?= $olahan_hasil['nama_kelompok']; ?></td>
            <td><?= $olahan_hasil['penyuluh']; ?></td>
            <td><?= $olahan_hasil['pendamping']; ?></td>
            <td><?= $olahan_hasil['kecamatan']; ?></td>
            <td><?= $olahan_hasil['kelurahan']; ?></td>
            <td><?= $olahan_hasil['rw']; ?></td>
            <td><?= $olahan_hasil['bahan_dasar']; ?></td>
            <td><?= $olahan_hasil['merk']; ?></td>
            <td><?= $olahan_hasil['resep']; ?></td>
            <td><?= $olahan_hasil['izin_pirt']; ?></td>
            <td><?= $olahan_hasil['izin_halal']; ?></td>
            <td><?= $olahan_hasil['uji_lab']; ?></td>

            <!-- Waktu Produksi -->
            <td class="<?= (is_null($olahan_hasil['waktu_panen']) && $waktuProduksi !== null && $waktuProduksi <= $hariIni) ? 'table-color' : ''; ?>">
              <?= $olahan_hasil['waktu_panen'] ?? ($olahan_hasil['tanggal_produksi'] ?? '-'); ?>
            </td>

            <td>
              <?php if (is_null($olahan_hasil['waktu_panen'])) : ?>
                <!-- Tombol Panen -->
                <a href="<?= base_url(); ?>/dataOlahanHasil/dataProduksi/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" 
                  class="text-success mx-2" 
                  title="Panen">
                  <i class="fas fa-seedling"></i>
                </a>

                <!-- Tombol Edit -->
                <a href="<?= base_url(); ?>/dataOlahanHasil/editDataOlahanHasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" 
                  class="text-warning mx-2" 
                  title="Edit">
                  <i class="fas fa-edit"></i>
                </a>

                <!-- Tombol Delete -->
                <?php if (isset($olahan_hasil['id_data_olahan_hasil'])) : ?>
                  <form action="/dataolahan_hasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-link text-danger p-0 mx-2" title="Delete" onclick="return confirm('Apakah anda yakin?');">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                <?php endif; ?>

              <?php else : ?>
                <!-- Badge Sudah Panen -->
                <span class="badge bg-success p-2" title="Sudah Panen">Sudah Panen</span>

                <!-- Tombol Edit Data Panen -->
                <a href="<?= base_url(); ?>/dataOlahanHasil/dataPanenOlahanHasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" 
                  class="text-warning mx-2" 
                  title="Edit Data Panen">
                  <i class="fas fa-edit"></i>
                </a>

                <!-- Tombol Delete -->
                <?php if (isset($olahan_hasil['id_data_olahan_hasil'])) : ?>
                  <form action="/dataolahan_hasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-link text-danger p-0 mx-2" title="Delete" onclick="return confirm('Apakah anda yakin?');">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Redirect jika tidak ada parameter filter di URL
  if (!window.location.search.includes("filter=")) {
      window.location.href = window.location.pathname + "?filter=sudah_panen";
  }
</script>
<script>
    $(document).ready(function () {
      // Ambil parameter filter dari URL
      const urlParams = new URLSearchParams(window.location.search);
      const filter = urlParams.get('filter') || ''; // Default kosong jika tidak ada filter

      // Tambahkan class 'active' pada tombol yang sesuai
      if (filter === 'sudah_panen') {
          $('#btnSudahPanen').addClass('active');
      } else if (filter === 'akan_panen') {
          $('#btnAkanPanen').addClass('active');
      }

      // Perbarui header berdasarkan filter
      updateHeaderTitle(filter);

      // Fungsi untuk memperbarui header
      function updateHeaderTitle(filter) {
          let headerText = 'Data olahan_hasil'; // Default
          if (filter === 'sudah_panen') {
              headerText = 'Data olahan_hasil Sudah Panen';
          } else if (filter === 'akan_panen') {
              headerText = 'Data olahan_hasil Akan Panen';
          }
          $('#headerTitle').text(headerText);
      }
  });

    document.addEventListener("DOMContentLoaded", function () {
        let btnAkanPanen = document.getElementById("btnAkanPanen");
        let alertBox = document.getElementById("alertAkanPanen");

        // Cek jika sebelumnya sudah diklik
        if (localStorage.getItem("akanPanenActive") === "true") {
            alertBox.style.display = "block";
        } else {
            alertBox.style.display = "none";
        }

        btnAkanPanen.addEventListener("click", function () {
            localStorage.setItem("akanPanenActive", "true");
            alertBox.style.display = "block";
        });
    });
</script>

</script>
<?= $this->endSection(); ?>