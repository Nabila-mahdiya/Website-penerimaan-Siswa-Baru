<?php
// Kode untuk koneksi ke database
include 'koneksi.php';

// Kode koneksi ke database

// Query untuk mengambil data provinsi
$query = "SELECT * FROM provinsi";
$result = mysqli_query($koneksi, $query);

// Memeriksa hasil query
if ($result) {
    // Membangun opsi dropdown provinsi
    $options = '<option value="">Pilih Provinsi</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['id_provinsi'] . '">' . $row['nama_provinsi'] . '</option>';
    }
    echo $options;
} else {
    echo '<option value="">Data Provinsi Tidak Tersedia</option>';
}
?>