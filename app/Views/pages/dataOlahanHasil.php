<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h1 class="label-tambah-data"><b>Data Olahan Hasil</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataOlahanHasil/tambahDataOlahanHasil" class="btn btn-primary">Tambah Data</a>
  </div>

  <div class="table-responsive-sm">
    <table class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Tanggal Produksi</th>
          <th scope="col">Jenis Olahan</th>
          <th scope="col">Bahan Dasar</th>
          <th scope="col">Merk</th>
          <th scope="col">Resep</th>
          <th scope="col">PIRT</th>
          <th scope="col">Halal</th>
          <th scope="col">Uji Lab</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
        <?php foreach ($data_olahan_hasil as $olahan_hasil) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $olahan_hasil['tanggal_produksi']; ?></td>
            <td><?= $olahan_hasil['jenis_olahan']; ?></td>
            <td><?= $olahan_hasil['bahan_dasar']; ?></td>
            <td><?= $olahan_hasil['merk']; ?></td>
            <td><?= $olahan_hasil['resep']; ?></td>
            <td><?= $olahan_hasil['izin_pirt']; ?></td>
            <td><?= $olahan_hasil['izin_halal']; ?></td>
            <td><?= $olahan_hasil['uji_lab']; ?></td>
            <td>
              <?php if ($olahan_hasil['waktu_jual'] == null) { ?>
                <a href="<?= base_url(); ?>/dataOlahanHasil/dataProduksi/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" class="btn btn-success">Produksi</a>

                <a href="<?= base_url(); ?>/dataOlahanHasil/editDataOlahanHasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" class="btn btn-warning">Edit</a>

                <form action="<?= base_url(); ?>/dataOlahanHasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php } else { ?>
                <span class="badge bg-success">Sudah Produksi</span>
                <a href="<?= base_url(); ?>/dataOlahanHasil/dataProduksi/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" class="btn btn-warning">Edit Data Produksi</a>
                <form action="<?= base_url(); ?>/dataOlahanHasil/<?= $olahan_hasil['id_data_olahan_hasil']; ?>" method="post" class="d-inline">
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
    <?= $pager->links('data_olahan_hasil', 'pagination_sayur'); ?>
  </div>
</div>

<?= $this->endSection(); ?>