<?php
session_start();
include "koneksi.php";
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Mendapatkan data dari formulir pendaftaran
$nama_lengkap = $_POST['nama_lengkap'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$provinsi_id = $_POST['provinsi_id'];
$kota_id = $_POST['kota_id'];
$kecamatan_id = $_POST['kecamatan_id'];
$nomor_telepon = $_POST['nomor_telepon'];
$pendidikan_terakhir = $_POST['pendidikan_terakhir'];
$nama_ayah = $_POST['nama_ayah'];
$nama_ibu = $_POST['nama_ibu'];
$alamat_orang_tua = $_POST['alamat_orang_tua'];
$nomor_telepon_orang_tua = $_POST['nomor_telepon_orang_tua'];
$tanggal_pendaftaran = $_POST['tanggal_pendaftaran'];
$status_pembayaran = $_POST['status_pembayaran'];

// Mendapatkan data inputan
$namaFileFotoSiswa = $_FILES["foto_siswa"]["name"];
$namaFileKartuKeluarga = $_FILES["kartu_keluarga"]["name"];
$namaFileSuratRekomendasi = $_FILES["surat_rekomendasi"]["name"];

// Mendapatkan ukuran file
$ukuranFileFotoSiswa = $_FILES["foto_siswa"]["size"];
$ukuranFileKartuKeluarga = $_FILES["kartu_keluarga"]["size"];
$ukuranFileSuratRekomendasi = $_FILES["surat_rekomendasi"]["size"];

// Mendapatkan tipe file
$tipeFileFotoSiswa = strtolower(pathinfo($namaFileFotoSiswa, PATHINFO_EXTENSION));
$tipeFileKartuKeluarga = strtolower(pathinfo($namaFileKartuKeluarga, PATHINFO_EXTENSION));
$tipeFileSuratRekomendasi = strtolower(pathinfo($namaFileSuratRekomendasi, PATHINFO_EXTENSION));

// Validasi ukuran file maksimal (contoh: 2 MB)
$ukuranMaksimal = 2 * 1024 * 1024; // 2 MB
if ($ukuranFileFotoSiswa > $ukuranMaksimal || $ukuranFileKartuKeluarga > $ukuranMaksimal || $ukuranFileSuratRekomendasi > $ukuranMaksimal) {
    echo "Ukuran file melebihi batas maksimal (2 MB).";
    exit;
}
// Validasi jenis file yang diizinkan
$jenisFileFotoSiswa = ['jpg', 'jpeg', 'png'];
$jenisFileKartuKeluarga = ['jpg', 'jpeg', 'pdf'];
$jenisFileSuratRekomendasi = ['jpg', 'jpeg', 'pdf'];

if (!in_array($tipeFileFotoSiswa, $jenisFileFotoSiswa) || !in_array($tipeFileKartuKeluarga, $jenisFileKartuKeluarga) || !in_array($tipeFileSuratRekomendasi, $jenisFileSuratRekomendasi)) {
    echo "Jenis file tidak diizinkan.";
    exit;
}

// Proses upload file foto siswa
$targetDirFotoSiswa = "uploads/foto_siswa/";
$targetFileFotoSiswa = $targetDirFotoSiswa . basename($namaFileFotoSiswa);
move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $targetFileFotoSiswa);

// Proses upload file kartu keluarga
$targetDirKartuKeluarga = "uploads/kartu_keluarga/";
$targetFileKartuKeluarga = $targetDirKartuKeluarga . basename($namaFileKartuKeluarga);
move_uploaded_file($_FILES["kartu_keluarga"]["tmp_name"], $targetFileKartuKeluarga);

// Proses upload file surat rekomendasi
$targetDirSuratRekomendasi = "uploads/surat_rekomendasi/";
$targetFileSuratRekomendasi = $targetDirSuratRekomendasi . basename($namaFileSuratRekomendasi);
move_uploaded_file($_FILES["surat_rekomendasi"]["tmp_name"], $targetFileSuratRekomendasi);
// Mendapatkan user_id berdasarkan username dari tabel users

