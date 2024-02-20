<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h1 class="label-tambah-data"><b>Data Buah</b></h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataBuah/tambahDataBuah" type="button" class="btn btn-primary">Tambah Data </a>
  </div>

  <div class="table-responsive-sm">
    <table class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Nama Buah</th>
          <th scope="col">Tanggal Tanam</th>
          <th scope="col">Kategori Tumbuhan</th>
          <th scope="col">Jumlah Tanam</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
        <?php foreach ($data_buah as $buah) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $buah['nama_buah']; ?></td>
            <td><?= $buah['tanggal_tanam']; ?></td>
            <td><?= $buah['kategori_tumbuhan']; ?></td>
            <td><?= $buah['jumlah_tanam']; ?></td>
            <td>
              <?php if ($buah['waktu_panen'] == null) { ?>
                <a href="<?= base_url(); ?>/dataBuah/dataPanenBuah/<?= $buah['id_buah']; ?>" class="btn btn-success">Panen</a>

                <a href="<?= base_url(); ?>/dataBuah/editBuah/<?= $buah['id_buah']; ?>" class="btn btn-warning">Edit</a>

                <form action="<?= base_url(); ?>/dataBuah/<?= $buah['id_buah']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php } else { ?>
                <span class="badge bg-success">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataBuah/dataPanenBuah/<?= $buah['id_buah']; ?>" class="btn btn-warning">Edit Data Panen</a>
                <form action="<?= base_url(); ?>/dataBuah/<?= $buah['id_buah']; ?>" method="post" class="d-inline">
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
    <?= $pager->links('data_buah', 'pagination_dataBuah'); ?>
  </div>
</div>

<?= $this->endSection(); ?>