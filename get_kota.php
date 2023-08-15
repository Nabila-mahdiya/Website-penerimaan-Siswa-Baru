<?php
// Kode untuk koneksi ke database
include 'koneksi.php';

if (isset($_GET['provinsi_id'])) {
    $provinsiId = $_GET['provinsi_id'];

    // Query untuk mengambil data kota berdasarkan id provinsi
    $query = "SELECT * FROM kabupaten WHERE id_provinsi = '$provinsiId'";
    $result = mysqli_query($koneksi, $query);

    // Memeriksa hasil query
    if ($result) {
        // Membangun opsi dropdown kota
        $options = '<option value="">Pilih Kota</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['id_kabupaten'] . '">' . $row['nama_kabupaten'] . '</option>';
        }
        echo $options;
    } else {
        echo '<option value="">Data Kota Tidak Tersedia</option>';
    }
} else {
    echo '<option value="">Pilih Provinsi Terlebih Dahulu</option>';
}
?>