// Mendapatkan username dari $_SESSION
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mendapatkan user_id berdasarkan username
    $queryUser = "SELECT user_id FROM users WHERE username = '$username'";
    $resultUser = mysqli_query($koneksi, $queryUser);

    if ($resultUser) {
        $rowUser = mysqli_fetch_assoc($resultUser);

        if ($rowUser) {
            $user_id = $rowUser['user_id'];

            // Query untuk mendapatkan student_id berdasarkan user_id
            $queryStudent = "SELECT student_id FROM students WHERE user_id = '$user_id'";
            $resultStudent = mysqli_query($koneksi, $queryStudent);

            if ($resultStudent) {
                $rowStudent = mysqli_fetch_assoc($resultStudent);

                if ($rowStudent) {
                    $student_id = $rowStudent['student_id'];

                    // Query untuk menyimpan data pada tabel "Files" dengan student_id
                    $query = "INSERT INTO files (nama_file, nama_unik, lokasi, tipe_file, tanggal_unggah, student_id)
                              VALUES ('$namaFileFotoSiswa', '$targetFileFotoSiswa', '$targetDirFotoSiswa', '$tipeFileFotoSiswa', NOW(), '$student_id'),
                                     ('$namaFileKartuKeluarga', '$targetFileKartuKeluarga', '$targetDirKartuKeluarga', '$tipeFileKartuKeluarga', NOW(), '$student_id'),
                                     ('$namaFileSuratRekomendasi', '$targetFileSuratRekomendasi', '$targetDirSuratRekomendasi', '$tipeFileSuratRekomendasi', NOW(), '$student_id')";

                    // Eksekusi query
                    $result = mysqli_query($koneksi, $query);

                    // Cek jika query berhasil dieksekusi
                    if ($result) {
                        $_SESSION['foto_siswa'] = $targetFileFotoSiswa;
                        $_SESSION['kartu_keluarga'] = $targetFileKartuKeluarga;
                        $_SESSION['surat_rekomendasi'] = $targetFileSuratRekomendasi;
                        echo "Data berhasil disimpan.";
                    } else {
                        echo "Terjadi kesalahan dalam menyimpan data.";
                    }
                } else {
                    echo "Student ID tidak ditemukan.";
                }
            } else {
                echo "Terjadi kesalahan dalam mendapatkan student_id.";
            }
        } else {
            echo "User ID tidak ditemukan.";
        }
    } else {
        echo "Terjadi kesalahan dalam mendapatkan user_id." . mysqli_error($koneksi);
    }
} else {
    echo "Username tidak ditemukan dalam sesi.";
}



// Query untuk mendapatkan data alamat berdasarkan id provinsi, kota, dan kecamatan
$sql = "SELECT * FROM provinsi WHERE id_provinsi = '$provinsi_id'";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
$provinsi = $row['nama_provinsi'];

$sql = "SELECT * FROM kabupaten WHERE id_kabupaten = '$kota_id'";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
$kota = $row['nama_kabupaten'];

$sql = "SELECT * FROM kecamatan WHERE id_kecamatan = '$kecamatan_id'";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
$kecamatan = $row['nama_kecamatan'];

// Gabungkan alamat menjadi satu string
$alamat = $kecamatan . ', ' . $kota . ', ' . $provinsi;

