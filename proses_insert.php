<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Menerima data yang dikirimkan melalui AJAX
  $studentId = $_POST['studentId'];
  $nilaiWawancara = $_POST['nilaiWawancara'];
  $nilaiUjian = $_POST['nilaiUjian'];

  // Simpan data ke tabel selections
  $query = "INSERT INTO selections (student_id, nilai_ujian, nilai_wawancara) VALUES ('$studentId', '$nilaiUjian', '$nilaiWawancara')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Berhasil menyimpan data
    echo "Data berhasil disimpan!";
  } else {
    // Gagal menyimpan data
    echo "Terjadi kesalahan dalam menyimpan data.";
  }
}

mysqli_close($koneksi);
?>
