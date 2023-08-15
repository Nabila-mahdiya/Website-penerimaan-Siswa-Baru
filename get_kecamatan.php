<?php
// Kode untuk koneksi ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["kota_id"])) {
    $kotaId = $_GET["kota_id"];

    // Query untuk mendapatkan data kecamatan berdasarkan kota yang dipilih
    $query = "SELECT * FROM kecamatan WHERE id_kabupaten = '$kotaId'";
    $result = mysqli_query($koneksi, $query);

   // Memeriksa hasil query
    if ($result) {
        // Membangun opsi dropdown kota
        $options = '<option value="">Pilih kecamatan</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['id_kecamatan'] . '">' . $row['nama_kecamatan'] . '</option>';
        }
        echo $options;
    } else {
        echo '<option value="">Data Kota Tidak Tersedia</option>';
    }

    // Mengembalikan data kecamatan dalam format JSON
    echo json_encode($kecamatanData);
}
?>
 