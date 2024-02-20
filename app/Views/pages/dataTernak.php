<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h1 class="label-tambah-data"><b>Data Ternak</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataTernak/tambahDataTernak" class="btn btn-primary">Tambah Data</a>
  </div>


  <div class="table-responsive-sm">
    <table class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Waktu Pakan</th>
          <th scope="col">Jenis Ternak</th>
          <th scope="col">Jumlah Pakan</th>
          <th scope="col">Jumlah Ternak</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
        <?php foreach ($data_ternak as $ternak) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $ternak['waktu_pakan']; ?></td>
            <td><?= $ternak['jenis_ternak']; ?></td>
            <td><?= $ternak['jumlah_pakan']; ?></td>
            <td><?= $ternak['jumlah_ternak']; ?></td>
            <td>
              <?php if ($ternak['waktu_panen'] == null) { ?>
                <a href="<?= base_url(); ?>/dataTernak/dataPanenTernak/<?= $ternak['id_ternak']; ?>" class="btn btn-success">Panen</a>

                <a href="<?= base_url(); ?>/dataTernak/editDataTernak/<?= $ternak['id_ternak']; ?>" class="btn btn-warning">Edit</a>

                <form action="<?= base_url(); ?>/dataTernak/<?= $ternak['id_ternak']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php } else { ?>
                <span class="badge bg-success">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataTernak/dataPanenTernak/<?= $ternak['id_ternak']; ?>" class="btn btn-warning">Edit Data Panen</a>
                <form action="<?= base_url(); ?>/dataTernak/<?= $ternak['id_ternak']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php }; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?= $pager->links('data_ternak', 'pagination_dataTernak'); ?>
  </div>
</div>

<?= $this->endSection(); ?>