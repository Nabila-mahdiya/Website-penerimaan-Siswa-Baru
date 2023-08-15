<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Petugas Seleksi</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin-top: 20px;
            background-color: rgb();
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <?php generateHeader(); ?>
    <?php NavSeleksi(); ?>
    <div class="container">
        <h2>Data Calon Siswa</h2>

        <!-- Form untuk memasukkan jumlah baris -->
        <form method="POST" action="">
            <label for="jumlahBaris">Masukkan Jumlah Baris:</label>
            <input type="number" name="jumlahBaris" id="jumlahBaris" required>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jumlahBaris = $_POST['jumlahBaris'];

            // Tampilkan tabel data calon siswa dengan jumlah baris yang ditentukan
            echo '<form method="POST" action="proses_insert2.php">';
            echo '<table class="table table-striped">';
            echo '<thead>
              <tr>
                <th>Nama Lengkap</th>
                <th>Nilai Wawancara</th>
                <th>Nilai Ujian</th>
                <th>Aksi</th>
              </tr>
            </thead>';
            echo '<tbody>';

            for ($i = 1; $i <= $jumlahBaris; $i++) {
                echo '<tr>';
                echo '<td><input type="text" name="namaLengkap[]" placeholder="Masukkan nama lengkap" required></td>';
                echo '<td><input type="text" name="nilaiWawancara[]" placeholder="Masukkan nilai wawancara" required></td>';
                echo '<td><input type="text" name="nilaiUjian[]" placeholder="Masukkan nilai ujian" required></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '<button type="submit" name="submit" class="btn btn-primary mx-1">Simpan</button>';

            // Button Update dan Delete
            // echo '<button type="button" class="btn btn-primary mx-1" onclick="updateData()">Update</button>';
            echo '<button type="button" class="btn btn-danger mx-1" onclick="deleteData()">Delete</button>';

            echo '</form>';
        }
        ?>
    </div>

    <!-- Load Bootstrap JS -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
    // function updateData() {
    //     // Mendapatkan data pada kolom input
    //     var namaLengkap = document.getElementsByName('namaLengkap[]');
    //     var nilaiWawancara = document.getElementsByName('nilaiWawancara[]');
    //     var nilaiUjian = document.getElementsByName('nilaiUjian[]');

    //     // Membuat array untuk menyimpan data pembaruan
    //     var dataToUpdate = [];

    //     // Mengisi array dengan data pembaruan
    //     for (var i = 0; i < namaLengkap.length; i++) {
    //         var data = {
    //             namaLengkap: namaLengkap[i].value,
    //             nilaiWawancara: nilaiWawancara[i].value,
    //             nilaiUjian: nilaiUjian[i].value
    //         };
    //         dataToUpdate.push(data);
    //     }

    //     // Mengirim data menggunakan AJAX ke proses_insert2.php
    //     $.ajax({
    //         url: 'proses_update.php',
    //         method: 'POST',
    //         data: { dataToUpdate: dataToUpdate },
    //         success: function(response) {
    //             console.log(response); // Menampilkan respon dari proses_insert2.php
    //             // Tambahkan logika lain yang ingin Anda lakukan setelah pembaruan data berhasil
    //         },
    //         error: function() {
    //             console.log('Terjadi kesalahan dalam memperbarui data.');
    //         }
    //     });
    // }

    function deleteData() {
        // Mendapatkan data pada kolom input
        var namaLengkap = document.getElementsByName('namaLengkap[]');

        // Membuat array untuk menyimpan data nama lengkap
        var dataToDelete = [];

        // Mengisi array dengan data nama lengkap
        for (var i = 0; i < namaLengkap.length; i++) {
            dataToDelete.push(namaLengkap[i].value);
        }

        // Mengirim data menggunakan AJAX ke proses_delete.php
        $.ajax({
            url: 'proses_delete.php',
            method: 'POST',
            data: { dataToDelete: dataToDelete },
            success: function(response) {
                console.log(response); // Menampilkan respon dari proses_delete.php
                // Tambahkan logika lain yang ingin Anda lakukan setelah penghapusan data berhasil
            },
            error: function() {
                console.log('Terjadi kesalahan dalam menghapus data.');
            }
        });
    }
</script>

</body>

</html>
