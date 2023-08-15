<?php
session_start();
include 'koneksi.php';

// Mendapatkan username dari session (asumsikan sudah login)
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mendapatkan user_id berdasarkan username
    $queryUserId = "SELECT user_id FROM users WHERE username = '$username'";
    $resultUserId = mysqli_query($koneksi, $queryUserId);

    if ($rowUserId = mysqli_fetch_assoc($resultUserId)) {
        $userId = $rowUserId['user_id'];

        // Query untuk mendapatkan student_id berdasarkan user_id
        $queryStudentId = "SELECT student_id FROM students WHERE user_id = '$userId'";
        $resultStudentId = mysqli_query($koneksi, $queryStudentId);

        if ($rowStudentId = mysqli_fetch_assoc($resultStudentId)) {
            $studentID = $rowStudentId['student_id'];

            // Query untuk mendapatkan pengumuman berdasarkan student_id
            $query = "SELECT a.tgl_pengumuman, a.hasil_seleksi, c.class_name, c.tahun_ajaran 
                      FROM announcements a
                      INNER JOIN classes c ON a.student_id = c.student_id
                      WHERE a.student_id = '$studentID'";
            $result = mysqli_query($koneksi, $query);

            // Mengambil data pengumuman (asumsikan hanya ada satu pengumuman per siswa)
            if ($row = mysqli_fetch_assoc($result)) {
                $tglPengumuman = $row['tgl_pengumuman'];
                $hasilSeleksi = $row['hasil_seleksi'];
                $className = $row['class_name'];
                $tahunAjaran = $row['tahun_ajaran'];
            } else {
                // Handle jika tidak ada pengumuman ditemukan
                // Misalnya, tetapkan nilai default atau tampilkan pesan kesalahan.
                $tglPengumuman = "Tanggal Pengumuman tidak tersedia";
                $hasilSeleksi = "Hasil Seleksi tidak tersedia";
                $className = "Kelas tidak tersedia";
                $tahunAjaran = "Tahun Ajaran tidak tersedia";
            }
        } else {
            // Handle jika student_id tidak ditemukan
            // Misalnya, tetapkan nilai default atau tampilkan pesan kesalahan.
            $tglPengumuman = "Tanggal Pengumuman tidak tersedia";
            $hasilSeleksi = "Hasil Seleksi tidak tersedia";
            $className = "Kelas tidak tersedia";
            $tahunAjaran = "Tahun Ajaran tidak tersedia";
        }
    } else {
        // Handle jika user_id tidak ditemukan
        // Misalnya, tetapkan nilai default atau tampilkan pesan kesalahan.
        $tglPengumuman = "Tanggal Pengumuman tidak tersedia";
        $hasilSeleksi = "Hasil Seleksi tidak tersedia";
        $className = "Kelas tidak tersedia";
        $tahunAjaran = "Tahun Ajaran tidak tersedia";
    }
} else {
    // Handle jika $_SESSION['username'] tidak terdefinisi
    // Misalnya, arahkan pengguna ke halaman login.
    header("Location: login.php");
    exit;
}
?>

<!-- Kode HTML selanjutnya tetap sama -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
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
    <div class="container">
        <h2>Pengumuman</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Hasil Seleksi Kelas <?php echo $className; ?> (Tahun Ajaran <?php echo $tahunAjaran; ?>)</h5>
                <p class="card-text">Tanggal Pengumuman: <?php echo $tglPengumuman; ?></p>
                <p class="card-text">Hasil Seleksi: <?php echo $hasilSeleksi; ?></p>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
