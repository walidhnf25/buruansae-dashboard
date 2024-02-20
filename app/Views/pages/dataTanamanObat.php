<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h2 class="label-tambah-data"><b>Data TanamanObat</b></h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataTanamanObat/tambahDataTamananObat" class="btn btn-primary">Tambah Data</a>
  </div>

  <div class="table-responsive-sm">
    <table class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Nama Tanaman Obat</th>
          <th scope="col">Tanggal Tanam</th>
          <th scope="col">Kategori Tumbuhan</th>
          <th scope="col">Jumlah Tanam</th>
          <th scope="col">Jumlah Tanam</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
        <?php foreach ($data_tanaman_obat as $obat) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $obat['nama_tanaman_obat']; ?></td>
            <td><?= $obat['tanggal_tanam']; ?></td>
            <td><?= $obat['kategori_tumbuhan']; ?></td>
            <td><?= $obat['jumlah_tanam']; ?></td>
            <td>
              <?php if ($obat['waktu_panen'] == null) { ?>
                <a href="<?= base_url(); ?>/dataTanamanObat/dataPanenTanamanObat/<?= $obat['id_tanaman_obat']; ?>" class="btn btn-success">Panen</a>

                <a href="<?= base_url(); ?>/dataTanamanObat/editDataTanamanObat/<?= $obat['id_tanaman_obat']; ?>" class="btn btn-warning">Edit</a>

                <form action="<?= base_url(); ?>/dataTanamanObat/<?= $obat['id_tanaman_obat']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php } else { ?>
                <span class="badge bg-success">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataTanamanObat/dataPanenTanamanObat/<?= $obat['id_tanaman_obat']; ?>" class="btn btn-warning">Edit Data Panen</a>
                <form action="<?= base_url(); ?>/dataTanamanObat/<?= $obat['id_tanaman_obat']; ?>" method="post" class="d-inline">
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
    <?= $pager->links('data_tanaman_obat', 'pagination_tanamanObat') ?>
  </div>
</div>

<?= $this->endSection(); ?>