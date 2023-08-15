<?php
session_start();
include 'koneksi.php';

// Query untuk mengambil data terkait
$query = "SELECT s.nama_lengkap, se.nilai_wawancara, se.nilai_ujian 
          FROM students s
          INNER JOIN selections se ON s.student_id = se.student_id";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Calon Siswa</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
    }
    </style>
</head>
<body>
<?php include 'nav.php'; ?>
<?php generateHeader();?>
<?php NavSeleksi();?>
    <div class="container">
        <h2>Data Calon Siswa</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Nilai Wawancara</th>
                    <th>Nilai Ujian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $namaLengkap = $row['nama_lengkap'];
                    $nilaiWawancara = $row['nilai_wawancara'];
                    $nilaiUjian = $row['nilai_ujian'];

                    echo "<tr>";
                    echo "<td>$namaLengkap</td>";
                    echo "<td>$nilaiWawancara</td>";
                    echo "<td>$nilaiUjian</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Load Bootstrap JS -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
