<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima data yang dikirimkan melalui AJAX
    $namaLengkap = $_POST['namaLengkap'];
    $nilaiWawancara = $_POST['nilaiWawancara'];
    $nilaiUjian = $_POST['nilaiUjian'];

    // Membuat variabel untuk menyimpan pesan hasil operasi
    $message = '';

    // Melakukan loop untuk menyimpan data siswa
    for ($i = 0; $i < count($namaLengkap); $i++) {
        // Mendapatkan student_id berdasarkan nama_lengkap
        $queryId = "SELECT student_id FROM students WHERE nama_lengkap = '$namaLengkap[$i]'";
        $resultId = mysqli_query($koneksi, $queryId);

        if ($resultId) {
            $rowId = mysqli_fetch_assoc($resultId);
            $studentId = $rowId['student_id'];

            // Periksa apakah data siswa sudah ada pada tabel selections
            $queryCheck = "SELECT * FROM selections WHERE student_id = '$studentId'";
            $resultCheck = mysqli_query($koneksi, $queryCheck);

            if (mysqli_num_rows($resultCheck) > 0) {
                // Jika data siswa sudah ada, lakukan update
                $queryUpdate = "UPDATE selections SET nilai_ujian = '$nilaiUjian[$i]', nilai_wawancara = '$nilaiWawancara[$i]' WHERE student_id = '$studentId'";
                $resultUpdate = mysqli_query($koneksi, $queryUpdate);

                if ($resultUpdate) {
                    // Berhasil melakukan update
                    $message .= "Data siswa dengan nama lengkap '$namaLengkap[$i]' berhasil diupdate!<br>";
                } else {
                    // Gagal melakukan update
                    $message .= "Terjadi kesalahan dalam mengupdate data siswa dengan nama lengkap '$namaLengkap[$i]'.<br>";
                }
            } else {
                // Jika data siswa belum ada, lakukan insert
                $queryInsert = "INSERT INTO selections (student_id, nilai_ujian, nilai_wawancara) VALUES ('$studentId', '$nilaiUjian[$i]', '$nilaiWawancara[$i]')";
                $resultInsert = mysqli_query($koneksi, $queryInsert);

                if ($resultInsert) {
                    // Berhasil menyimpan data
                    $message .= "Data siswa dengan nama lengkap '$namaLengkap[$i]' berhasil disimpan!<br>";
                } else {
                    // Gagal menyimpan data
                    $message .= "Terjadi kesalahan dalam menyimpan data siswa dengan nama lengkap '$namaLengkap[$i]'.<br>";
                }
            }
        } else {
            // Gagal mendapatkan student_id
            $message .= "Terjadi kesalahan dalam mendapatkan data siswa dengan nama lengkap '$namaLengkap[$i]'.<br>";
        }
    }

    echo $message;

    mysqli_close($koneksi);
}
?>
