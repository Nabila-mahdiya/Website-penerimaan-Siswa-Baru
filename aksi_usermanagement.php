<?php
session_start();
include "koneksi.php";
$message = '';

// Mendapatkan data pengguna dari database
$sql = "SELECT user_id, username FROM users";
$result = $koneksi->query($sql);

// Membuat array untuk menyimpan data pengguna
$users = array();
while ($row = $result->fetch_assoc()) {
    $users[$row['user_id']] = $row['username'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai user_id yang diinputkan
    $user_ids = $_POST['user_ids'];

    // Memisahkan user_id yang dipisahkan dengan koma menjadi array
    $user_ids_array = explode(',', $user_ids);

    $deletedUserIds = array(); // Array untuk menyimpan user ID yang berhasil dihapus
    $failedUserIds = array(); // Array untuk menyimpan user ID yang gagal dihapus

    // Menghapus data pengguna berdasarkan user_id
    foreach ($user_ids_array as $user_id) {
        // Periksa apakah user_id tersedia dalam data pengguna
        if (isset($users[$user_id])) {
            $sql = "DELETE FROM users WHERE user_id = '$user_id'";
            $result = $koneksi->query($sql);

            if ($koneksi->affected_rows > 0) {
                $deletedUserIds[] = $user_id;
          
            } else {
                $failedUserIds[] = $user_id;
            }
        } else {
            $failedUserIds[] = $user_id;
        }
    }

    if (!empty($deletedUserIds)) {
        $message = "Data pengguna dengan user ID " . implode(', ', $deletedUserIds) . " berhasil dihapus.";
        if (!empty($failedUserIds)) {
            $message .= " Data pengguna dengan user ID " . implode(', ', $failedUserIds) . " tidak ditemukan.";
        }
    } else {
        $message = "Tidak ada data pengguna yang dihapus.";
    }
}

// Tutup koneksi ke database
$koneksi->close();
?>