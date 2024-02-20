<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="tittle">
    <h2 class="label-tambah-data"><b>Data Pengolahan Sampah</b></h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Button trigger modal -->
  <div class="tabel_sayur my-3">
    <a href="<?= base_url(); ?>/dataPengolahanSampah/tambahDataSampah" class="btn btn-primary">TambahData</a>
  </div>

  <div class="table-responsive-sm">
    <table class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Tanggal Masuk</th>
          <th scope="col">Jenis Pengolahan</th>
          <th scope="col">Jumlah Sampah</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
        <?php foreach ($data_sampah as $sampah) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $sampah['tanggal_masuk']; ?></td>
            <td><?= $sampah['jenis_pengolahan']; ?></td>
            <td><?= $sampah['jumlah_sampah']; ?></td>
            <td>
              <?php if ($sampah['waktu_sebaran'] == null) { ?>
                <a href="<?= base_url(); ?>/dataPengolahanSampah/dataProduksiSampah/<?= $sampah['id_data_sampah']; ?>" class="btn btn-success">Produksi</a>

                <a href="<?= base_url(); ?>/dataPengolahanSampah/editDataSampah/<?= $sampah['id_data_sampah']; ?>" class="btn btn-warning">Edit</a>

                <form action="<?= base_url(); ?>/dataPengolahanSampah/<?= $sampah['id_data_sampah']; ?>" method="post" class="d-inline">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                </form>
              <?php } else { ?>
                <span class="badge bg-success">Sudah Produksi</span>
                <a href="<?= base_url(); ?>/dataPengolahanSampah/dataProduksiSampah/<?= $sampah['id_data_sampah']; ?>" class="btn btn-warning">Edit Data Produksi</a>
                <form action="<?= base_url(); ?>/dataPengolahanSampah/<?= $sampah['id_data_sampah']; ?>" method="post" class="d-inline">
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
    <?= $pager->links('data_sampah', 'pagination_dataTernak'); ?>
  </div>
</div>

<?= $this->endSection(); ?>