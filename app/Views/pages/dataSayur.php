<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h2 class="label-tambah-data"><b>Data Sayur</b></h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataSayur/tambahDataSayur" class="btn btn-primary">Tambah Data</a>
  </div>

  <div class="table-responsive-sm">
    <table class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Nama Sayur</th>
          <th scope="col">Tanggal Tanam</th>
          <th scope="col">Ketegori Tumbuhan</th>
          <th scope="col">Jumlah Tanam</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
        <?php foreach ($data_sayur as $sayur) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $sayur['nama_sayur']; ?></td>
            <td><?= $sayur['tanggal_tanam']; ?></td>
            <td><?= $sayur['kategori_tumbuhan']; ?></td>
            <td><?= $sayur['jumlah_tanam']; ?></td>
            <td>
              <?php if ($sayur['waktu_panen'] == null) { ?>
                <a href="<?= base_url('/dataSayur/dataPanenSayur/' . $sayur['id_sayur']); ?>" class="btn btn-success">Panen</a>

                <a href="<?= base_url('/dataSayur/editDataSayur/' . $sayur['id_sayur']); ?>" class="btn btn-warning">Edit</a>

                <form action="/dataSayur/<?= $sayur['id_sayur']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php } else { ?>
                <span class="badge bg-success">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataSayur/dataPanenSayur/<?= $sayur['id_sayur']; ?>" class="btn btn-warning">Edit Data Panen</a>
                <form action="/dataSayur/<?= $sayur['id_sayur']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                <?php }; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?= $pager->links('data_sayur', 'pagination_sayur'); ?>
  </div>
</div>

<?= $this->endSection(); ?>