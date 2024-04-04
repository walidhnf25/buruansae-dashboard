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
    <table id="tablehome" class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Tanggal Masuk</th>
          <th scope="col">Jenis Pengolahan</th>
          <th scope="col">Kelompok</th>
          <th scope="col">Penyuluh</th>
          <th scope="col">Pendamping</th>
          <th scope="col">Kecamatan</th>
          <th scope="col">Kelurahan</th>
          <th scope="col">RW</th>
          <th scope="col">Jumlah Sampah</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_sampah as $sampah) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $sampah['tanggal_masuk']; ?></td>
            <td><?= $sampah['jenis_pengolahan']; ?></td>
            <td><?= $sampah['nama_kelompok']; ?></td>
            <td><?= $sampah['penyuluh']; ?></td>
            <td><?= $sampah['pendamping']; ?></td>
            <td><?= $sampah['kecamatan']; ?></td>
            <td><?= $sampah['kelurahan']; ?></td>
            <td><?= $sampah['rw']; ?></td>
            <td><?= $sampah['jumlah_sampah']; ?></td>
            <td>
              <?php if (!isset($sampah['waktu_panen']) || $sampah['waktu_panen'] == null) : ?>
                <a href="<?= base_url(); ?>/dataPengolahanSampah/dataProduksiSampah/<?= $sampah['id_data_sampah']; ?>" class="btn btn-success mb-2">Panen</a>
                <a href="<?= base_url(); ?>/dataPengolahanSampah/editDataSampah/<?= $sampah['id_data_sampah']; ?>" class="btn btn-warning mb-2">Edit</a>
                <?php if (isset($sampah['id_data_sampah'])) : ?>
                  <form action="/dataPengolahanSampah/<?= $sampah['id_data_sampah']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                  </form>
                <?php endif; ?>
              <?php else : ?>
                <span class="badge bg-success mb-2">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataPengolahanSampah/dataPanenSampah/<?= $sampah['id_data_sampah']; ?>" class="btn btn-warning mb-2">Edit Data Sampah</a>
                <?php if (isset($sampah['id_data_sampah'])) : ?>
                  <form action="/dataPengolahanSampah/<?= $sampah['id_data_sampah']; ?>" method="post" class="d-inline">
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