<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
</head>


<style>
  body{
    font-family: Arial, sans-serif;
    font-size: 16px;
  }
    .banner{
        height: 80vh;
        background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('foto/siswi.jpg');
        background-size:cover;
        background-position: center;
    }
    .banner-content{
        height: 100%;
       font-family:   Arial, sans-serif;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .content{
        font-size: 20px;
        color: rgb(51, 102, 204);
    }
    .info{
        height: 60vh;
        background-color: rgb(51, 102, 204);
        background-size: contain;
        color: white;
        border: 1 px solid;
        margin-bottom: 10px;
    }
    .info h5{
      margin-top: 20px;
      margin-bottom: 20px;


    }
    
    .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2870, 130, 180, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}
.info img {
    width: 100%;
    border: 2px solid white;
  }
.navbar-toggler {
    border: 1px solid rgb(70, 130, 180);
}
.info .caption {
    margin-top: 10px;
  text-align: center;
    color: white;
  }
.footer {
    background-color: #f9f9f9;
    margin-top: 10px;
    color: rgb(51, 102, 204);
    text-align: center;
  }
</style>
<body>
   
        <!-- <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid content">
              <img class="navbar-brand " src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" height="80" >Sekolah Menengah Pertama</img>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" ></span>
              </button>
              <div class="collapse navbar-collapse content" id="navbarNav" >
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0"  >
                  <li class="nav-item" >
                    <a class="nav-link active" aria-current="page" href="UI_home.php" >Beranda</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="UI_VisiMisi.php" >Visi Misi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="UI_alur_pendaftaran.php"  >Alur Pendaftaran</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="form_login.php"><button type="button" class="btn btn-outline-info" style="height: 35px; font-size: 17px;  ">Login</button></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav> -->
          <?php include 'nav.php'; ?>
    <?php generateHeader();?>
    <?php generateNav(); ?>
    <div class="container-fluid banner">
        <div class="container banner-content col-lg-6">
            <div class="text-center">
                <p class="fs-1">Penerimaan Siswa-Siswi Baru</p>
                <p>Selamat datang di website penerimaan mahasiswa baru SMP XYZ. SMP XYZ adalah sebuah lembaga pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas dan mendukung perkembangan siswa secara holistik. Dengan staf pengajar yang berpengalaman dan fasilitas yang memadai, kami bertujuan untuk menciptakan lingkungan belajar yang inspiratif dan mendukung kesuksesan setiap siswa.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid info">
      <div class="text-center">
        <h5>Kegiatan Siswa-Siswi :</h5>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="img-container">
              <img src="foto/belajar 1.jpg" alt="Foto 1">
              <div class="caption">Belajar Mengajar</div>
            </div>
          </div>
          <div class="col order-5">
            <div class="img-container">
              <img src="foto/belajar 2.jpg" alt="Foto 2">
              <div class="caption">Bimbingan</div>
            </div>
          </div>
          <div class="col order-1">
            <div class="img-container">
              <img src="foto/belajar 3.jpg" alt="Foto 3">
              <div class="caption">Diskusi Kelompok</div>
            </div>
          </div>
        </div>
      </div>
    </div>
          
            
            
   
    
    <!-- <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col">
            <h5>Kontak:</h5>
            <p>Alamat: Jalan Sucipto, Kota Sumbawa, Negara Indonesia</p>
            <p>Email: example@example.com</p>
            <p>Telepon: +1234567890</p>
          </div>
        </div>
      </div>
    </footer>  -->
    <?php generateFooter();?>

    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>