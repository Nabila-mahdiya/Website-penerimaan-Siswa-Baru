<!DOCTYPE html>
<html>
<head>
    <title>Halaman Data Siswa</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Data Siswa</h1>

        <?php
        // Koneksi ke database
        $koneksi = mysqli_connect("localhost", "username", "password", "nama_database");

        // Query untuk mengambil data dari tabel students, registration, dan announcements
        $query = "SELECT students.student_id, students.nama_lengkap, students.jenis_kelamin, registration.status_pembayaran, announcements.hasil_seleksi
                  FROM students
                  LEFT JOIN registration ON students.student_id = registration.student_id
                  LEFT JOIN announcements ON students.student_id = announcements.student_id";

        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Pembayaran</th>
                        <th>Hasil Seleksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['nama_lengkap']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td><?php echo $row['status_pembayaran']; ?></td>
                            <td><?php echo $row['hasil_seleksi']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <div class="mt-4">
                <h3>Multi-Update</h3>
                <form action="update_data.php" method="POST">
                    <div class="mb-3">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <input type="text" class="form-control" name="status_pembayaran" placeholder="Masukkan status pembayaran">
                    </div>
                    <div class="mb-3">
                        <label for="hasil_seleksi">Hasil Seleksi</label>
                        <input type="text" class="form-control" name="hasil_seleksi" placeholder="Masukkan hasil seleksi">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <?php
        } else {
            echo "Data tidak ditemukan.";
        }

        // Tutup koneksi ke database
        mysqli_close($koneksi);
        ?>

    </div>

    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
