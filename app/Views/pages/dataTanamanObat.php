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

  <div class="row mt-3">
    <div class="col-3">
      <a href="<?= base_url(); ?>/dataTanamanObat/tambahDataTanamanObat" class="btn btn-primary">Tambah Data</a>
    </div>
    
    <div class="col-6 d-flex justify-content-center">
        <a href="<?= base_url(); ?>/dataTanamanObat?filter=sudah_panen" class="btn btn-success mx-2">Sudah Panen</a>
        <a href="<?= base_url(); ?>/dataTanamanObat?filter=akan_panen" class="btn btn-primary mx-2">Akan Panen</a>
    </div>
  </div>

  <div class="table-responsive-sm">
    <table id="tablehome" class="table table-bordered table-hover ">
      <thead class="table-dark align-middle ">
        <tr class="align-middle">
          <th scope="col">No</th>
          <th scope="col">Nama Tanaman Obat</th>
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
        <?php foreach ($data_tanaman_obat as $obat) : ?>
          <tr class="table-light align-middle">
            <th scope="row"><?= $i++; ?></th>
            <td><?= $obat['nama_tanaman_obat']; ?></td>
            <td><?= $obat['nama_kelompok']; ?></td>
            <td><?= $obat['penyuluh']; ?></td>
            <td><?= $obat['pendamping']; ?></td>
            <td><?= $obat['kecamatan']; ?></td>
            <td><?= $obat['kelurahan']; ?></td>
            <td><?= $obat['rw']; ?></td>
            <td><?= $obat['tanggal_tanam']; ?></td>
            <td><?= $obat['kategori_tumbuhan']; ?></td>
            <td><?= $obat['jumlah_tanam']; ?></td>
            <td>
              <?php if (!isset($obat['waktu_panen']) || $obat['waktu_panen'] == null) : ?>
                <a href="<?= base_url(); ?>/dataTanamanObat/dataPanenTanamanObat/<?= $obat['id_tanaman_obat']; ?>" class="btn btn-success mb-2">Panen</a>
                <a href="<?= base_url(); ?>/dataTanamanObat/editDataTanamanObat/<?= $obat['id_tanaman_obat']; ?>" class="btn btn-warning mb-2">Edit</a>
                <?php if (isset($obat['id_tanaman_obat'])) : ?>
                  <form action="/dataTanamanObat/<?= $obat['id_tanaman_obat']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                  </form>
                <?php endif; ?>
              <?php else : ?>
                <span class="badge bg-success mb-2">SUDAH PANEN</span>
                <a href="<?= base_url(); ?>/dataTanamanObat/dataPanenTanamanObat/<?= $obat['id_tanaman_obat']; ?>" class="btn btn-warning mb-2">Edit Data Panen</a>
                <?php if (isset($obat['id_tanaman_obat'])) : ?>
                  <form action="/dataTanamanObat/<?= $obat['id_tanaman_obat']; ?>" method="post" class="d-inline">
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