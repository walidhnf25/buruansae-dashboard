<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Code Here -->
<div class="container">
    <div class="tittle">
        <h2 class="label-tambah-data"><b>Data Komoditi</b></h2>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- rest code -->
    <div class="row">
        <div class="col">
            <a href="/DataKomoditi/createDataKomoditi" class="btn btn-primary mt-3">Tambah Data Komoditi</a>
            <table id="tableKomoditi" class="table table-responsive-lg table-bordered table-hover">
                <thead class="align-middle">
                    <tr class="align-middle">
                        <th scope="col">No</th>
                        <th scope="col">Nama Komoditi</th>
                        <th scope="col">Sektor</th>
                        <th scope="col">Durasi Tanam</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data_komoditi as $dk) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $dk['nama_komoditi']; ?></td>
                            <td><?= $dk['sektor']; ?></td>
                            <td><?= $dk['durasi_tanam']; ?></td>
                            <td>
                                <a href="/DataKomoditi/edit/<?= $dk['id_komoditi']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/DataKomoditi/delete/<?= $dk['id_komoditi']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>