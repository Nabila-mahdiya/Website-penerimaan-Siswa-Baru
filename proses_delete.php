<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Menerima data yang dikirimkan melalui form update
//   $namaLengkap = $_POST['namaLengkap'];
//   $nilaiWawancara = $_POST['nilaiWawancara'];
//   $nilaiUjian = $_POST['nilaiUjian'];

//   // Looping untuk menghapus data pada setiap baris
//   for ($i = 0; $i < count($namaLengkap); $i++) {
//     $nama = $namaLengkap[$i];

//     // Query untuk mendapatkan student_id berdasarkan nama_lengkap
//     $query = "SELECT student_id FROM students WHERE nama_lengkap = '$nama'";
//     $result = mysqli_query($koneksi, $query);

//     if (!$result || mysqli_num_rows($result) == 0) {
//       // Gagal mendapatkan student_id
//       echo "Terjadi kesalahan dalam menghapus data.";
//       exit;
//     }

//     $row = mysqli_fetch_assoc($result);
//     $studentID = $row['student_id'];

//     // Query untuk menghapus data berdasarkan student_id
//     $queryDelete = "DELETE FROM selections WHERE student_id = '$studentID'";
//     $resultDelete = mysqli_query($koneksi, $queryDelete);

//     if (!$resultDelete) {
//       // Gagal menghapus data
//       echo "Terjadi kesalahan dalam menghapus data.";
//       exit;
//     }
//   }

//   // Berhasil menghapus data
//   echo "Data berhasil dihapus!";
// }

// mysqli_close($koneksi);


// Menerima data yang dikirimkan melalui AJAX
$dataToDelete = $_POST['dataToDelete'];

// Memeriksa apakah $dataToDelete adalah array sebelum menggunakan count()
if (is_array($dataToDelete)) {
    $count = count($dataToDelete);

    if ($count > 0) {
        include 'koneksi.php';

        // Menghapus data berdasarkan nama_lengkap
        foreach ($dataToDelete as $namaLengkap) {
            // Mendapatkan student_id berdasarkan nama_lengkap
            $queryId = "SELECT student_id FROM students WHERE nama_lengkap = '$namaLengkap'";
            $resultId = mysqli_query($koneksi, $queryId);
            $rowId = mysqli_fetch_assoc($resultId);
            $studentId = $rowId['student_id'];

            // Menghapus data dari tabel selections berdasarkan student_id
            $queryDelete = "DELETE FROM selections WHERE student_id = '$studentId'";
            $resultDelete = mysqli_query($koneksi, $queryDelete);
        }

        mysqli_close($koneksi);

        echo "Berhasil menghapus $count data!";
    } else {
        echo "Tidak ada data yang dihapus.";
    }
} else {
    echo "Data yang diterima tidak valid.";
}
}
?>