// Memeriksa apakah user_id tersedia dalam sesi atau input pengguna
if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    
        // Mendapatkan user_id berdasarkan username dari tabel users
        $sql = "SELECT user_id FROM users WHERE username = '$username'";
        $result = $koneksi->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
    
            if ($user_id) {
                // Memeriksa apakah siswa dengan user_id tersebut sudah ada dalam tabel students
                $sql = "SELECT * FROM students WHERE user_id = '$user_id'";
                $result = $koneksi->query($sql);
    
                if ($result->num_rows > 0) {
                    // Siswa sudah ada, lakukan tindakan yang sesuai, misalnya update data siswa yang sudah ada atau menolak penyimpanan data baru
                    $message = "Siswa dengan user ID tersebut sudah terdaftar. Anda dapat melakukan pembaruan data siswa.";
    
                    // Lakukan proses update data siswa
                    $sql = "UPDATE students SET 
                            nama_lengkap = '$nama_lengkap',
                            jenis_kelamin = '$jenis_kelamin',
                            tanggal_lahir = '$tanggal_lahir',
                            alamat = '$alamat',
                            no_telpon = '$nomor_telepon',
                            pendidikan_terakhir = '$pendidikan_terakhir'
                            WHERE user_id = '$user_id'";
    
                    $result = $koneksi->query($sql);
    
                    if ($result) {
                        // Simpan data ke tabel parents
                        $sql = "UPDATE parents SET
                                nama_ayah = '$nama_ayah',
                                nama_ibu = '$nama_ibu',
                                alamat = '$alamat_orang_tua',
                                no_telepon = '$nomor_telepon_orang_tua'
                                WHERE student_id = '$user_id'";
    
                        $result = $koneksi->query($sql);
    
                        if ($result) {
                            // Simpan data ke tabel registration
                            $sql = "UPDATE registration SET
                                    tgl_pendaftaran = '$tanggal_pendaftaran',
                                    status_pembayaran = '$status_pembayaran'
                                    WHERE student_id = '$user_id'";
    
    $result = $koneksi->query($sql);
    // if($result){
    //     $query = "UPDATE files SET
    //               nama_file = '$namaFileFotoSiswa',
    //               nama_unik = '$targetFileFotoSiswa',
    //               lokasi = '$targetDirFotoSiswa',
    //               tipe_file = '$tipeFileFotoSiswa',
    //               tanggal_unggah = NOW()
    //           WHERE student_id = '$user_id';";
    
    //                $result = $koneksi->query($sql);
                            
                            if ($result) {
                                $message = "Data siswa berhasil diperbarui!";
                            } else {
                                $message = "Terjadi kesalahan saat memperbarui data pendaftaran.";
                            }
                        } else {
                            $message = "Terjadi kesalahan saat memperbarui data orang tua.";
                        }
                    } else {
                        $message = "Terjadi kesalahan saat memperbarui data siswa.";
                    }
                } else {
                    // Siswa belum terdaftar, lakukan proses penyimpanan data baru
                    $sql = "INSERT INTO students (nama_lengkap, jenis_kelamin, tanggal_lahir, alamat, no_telpon, pendidikan_terakhir, user_id) 
                            VALUES ('$nama_lengkap', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$pendidikan_terakhir', '$user_id')";
    
                    $result = $koneksi->query($sql);
    
                    if ($result) {
                        // Mendapatkan ID siswa yang baru saja disimpan
                        $student_id = $koneksi->insert_id;
    
                        // Simpan data ke tabel parents
                        $sql = "INSERT INTO parents (nama_ayah, nama_ibu, alamat, no_telepon, student_id) 
                                VALUES ('$nama_ayah', '$nama_ibu', '$alamat_orang_tua', '$nomor_telepon_orang_tua', '$student_id')";
    
                        $result = $koneksi->query($sql);
    
                        if ($result) {
                            // Simpan data ke tabel registration
                            $sql = "INSERT INTO registration (student_id, tgl_pendaftaran, status_pembayaran) 
                                    VALUES ('$student_id', '$tanggal_pendaftaran', '$status_pembayaran')";
$result = $koneksi->query($sql);
// if ($result) {
//     // Query untuk menyimpan data pada tabel "Files"
//     $query = "INSERT INTO files (nama_file, nama_unik, lokasi, tipe_file, tanggal_unggah, student_id)
//               VALUES ('$namaFileFotoSiswa', '$targetFileFotoSiswa', '$targetDirFotoSiswa', '$tipeFileFotoSiswa', NOW(), '$student_id'),
//                      ('$namaFileKartuKeluarga', '$targetFileKartuKeluarga', '$targetDirKartuKeluarga', '$tipeFileKartuKeluarga', NOW(), '$student_id'),
//                      ('$namaFileSuratRekomendasi', '$targetFileSuratRekomendasi', '$targetDirSuratRekomendasi', '$tipeFileSuratRekomendasi', NOW(), '$student_id')";
   
//     // Eksekusi query
//     $result = $koneksi->query($query);
// }

    
        // Cek jika query berhasil dieksekusi
        // if ($result) {
        //     $_SESSION['foto_siswa'] = $targetFileFotoSiswa;
        //     $_SESSION['kartu_keluarga'] = $targetFileKartuKeluarga;
        //     $_SESSION['surat_rekomendasi'] = $targetFileSuratRekomendasi;
        //     echo "Data berhasil disimpan.";
        // } else {
        //     echo "Terjadi kesalahan dalam menyimpan data.";
        // }
    
    
                            
                        
                            if ($result) {
                                $message = "Pendaftaran berhasil!";
                            } else {
                                $message = "Terjadi kesalahan saat menyimpan data pendaftaran.";
                            }
                        } else {
                            $message = "Terjadi kesalahan saat menyimpan data orang tua.";
                        }
                    } else {
                        $message = "Terjadi kesalahan saat menyimpan data siswa.";
                    }
                }
            }
        }
        } else {
            $message = "User ID tidak tersedia.";
        }
    } elseif (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
    
        // Siswa belum terdaftar, lakukan proses penyimpanan data baru
        $sql = "INSERT INTO students (nama_lengkap, jenis_kelamin, tanggal_lahir, alamat, no_telpon, pendidikan_terakhir, user_id) 
                VALUES ('$nama_lengkap', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$pendidikan_terakhir', '$user_id')";

        $result = $koneksi->query($sql);

        if ($result) {
            // Mendapatkan ID siswa yang baru saja disimpan
            $student_id = $koneksi->insert_id;

            // Simpan data ke tabel parents
            $sql = "INSERT INTO parents (nama_ayah, nama_ibu, alamat, no_telepon, student_id) 
                    VALUES ('$nama_ayah', '$nama_ibu', '$alamat_orang_tua', '$nomor_telepon_orang_tua', '$student_id')";

            $result = $koneksi->query($sql);

            if ($result) {
                // Simpan data ke tabel registration
                $sql = "INSERT INTO registration (student_id, tgl_pendaftaran, status_pembayaran) 
                        VALUES ('$student_id', '$tanggal_pendaftaran', '$status_pembayaran')";

                $result = $koneksi->query($sql);
                // if ($result) {
                //     // Query untuk menyimpan data pada tabel "Files"
                //     $query = "INSERT INTO files (nama_file, nama_unik, lokasi, tipe_file, tanggal_unggah, student_id)
                //     VALUES ('$namaFileFotoSiswa', '$targetFileFotoSiswa', '$targetDirFotoSiswa', '$tipeFileFotoSiswa', NOW(), '$student_id'),
                //            ('$namaFileKartuKeluarga', '$targetFileKartuKeluarga', '$targetDirKartuKeluarga', '$tipeFileKartuKeluarga', NOW(), '$student_id'),
                //            ('$namaFileSuratRekomendasi', '$targetFileSuratRekomendasi', '$targetDirSuratRekomendasi', '$tipeFileSuratRekomendasi', NOW(), '$student_id')";
                  
                //     // Eksekusi query
                //     $result = mysqli_query($koneksi, $query);
                
                //     // Cek jika query berhasil dieksekusi
                //     if ($result) {
                //         $_SESSION['foto_siswa'] = $targetFileFotoSiswa;
                //         $_SESSION['kartu_keluarga'] = $targetFileKartuKeluarga;
                //         $_SESSION['surat_rekomendasi'] = $targetFileSuratRekomendasi;
                //         echo "Data berhasil disimpan.";
                //     } else {
                //         echo "Terjadi kesalahan dalam menyimpan data.";
                //     }
                
                

                if ($result) {
                    $message = "Pendaftaran berhasil!";
                 
                } else {
                    $message = "Terjadi kesalahan saat menyimpan data pendaftaran.";
                }
            } else {
                $message = "Terjadi kesalahan saat menyimpan data orang tua.";
            }
        } else {
            $message = "Terjadi kesalahan saat menyimpan data siswa.";
        }
    }
// }
// }

    // Tutup koneksi ke database
    $koneksi->close();
    
    // Redirect ke halaman hasil pendaftaran dengan membawa pesan
    header("Location: profil.php?message=" . urlencode($message));
    exit();
