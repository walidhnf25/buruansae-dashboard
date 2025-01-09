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

  <div class="row mt-3">
    <div class="col-3">
      <a href="<?= base_url(); ?>/dataBuah/tambahDataBuah" class="btn btn-primary">Tambah Data</a>
    </div>
    
    <div class="col-6 d-flex justify-content-center">
        <a href="<?= base_url(); ?>/dataBuah?filter=sudah_panen" class="btn btn-success mx-2">Sudah Panen</a>
        <a href="<?= base_url(); ?>/dataBuah?filter=akan_panen" class="btn btn-primary mx-2">Akan Panen</a>
    </div>
  </div>

  <div class="table-responsive-sm">
    <table id="tablehome" class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Nama Buah</th>
          <th scope="col">Kelompok</th>
          <th scope="col">Penyuluh</th>
          <th scope="col">Pendamping</th>
          <th scope="col">Kecamatan</th>
          <th scope="col">Kelurahan</th>
          <th scope="col">RW</th>
          <th scope="col">Tanggal Tanam</th>
          <th scope="col">Kategori Tumbuhan</th>
          <th scope="col">Jumlah Tanam</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_buah as $buah) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $buah['nama_buah']; ?></td>
            <td><?= $buah['nama_kelompok']; ?></td>
            <td><?= $buah['penyuluh']; ?></td>
            <td><?= $buah['pendamping']; ?></td>
            <td><?= $buah['kecamatan']; ?></td>
            <td><?= $buah['kelurahan']; ?></td>
            <td><?= $buah['rw']; ?></td>
            <td><?= $buah['tanggal_tanam']; ?></td>
            <td><?= $buah['kategori_tumbuhan']; ?></td>
            <td><?= $buah['jumlah_tanam']; ?></td>
            <td>
              <?php if (!isset($buah['waktu_panen']) || $buah['waktu_panen'] == null) : ?>
                <a href="<?= base_url(); ?>/dataBuah/dataPanenBuah/<?= $buah['id_buah']; ?>" class="btn btn-success mb-2">Panen</a>
                <a href="<?= base_url(); ?>/dataBuah/editBuah/<?= $buah['id_buah']; ?>" class="btn btn-warning mb-2">Edit</a>
                <?php if (isset($buah['id_buah'])) : ?>
                  <form action="/dataBuah/<?= $buah['id_buah']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                  </form>
                <?php endif; ?>
              <?php else : ?>
                <span class="badge bg-success mb-2">Sudah Panen</span>
                <a href="<?= base_url(); ?>/dataBuah/dataPanenBuah/<?= $buah['id_buah']; ?>" class="btn btn-warning mb-2">Edit Data Buah</a>
                <?php if (isset($buah['id_buah'])) : ?>
                  <form action="/dataBuah/<?= $buah['id_buah']; ?>" method="post" class="d-inline">
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