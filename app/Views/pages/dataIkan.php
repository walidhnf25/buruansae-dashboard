<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h1 class="label-tambah-data"><b>Data Ikan</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataIkan/tambahDataIkan" class="btn btn-primary">Tambah Data</a>
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
          <th scope="col">Jumlah Pakan</th>
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
            <td><?= $ikan['jumlah_pakan']; ?></td>
            <td><?= $ikan['jumlah_ikan']; ?></td>
            <td>
              <?php if (!isset($ikan['waktu_panen']) || $ikan['waktu_panen'] == null) : ?>
                <a href="<?= base_url(); ?>/dataIkan/dataPanenIkan/<?= $ikan['id_ikan']; ?>" class="btn btn-success mb-2">Panen</a>
                <a href="<?= base_url(); ?>/dataIkan/editDataIkan/<?= $ikan['id_ikan']; ?>" class="btn btn-warning mb-2">Edit</a>
                <?php if (isset($ikan['id_ikan'])) : ?>
                  <form action="/dataIkan/<?= $ikan['id_ikan']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                  </form>
                <?php endif; ?>
              <?php else : ?>
                <span class="badge bg-success mb-2">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataIkan/dataPanenIkan/<?= $ikan['id_ikan']; ?>" class="btn btn-warning mb-2">Edit Data Panen</a>
                <?php if (isset($ikan['id_ikan'])) : ?>
                  <form action="/dataIkan/<?= $ikan['id_ikan']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
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

<?= $this->endSection(); ?>