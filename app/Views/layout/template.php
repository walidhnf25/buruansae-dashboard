<?php

use App\Controllers\Home;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Include Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/style.css" />

  <!-- font google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<title><?= $tittle ?></title>

<body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



  <!-- navbar -->
  <nav class="navbar navbar-expand-xl navbar-light" style="background-color: rgb(83, 136, 83);" aria-label="Sixth navbar example">
    <div class="container-fluid justify-content-between align-center mx-3">
      <a class="navbar-brand" href="/Home">
        <img src="<?= base_url(); ?>/asset/logo-k.png" style="width: 150px;" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
          <li class="nav-item me-5">
            <a href="<?= base_url('Home'); ?>" class="nav-font"><strong>Home</strong></a>
          </li>
          <!-- <li class="nav-item me-5">
            <a href="<?= base_url('DataPanen'); ?>" class="nav-font" disabled><strong>Data Panen</strong></a>
          </li> -->
          <li class="nav-item me-5">
            <a href="<?= base_url('DataKelompok'); ?>" class="nav-font"><strong>Data Kelompok</strong></a>
          </li>
          <li class="nav-item me-5">
            <a href="<?= base_url('DataKomoditi'); ?>" class="nav-font"><strong>Data Komoditi</strong></a>
          </li>
        </ul>
        <ul class="nav-item dropdown">
          <a class="nav-link" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
            </svg>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown06">
            <li class="dropdown-item" style="pointer-events: none;">
            <li><a class="dropdown-item" href="<?= base_url(); ?>/logout">Log Out</a></li>
          </ul>
        </ul>
      </div>
    </div>
  </nav>
  <?= $this->renderSection('content'); ?>

  <script>
    function previewImg() {
      const gambar = document.querySelector('#gambar');
      const imgPreview = document.querySelectorAll('.img-preview');

      const fileGambar = new FileReader();
      fileGambar.readAsDataURL(gambar.files[0]);

      fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
      };
    }
  </script>
</body>


<script src="profile.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
  const menuToggle = document.querySelector(".menu-toggle input");
  const nav = document.querySelector("nav ul");

  menuToggle.addEventListener("click", function() {
    nav.classList.toggle("slide");
  });

  feather.replace()
</script>
<!-- footer -->

<!-- DATA TABLE -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
  new DataTable("#tablehome");
  new DataTable("#tableKelompok");
  new DataTable("#tableKomoditi")
  new DataTable("#tablePanensayur");
  new DataTable("#tablePanenobat");
  new DataTable("#tablePanenternak");
  new DataTable("#tablePanenikan");
  new DataTable("#tablePanenbuah");
  new DataTable("#tablePanenolahan");
  new DataTable("#tablePanensampah");
</script>

<script>
  $(document).ready(function() {
    $('select[name="id_kelompok"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="nama_sayur"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="nama_buah"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="jenis_ikan"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="nama_tanaman_obat"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="jenis_ternak"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="jenis_olahan"]').select2({
      theme: 'bootstrap-5'
    });
    $('select[name="jenis_pengolahan"]').select2({
      theme: 'bootstrap-5'
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('select[name="id_kelompok"]').change(function() {
      var selectedOption = $(this).find('option:selected');
      var penyuluh = selectedOption.data('penyuluh');
      var pendamping = selectedOption.data('pendamping');
      var kecamatan = selectedOption.data('kecamatan');
      var kelurahan = selectedOption.data('kelurahan');
      $('input[name="penyuluh"]').val(penyuluh);
      $('input[name="pendamping"]').val(pendamping);
      $('input[name="kecamatan"]').val(kecamatan);
      $('input[name="kelurahan"]').val(kelurahan);
    });
  });
</script>

</html>