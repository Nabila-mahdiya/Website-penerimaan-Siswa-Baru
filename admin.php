<?php
session_start();
include 'koneksi.php';
// Cek apakah user sudah login sebagai admin (asumsikan menggunakan session untuk autentikasi)
if (!isset($_SESSION['Administrator'])) {
    // header('Location: form_login.php'); // Redirect ke halaman login jika belum login
    // exit();
}


// Query untuk mendapatkan data pengumuman
$query = "SELECT a.*, s.nama_lengkap, c.class_name, c.tahun_ajaran 
          FROM announcements a
          INNER JOIN students s ON a.student_id = s.student_id
          INNER JOIN classes c ON a.student_id = c.student_id";
$result = mysqli_query($koneksi, $query);

// Mendapatkan data kelas untuk dropdown
$queryClasses = "SELECT * FROM classes";
$resultClasses = mysqli_query($koneksi, $queryClasses);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin-top: 20px;
            background-color: rgb();
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <?php generateHeader(); ?>
    <?php NavAdmin(); ?>
    <div class="container">
        <h2>Admin Page</h2>

        <h3>Input Pengumuman</h3>
<form action="proses_input_pengumuman.php" method="POST">
    <div class="mb-3">
        <label for="studentID" class="form-label">Student ID</label>
        <input type="text" class="form-control" id="studentID" name="studentID" required>
    </div>
    <div class="mb-3">
        <label for="class_name" class="form-label">Class</label>
        <select class="form-select" id="class_name" name="class_name" required>
            <option value="">-- Select Class --</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tahunAjaran" class="form-label">Tahun Ajaran</label>
        <input type="text" class="form-control" id="tahunAjaran" name="tahunAjaran" required>
    </div>
    <div class="mb-3">
        <label for="tglPengumuman" class="form-label">Tanggal Pengumuman</label>
        <input type="date" class="form-control" id="tglPengumuman" name="tglPengumuman" required>
    </div>
    <div class="mb-3">
        <label for="hasilSeleksi" class="form-label">Hasil Seleksi</label>
        <select class="form-select" id="hasilSeleksi" name="hasilSeleksi" required>
            <option value="">-- Select Result --</option>
            <option value="Lulus">Lulus</option>
            <option value="Tidak Lulus">Tidak Lulus</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="hari" class="form-label">Hari</label>
        <input type="text" class="form-control" id="hari" name="hari" required>
    </div>
    <div class="mb-3">
        <label for="jamMulai" class="form-label">Jam Mulai</label>
        <input type="time" class="form-control" id="jamMulai" name="jamMulai" required>
    </div>
    <div class="mb-3">
        <label for="jamSelesai" class="form-label">Jam Selesai</label>
        <input type="time" class="form-control" id="jamSelesai" name="jamSelesai" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

       

        <h3>Daftar Pengumuman</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Nama Lengkap</th>
                    <th>Class</th>
                    <th>Tahun Ajaran</th>
                    <th>Tanggal Pengumuman</th>
                    <th>Hasil Seleksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
          
                while ($row = mysqli_fetch_assoc($result)) {
                    $studentID = $row['student_id'];
                    $namaLengkap = $row['nama_lengkap'];
                    $className = $row['class_name'];
                    $tahunAjaran = $row['tahun_ajaran'];
                    $tglPengumuman = $row['tgl_pengumuman'];
                    $hasilSeleksi = $row['hasil_seleksi'];

                    echo "<tr>";
                    echo "<td>$studentID</td>";
                    echo "<td>$namaLengkap</td>";
                    echo "<td>$className</td>";
                    echo "<td>$tahunAjaran</td>";
                    echo "<td>$tglPengumuman</td>";
                    echo "<td>$hasilSeleksi</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Load Bootstrap JS -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
