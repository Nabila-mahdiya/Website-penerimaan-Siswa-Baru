
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <title>Document</title>
 
    <style>       
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-color: rgb(137, 207, 240);
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <?php generateHeader(); ?>
    <?php NavSiswa(); ?>
    <!-- <h1>Profil Siswa</h1> -->

    <!-- Tampilkan informasi profil siswa yang lain -->
    <!-- ... -->
   
        <div class="container">
        <h1 class="mt-5">Profil Siswa</h1>
        <?php
session_start();

include 'koneksi.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Mendapatkan user_id berdasarkan username dari tabel users
    $query = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        if ($user_id) {
            // Memeriksa apakah siswa dengan user_id tersebut sudah ada dalam tabel students
            $query = "SELECT s.nama_lengkap, s.jenis_kelamin, s.tanggal_lahir, s.alamat, s.no_telpon, s.pendidikan_terakhir, p.nama_ayah, p.nama_ibu, p.alamat AS alamat_orang_tua, p.no_telepon AS no_telepon_orang_tua 
            FROM students s 
            INNER JOIN parents p ON s.student_id = p.student_id 
            WHERE s.user_id = ?";
            // Eksekusi query dengan menggunakan user_id
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $siswa = $result->fetch_assoc();

            
        }
    }
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" value="<?php echo isset($siswa['nama_lengkap']) ? $siswa['nama_lengkap'] : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" id="jenis_kelamin" value="<?php echo isset($siswa['jenis_kelamin']) ? $siswa['jenis_kelamin'] : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" value="<?php echo isset($siswa['tanggal_lahir']) ? date('Y-m-d', strtotime($siswa['tanggal_lahir'])) : ''; ?>" readonly>
        </div>
        <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea class="form-control" id="alamat" readonly><?php echo isset($siswa['alamat']) ? $siswa['alamat'] : (isset($siswa['alamat_siswa']) ? $siswa['alamat_siswa'] : ''); ?></textarea>
</div>
        <div class="mb-3">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="no_telepon" value="<?php echo isset($siswa['no_telpon']) ? $siswa['no_telpon'] : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <input type="text" class="form-control" id="pendidikan_terakhir" value="<?php echo isset($siswa['pendidikan_terakhir']) ? $siswa['pendidikan_terakhir'] : ''; ?>" readonly>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_ayah" class="form-label">Nama Ayah</label>
            <input type="text" class="form-control" id="nama_ayah" value="<?php echo isset($siswa['nama_ayah']) ? $siswa['nama_ayah'] : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_ibu" class="form-label">Nama Ibu</label>
            <input type="text" class="form-control" id="nama_ibu" value="<?php echo isset($siswa['nama_ibu']) ? $siswa['nama_ibu'] : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua</label>
            <textarea class="form-control" id="alamat_orang_tua" readonly><?php echo isset($siswa['alamat_orang_tua']) ? $siswa['alamat'] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="no_telepon_orang_tua" class="form-label">Nomor Telepon Orang Tua</label>
            <input type="tel" class="form-control" id="no_telepon_orang_tua" value="<?php echo isset($siswa['no_telepon_orang_tua']) ? $siswa['no_telepon_orang_tua'] : ''; ?>" readonly>
        </div>
    </div>
</div>

       <hr>
<div>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mendapatkan user_id berdasarkan username
    $queryUser = "SELECT user_id FROM users WHERE username = '$username'";
    $resultUser = mysqli_query($koneksi, $queryUser);

    if ($resultUser) {
        $rowUser = mysqli_fetch_assoc($resultUser);

        if ($rowUser) {
            $user_id = $rowUser['user_id'];

            // Query untuk mendapatkan student_id berdasarkan user_id
            $queryStudent = "SELECT student_id FROM students WHERE user_id = '$user_id'";
            $resultStudent = mysqli_query($koneksi, $queryStudent);

            if ($resultStudent) {
                $rowStudent = mysqli_fetch_assoc($resultStudent);

                if ($rowStudent) {
                    $student_id = $rowStudent['student_id'];

                    // Query untuk mendapatkan data file dari tabel "Files" berdasarkan student_id
                    $query = "SELECT * FROM files WHERE student_id = '$student_id'";
                    $result = mysqli_query($koneksi, $query);

                    // Menampilkan data file
                    echo "<h3>File</h3>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $filePath = $row['nama_unik'];
                        $fileName = basename($filePath);
                        echo "<p>File yang diupload: <a href=\"$filePath\" download>$fileName</a></p>";
                    }
                    echo "</div>";

                    // // Menampilkan data file kartu keluarga
                    // echo "<div>";
                    // echo "<h3>Kartu Keluarga</h3>";
                    // $kartuKeluargaPath = "";
                    // mysqli_data_seek($result, 0); // Mengembalikan pointer result ke awal
                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     if ($row['nama_file'] === "kartu_keluarga") {
                    //         $kartuKeluargaPath = $row['nama_unik'];
                    //         $kartuKeluargaName = basename($kartuKeluargaPath);
                    //         echo "<p>File yang diupload: <a href=\"$kartuKeluargaPath\" download>$kartuKeluargaName</a></p>";
                    //     }
                    // }

                    // if (empty($kartuKeluargaPath)) {
                    //     echo "<p>Belum ada berkas yang diupload.</p>";
                    // }
                    // echo "</div>";

                    // // Menampilkan data file surat rekomendasi
                    // echo "<div>";
                    // echo "<h3>Surat Rekomendasi</h3>";
                    // $suratRekomendasiPath = "";
                    // mysqli_data_seek($result, 0); // Mengembalikan pointer result ke awal
                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     if ($row['nama_file'] === "surat_rekomendasi") {
                    //         $suratRekomendasiPath = $row['nama_unik'];
                    //         $suratRekomendasiName = basename($suratRekomendasiPath);
                    //         echo "<p>File yang diupload: <a href=\"$suratRekomendasiPath\" download>$suratRekomendasiName</a></p>";
                    //     }
                    // }

                    // if (empty($suratRekomendasiPath)) {
                    //     echo "<p>Belum ada berkas yang diupload.</p>";
                    // }
                    echo "</div>";
                } else {
                    echo "Student ID tidak ditemukan.";
                }
            } else {
                echo "Terjadi kesalahan dalam mendapatkan student_id.";
            }
        } else {
            echo "User ID tidak ditemukan.";
        }
    } else {
        echo "Terjadi kesalahan dalam mendapatkan user_id." . mysqli_error($koneksi);
    }
}
?>

<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
