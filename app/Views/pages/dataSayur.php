<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h1 class="label-tambah-data"><b id="headerTitle">Data Sayur</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="row mt-3">
    <div class="col-3">
      <a href="<?= base_url(); ?>/dataSayur/tambahDataSayur" class="btn btn-primary">Tambah Data</a>
    </div>
    
    <div class="col-6 d-flex justify-content-center">
      <!-- Tombol Sudah Panen -->
      <a href="<?= base_url(); ?>/dataSayur?filter=sudah_panen" 
        class="btn btn-primary mx-2 d-flex align-items-center" 
        id="btnSudahPanen">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check me-2">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M5 12l5 5l10 -10" />
          </svg>
          Sudah Panen
      </a>

      <!-- Tombol Akan Panen -->
      <a href="<?= base_url(); ?>/dataSayur?filter=akan_panen" 
        class="btn btn-primary mx-2 d-flex align-items-center" 
        id="btnAkanPanen">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icon-tabler-clock-hour-4 me-2">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-5 2.66a1 1 0 0 0 -1 1v5.026l.009 .105l.02 .107l.04 .129l.048 .102l.046 .078l.042 .06l.069 .08l.088 .083l.083 .062l3 2a1 1 0 1 0 1.11 -1.664l-2.555 -1.704v-4.464a1 1 0 0 0 -.883 -.993z"/>
          </svg>
          Akan Panen
      </a>
    </div>
  </div>

  <!-- Button trigger modal -->
  <div class="table-responsive-lg">
  <table id="tablehome" class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Nama Sayur</th>
          <th scope="col">Kelompok</th>
          <th scope="col">Penyuluh</th>
          <th scope="col">Pendamping</th>
          <th scope="col">Kecamatan</th>
          <th scope="col">Kelurahan</th>
          <th scope="col">RW</th>
          <th scope="col">Tanggal Tanam</th>
          <th scope="col">Jumlah Tanam</th>
          
          <th scope="col">
            <?php if (!empty($data_sayur)) : ?>
                <?php 
                    $hasNull = false;
                    $hasNonNull = false;
                    
                    foreach ($data_sayur as $item) {
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
                    Waktu Panen/Waktu Prakiraan Panen
                <?php elseif ($hasNull) : ?>
                    Waktu Prakiraan Panen
                <?php elseif ($hasNonNull) : ?>
                    Waktu Panen
                <?php endif; ?>
            <?php else : ?>
                Waktu Panen/Waktu Prakiraan Panen
            <?php endif; ?>
          </th>

          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_sayur as $sayur) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $sayur['nama_sayur']; ?></td>
            <td><?= $sayur['nama_kelompok']; ?></td>
            <td><?= $sayur['penyuluh']; ?></td>
            <td><?= $sayur['pendamping']; ?></td>
            <td><?= $sayur['kecamatan']; ?></td>
            <td><?= $sayur['kelurahan']; ?></td>
            <td><?= $sayur['rw']; ?></td>
            <td><?= $sayur['tanggal_tanam']; ?></td>
            <td><?= $sayur['jumlah_tanam'] . ' ' . $sayur['kategori_tumbuhan'] . ''; ?></td>

            <!-- Waktu Panen / Prakiraan Panen -->
            <td>
              <?php if ($sayur['waktu_panen'] === null) : ?>
                <!-- If waktu_panen is null, display Waktu Prakiraan Panen -->
                <?= $sayur['waktu_prakiraan_panen'] ?? '-'; ?>
              <?php else : ?>
                <!-- If waktu_panen is not null, display Waktu Panen -->
                <?= $sayur['waktu_panen'] ?? '-'; ?>
              <?php endif; ?>
            </td>

            <td>
              <?php if (!isset($sayur['waktu_panen']) || $sayur['waktu_panen'] == null) : ?>
                  <!-- Tombol Panen -->
                  <a href="<?= base_url(); ?>/dataSayur/dataPanenSayur/<?= $sayur['id_sayur']; ?>" class="text-success mx-2" title="Panen">
                      <i class="fas fa-seedling"></i>
                  </a>
                  <!-- Tombol Edit -->
                  <a href="<?= base_url(); ?>/dataSayur/editDataSayur/<?= $sayur['id_sayur']; ?>" class="text-warning mx-2" title="Edit">
                      <i class="fas fa-edit"></i>
                  </a>
                  <!-- Tombol Delete -->
                  <?php if (isset($sayur['id_sayur'])) : ?>
                      <form action="/dataSayur/<?= $sayur['id_sayur']; ?>" method="post" class="d-inline">
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
                  <a href="<?= base_url(); ?>/dataSayur/dataPanenSayur/<?= $sayur['id_sayur']; ?>" class="text-warning mx-2" title="Edit Data Panen">
                      <i class="fas fa-edit"></i>
                  </a>
                  <!-- Tombol Delete -->
                  <?php if (isset($sayur['id_sayur'])) : ?>
                      <form action="/dataSayur/<?= $sayur['id_sayur']; ?>" method="post" class="d-inline">
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
          let headerText = 'Data Sayur'; // Default
          if (filter === 'sudah_panen') {
              headerText = 'Data Sayur Sudah Panen';
          } else if (filter === 'akan_panen') {
              headerText = 'Data Sayur Akan Panen';
          }
          $('#headerTitle').text(headerText);
      }
  });
</script>
<?= $this->endSection(); ?>