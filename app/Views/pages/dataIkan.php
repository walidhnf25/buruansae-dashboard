<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h1 class="label-tambah-data"><b id="headerTitle">Data Ikan</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="row mt-3">
    <div class="col-3">
      <a href="<?= base_url(); ?>/dataIkan/tambahDataIkan" class="btn btn-primary">Tambah Data</a>
    </div>
    
    <div class="col-6 d-flex justify-content-center">
      <!-- Tombol Sudah Panen -->
      <a href="<?= base_url(); ?>/dataIkan?filter=sudah_panen" 
        class="btn btn-primary mx-2 d-flex align-items-center" 
        id="btnSudahPanen">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check me-2">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M5 12l5 5l10 -10" />
          </svg>
          Sudah Panen
      </a>

      <!-- Tombol Akan Panen -->
      <a href="<?= base_url(); ?>/dataIkan?filter=akan_panen" 
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

  <div class="table-responsive-sm">
    <table id="tablehome" class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Waktu Pakan</th>
          <th scope="col">Jenis Ikan</th>
          <th scope="col">Kelompok</th>
          <th scope="col">Penyuluh</th>
          <th scope="col">Pendamping</th>
          <th scope="col">Kecamatan</th>
          <th scope="col">Kelurahan</th>
          <th scope="col">RW</th>
          <th scope="col">Jumlah Ikan</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_ikan as $ikan) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $ikan['waktu_pakan']; ?></td>
            <td><?= $ikan['jenis_ikan']; ?></td>
            <td><?= $ikan['nama_kelompok']; ?></td>
            <td><?= $ikan['penyuluh']; ?></td>
            <td><?= $ikan['pendamping']; ?></td>
            <td><?= $ikan['kecamatan']; ?></td>
            <td><?= $ikan['kelurahan']; ?></td>
            <td><?= $ikan['rw']; ?></td>
            <td><?= $ikan['jumlah_ikan']; ?></td>
            <td>
              <?php if (!isset($ikan['waktu_panen']) || $ikan['waktu_panen'] == null) : ?>
                  <!-- Ikon Panen -->
                  <a href="<?= base_url(); ?>/dataIkan/dataPanenIkan/<?= $ikan['id_ikan']; ?>" class="text-success mx-2" title="Panen">
                      <i class="fas fa-seedling"></i>
                  </a>
                  <!-- Ikon Edit -->
                  <a href="<?= base_url(); ?>/dataIkan/editDataIkan/<?= $ikan['id_ikan']; ?>" class="text-warning mx-2" title="Edit">
                      <i class="fas fa-edit"></i>
                  </a>
                  <!-- Ikon Delete -->
                  <?php if (isset($ikan['id_ikan'])) : ?>
                      <form action="/dataIkan/<?= $ikan['id_ikan']; ?>" method="post" class="d-inline">
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
                  <!-- Ikon Edit Data Panen -->
                  <a href="<?= base_url(); ?>/dataIkan/dataPanenIkan/<?= $ikan['id_ikan']; ?>" class="text-warning mx-2" title="Edit Data Panen">
                      <i class="fas fa-edit"></i>
                  </a>
                  <!-- Ikon Delete -->
                  <?php if (isset($ikan['id_ikan'])) : ?>
                      <form action="/dataIkan/<?= $ikan['id_ikan']; ?>" method="post" class="d-inline">
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
          let headerText = 'Data Ikan'; // Default
          if (filter === 'sudah_panen') {
              headerText = 'Data Ikan Sudah Panen';
          } else if (filter === 'akan_panen') {
              headerText = 'Data Ikan Akan Panen';
          }
          $('#headerTitle').text(headerText);
      }
  });
</script>
<?= $this->endSection(); ?>