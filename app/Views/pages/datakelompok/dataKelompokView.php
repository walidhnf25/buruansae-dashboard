<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="tittle">
        <h2 class="label-tambah-data"><b>Tabel List Data Kelompok</b></h2>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Button trigger modal -->
    <div class="tabel_sayur my-3">
        <a href="<?= base_url(); ?>/DataKelompok/tambahDataKelompok" class="btn btn-primary">Tambah Data</a>
    </div>

    <div class="table-responsive-lg">
        <table id="tableKelompok" class="table table-bordered table-hover ">
            <thead class="align-middle ">
                <tr class="align-middle">
                    <th scope="col">No</th>
                    <th scope="col">Penyuluh</th>
                    <th scope="col">Pendamping</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">RW</th>
                    <th scope="col">Kelompok</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($data_kelompok as $kelompok) : ?>
                    <tr class="table-light align-middle">
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $kelompok['penyuluh']; ?></td>
                        <td><?= $kelompok['pendamping']; ?></td>
                        <td><?= $kelompok['kecamatan']; ?></td>
                        <td><?= $kelompok['kelurahan']; ?></td>
                        <td><?= $kelompok['rw']; ?></td>
                        <td><?= $kelompok['nama_kelompok']; ?></td>
                        <td>
                            <?php if (isset($kelompok['id_kelompok'])) : ?>
                                <a href="<?= base_url(); ?>/DataKelompok/editDataKelompok/<?= $kelompok['id_kelompok']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/DataKelompok/<?= $kelompok['id_kelompok']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>