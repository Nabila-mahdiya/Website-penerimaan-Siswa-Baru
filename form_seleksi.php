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
    }
    </style>
</head>
<body>
<?php include 'nav.php'; ?>
<?php generateHeader();?>
<?php NavSeleksi();?>
<div class="container">
  <h2>Data Calon Siswa</h2>

  <!-- Tampilkan tabel data calon siswa -->
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nama Lengkap</th>
      <th>Nilai Wawancara</th>
      <th>Nilai Ujian</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Ambil data calon siswa dari tabel students
    include 'koneksi.php';

    // Query untuk mengambil data calon siswa yang belum memiliki nilai
    $query = "SELECT s.student_id, s.nama_lengkap FROM students s LEFT JOIN selections sel ON s.student_id = sel.student_id WHERE sel.student_id IS NULL";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $studentId = $row['student_id'];
      $namaLengkap = $row['nama_lengkap'];
    ?>
      <tr>
        <td><?php echo $namaLengkap; ?></td>
        <td>
          <!-- Form nilai wawancara -->
          <input type="text" name="nilaiWawancara[<?php echo $studentId; ?>]" id="nilaiWawancara_<?php echo $studentId; ?>" placeholder="Masukkan nilai wawancara" required>
        </td>
        <td>
          <!-- Form nilai ujian -->
          <input type="text" name="nilaiUjian[<?php echo $studentId; ?>]" id="nilaiUjian_<?php echo $studentId; ?>" placeholder="Masukkan nilai ujian" required>
        </td>
        <td>
          <!-- Tombol aksi untuk menyimpan nilai wawancara dan nilai ujian -->
          <button type="button" class="btn btn-primary" onclick="simpanNilai(<?php echo $studentId; ?>)">Simpan</button>
        </td>
      </tr>
    <?php
    }
    mysqli_close($koneksi);
    ?>
  </tbody>
</table>

</div>

<!-- Load Bootstrap JS -->
<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
 function simpanNilai(studentId) {
  // Ambil nilai wawancara dan nilai ujian dari input
  var nilaiWawancara = $("#nilaiWawancara_" + studentId).val();
  var nilaiUjian = $("#nilaiUjian_" + studentId).val();

  // Kirim data ke proses_insert.php untuk disimpan pada tabel selections
  $.ajax({
    type: "POST",
    url: "proses_insert.php",
    data: {
      studentId: studentId,
      nilaiWawancara: nilaiWawancara,
      nilaiUjian: nilaiUjian
    },
    success: function(response) {
      alert(response); // Menampilkan pesan dari proses_insert.php
      location.reload(); // Refresh halaman setelah menyimpan data
    },
    error: function() {
      alert("Terjadi kesalahan dalam menyimpan data.");
    }
  });
}

</script>
</body>
</html>
