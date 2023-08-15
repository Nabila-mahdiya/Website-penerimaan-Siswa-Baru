<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima data yang dikirimkan melalui form
    $studentID = $_POST['studentID'];
    $tanggalPengumuman = date('Y-m-d H:i:s', strtotime($_POST['tglPengumuman']));
    $hasilSeleksi = $_POST['hasilSeleksi'];
    $className = $_POST['class_name'];
    $tahunAjaran = $_POST['tahunAjaran'];

    $hari = $_POST['hari'];
    $jamMulai = $_POST['jamMulai'];
    $jamSelesai = $_POST['jamSelesai'];

    // Query untuk menyimpan data ke dalam tabel classes
    $queryClasses = "INSERT INTO classes (class_name, tahun_ajaran, student_id)
    SELECT '$className', '$tahunAjaran', student_id
    FROM students
    WHERE students.student_id = '$studentID'
    AND NOT EXISTS (SELECT * FROM classes WHERE student_id = students.student_id)";

    // Eksekusi query
    $resultClasses = mysqli_query($koneksi, $queryClasses);

    // Cek apakah data berhasil disimpan ke dalam tabel classes
    if (!$resultClasses) {
        die("Gagal menyimpan data ke dalam tabel classes: " . mysqli_error($koneksi));
    }

    // Ambil ID terakhir yang dimasukkan ke dalam tabel classes
    $classID = mysqli_insert_id($koneksi);

    // Query untuk menyimpan data ke dalam tabel schedule
    $querySchedule = "INSERT INTO schedule (hari, jam_mulai, jam_selesai)
                    VALUES ('$hari', '$jamMulai', '$jamSelesai')";
    $resultSchedule = mysqli_query($koneksi, $querySchedule);

    // Cek apakah data berhasil disimpan ke dalam tabel schedule
    if (!$resultSchedule) {
        die("Gagal menyimpan data ke dalam tabel schedule: " . mysqli_error($koneksi));
    }

    // Cek apakah pengumuman sudah ada untuk siswa dengan student_id yang sama
    $queryCheck = "SELECT * FROM announcements WHERE student_id = '$studentID'";
    $resultCheck = mysqli_query($koneksi, $queryCheck);

    if (!$resultCheck) {
        echo "Terjadi kesalahan dalam memeriksa pengumuman.";
        exit;
    }

    if (mysqli_num_rows($resultCheck) > 0) {
        // Jika pengumuman sudah ada, lakukan update data
        $queryUpdate = "UPDATE announcements SET tgl_pengumuman = '$tanggalPengumuman', hasil_seleksi = '$hasilSeleksi' WHERE student_id = '$studentID'";
        $resultUpdate = mysqli_query($koneksi, $queryUpdate);

        if (!$resultUpdate) {
            echo "Terjadi kesalahan dalam memperbarui pengumuman.";
            exit;
        }

        echo "Pengumuman berhasil diperbarui!";
        header('Location: admin.php');
    } else {
        // Jika pengumuman belum ada, lakukan input data baru
        $queryInsert = "INSERT INTO announcements (student_id, tgl_pengumuman, hasil_seleksi)
                        VALUES ('$studentID', '$tanggalPengumuman', '$hasilSeleksi')";
        $resultInsert = mysqli_query($koneksi, $queryInsert);

        if (!$resultInsert) {
            echo "Terjadi kesalahan dalam menyimpan pengumuman.";
            exit;
        }

        echo "Pengumuman berhasil disimpan!";
        header('Location: admin.php');
    }
}

mysqli_close($koneksi);
?>
