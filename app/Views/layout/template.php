<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/style.css" />

  <!-- font google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<title><?= $tittle ?></title>

<body>
  <!-- navbar -->
  <nav class="navigasi">

    <div class="logo-nav">
      <img src="<?= base_url(); ?>/asset/logo-k.png" alt="">
    </div>
    <div class="menu-toggle">
      <input type="checkbox" />
      <span></span>
      <span></span>
      <span></span>
    </div>
    <ul class="menu-list">
      <li><a href="<?= base_url("/Home"); ?>"><strong>Home</strong></a></li>
      <li><a href="<?= base_url(); ?>/DataPanen"><strong>Data Panen</strong></a></li>
      <!-- <li class="btn-profile"><i data-feather="user" ></i></li> -->
    </ul>
    <div class="btn-profile">
      <i data-feather="user"></i>
      <div id="profile">
        <p>Afif Dhiaulhaq</p>
        <button><a href="Login.php">Keluar</a></button>
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

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



</html>