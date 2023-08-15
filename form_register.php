<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin-top: 20px;
            background-color: rgb();
        }
    </style>
    <script>
        function CheckPassword(){
            var password=document.getElementById("password").value;
            var repassword=document.getElementById("repassword").value;
            if(password !== repassword){
                alert("Ulangi, password Anda Tidak Sama.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php generateHeader();?>
    <?php generateNav(); ?>
    
    <div class="container">
    <h4><strong>  ISI DATA DIRI ANDA</strong></h4>
        <form action="aksi_register.php" method="POST" onsubmit="return CheckPassword();">
            <div class="mb-3">
                <label for="username" class="form-label" >Username</label>
                <input type="text" class="form-control" id="" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" >Password</label>
                <input type="password" class="form-control" id="" name="password" required>
            </div>
            <div class="mb-3">
                <label for="ulangipassword" class="form-label" >Ulangi Password</label>
                <input type="password" class="form-control" id="" name="ulangipassword" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label" >Level User</label>
                <select class="form-select" id="" name="level" required>
                    <option nama="Administrator" value="Administrator">Administrator</option>
                    <!-- <option nama="Petugas Verifikasi" value="Petugas Verifikasi">Petugas Verifikasi</option> -->
                    <option nama="Tim Seleksi" value="Tim Seleksi">Tim Seleksi</option>
                    <option nama="Calon Siswa" value="Calon Siswa">Calon Siswa</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="namalengkap" class="form-label" >Nama Lengkap</label>
                <input type="text" class="form-control" id="" name="namalengkap" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label" >Email</label>
                <input type="text" class="form-control" id="" name="email" required>
            </div>
            <input type="submit" class="btn btn-primary" name="Register" Value="Register">
            <input type="reset" class="btn btn-primary" name="Reset" Value="Reset">
            <!-- <button type="submit" class="btn btn-primary" name="Register" Value="Register">Register</button>
            <button type="reset" class="btn btn-primary" name="Reset" value="Reset">Reset</button> -->

        </form>
    </div>

    <?php generateFooter();?>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


