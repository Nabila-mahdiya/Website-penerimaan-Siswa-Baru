<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "username", "password", "nama_database");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data yang dikirim melalui formulir
    $statusPembayaran = $_POST['status_pembayaran'];
    $hasilSeleksi = $_POST['hasil_seleksi'];

    // Query untuk melakukan pembaruan pada tabel registration
    $queryRegistration = "UPDATE registration SET status_pembayaran = '$statusPembayaran'";
    $resultRegistration = mysqli_query($koneksi, $queryRegistration);

    // Query untuk melakukan pembaruan pada tabel announcements
    $queryAnnouncements = "UPDATE announcements SET hasil_seleksi = '$hasilSeleksi'";
    $resultAnnouncements = mysqli_query($koneksi, $queryAnnouncements);

    // Query untuk mengambil data dari tabel students
    $queryStudents = "SELECT student_id, nama_lengkap, jenis_kelamin FROM students";
    $resultStudents = mysqli_query($koneksi, $queryStudents);

    // Memeriksa apakah pembaruan dan pengambilan data berhasil dilakukan
    if ($resultRegistration && $resultAnnouncements && $resultStudents) {
        echo "Pembaruan data berhasil.";
        
        // Menampilkan data dari tabel students
        echo "<table>
                <tr>
                    <th>Student ID</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                </tr>";
                
        while ($row = mysqli_fetch_assoc($resultStudents)) {
            echo "<tr>
                    <td>" . $row['student_id'] . "</td>
                    <td>" . $row['nama_lengkap'] . "</td>
                    <td>" . $row['jenis_kelamin'] . "</td>
                </tr>";
        }
        
        echo "</table>";
    } else {
        echo "Terjadi kesalahan dalam pembaruan data: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
