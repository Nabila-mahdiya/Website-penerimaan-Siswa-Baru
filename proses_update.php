<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Menerima data yang dikirimkan melalui form update
  $namaLengkap = $_POST['namaLengkap'];
  $nilaiWawancara = $_POST['nilaiWawancara'];
  $nilaiUjian = $_POST['nilaiUjian'];

  // Looping untuk melakukan update data pada setiap baris
  for ($i = 0; $i < count($namaLengkap); $i++) {
    $nama = $namaLengkap[$i];
    $wawancara = $nilaiWawancara[$i];
    $ujian = $nilaiUjian[$i];

    // Query untuk mendapatkan student_id berdasarkan nama_lengkap
    $query = "SELECT student_id FROM students WHERE nama_lengkap = '$nama'";
    $result = mysqli_query($koneksi, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
      // Gagal mendapatkan student_id
      echo "Terjadi kesalahan dalam mengupdate data.";
      exit;
    }

    $row = mysqli_fetch_assoc($result);
    $studentID = $row['student_id'];

    // Query untuk melakukan update data
    $queryUpdate = "UPDATE selections SET nilai_wawancara = '$wawancara', nilai_ujian = '$ujian' WHERE student_id = '$studentID'";
    $resultUpdate = mysqli_query($koneksi, $queryUpdate);

    if (!$resultUpdate) {
      // Gagal melakukan update data
      echo "Terjadi kesalahan dalam mengupdate data.";
      exit;
    }
  }

  // Berhasil melakukan update data
  echo "Data berhasil diupdate!";
}

mysqli_close($koneksi);
?>
