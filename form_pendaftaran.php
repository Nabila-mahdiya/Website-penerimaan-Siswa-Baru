<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-color: rgb(137, 207, 240);
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <?php generateHeader(); ?>
    <?php NavSiswa(); ?>
    <div class="container">
        <h2>Formulir Pendaftaran</h2>
        <form method="POST" action="aksi_pendaftaran.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih jenis kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Provinsi:</label>
                    <select name="provinsi_id" id="provinsi_id" class="form-select" required>
                        <option value="">Pilih Provinsi</option>
                        <!-- Opsi Provinsi akan diisi secara dinamis -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kota_id" class="form-label">Kota:</label>
                    <select name="kota_id" id="kota_id" class="form-select" required>
                        <option value="">Pilih Kota</option>
                        <!-- Opsi Kota akan diisi secara dinamis -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kecamatan_id" class="form-label">Kecamatan:</label>
                    <select name="kecamatan_id" id="kecamatan_id" class="form-select" required>
                        <option value="">Pilih Kecamatan</option>
                        <!-- Opsi Kecamatan akan diisi secara dinamis -->
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
            </div>
            <div class="mb-3">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                    <option value="">Pilih pendidikan terakhir</option>
                    <option value="SD">SD</option>
                    <option value="MI">MI</option>
                    <option value="Swasta">Swasta</option>

                </select>
            </div>
            <hr>
            <h4>Data Orang Tua</h4>
            <div class="mb-3">
                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
            </div>

            <div class="mb-3">
                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
            </div>
            <div class="mb-3">
                <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua</label>
                <textarea class="form-control" id="alamat_orang_tua" name="alamat_orang_tua" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="nomor_telepon_orang_tua" class="form-label">Nomor Telepon Orang Tua</label>
                <input type="tel" class="form-control" id="nomor_telepon_orang_tua" name="nomor_telepon_orang_tua" required>
            </div>
            <hr>
            <h4>Upload File</h4>
            <div class="mb-3">
                <label for="foto_siswa" class="form-label">Foto Siswa (jpg/png/jpeg, maksimal 2 MB)</label>
                <input type="file" class="form-control" id="foto_siswa" name="foto_siswa" accept="image/jpeg, image/png" required>
            </div>
            <div class="mb-3">
                <label for="kartu_keluarga" class="form-label">Kartu Keluarga (pdf/jpg/doc, maksimal 2 MB)</label>
                <input type="file" class="form-control" id="kartu_keluarga" name="kartu_keluarga" accept="application/pdf, image/jpeg, application/msword" required>
            </div>
            <div class="mb-3">
                <label for="surat_rekomendasi" class="form-label">Surat Rekomendasi (pdf/jpg/doc, maksimal 2 MB)</label>
                <input type="file" class="form-control" id="surat_rekomendasi" name="surat_rekomendasi" accept="application/pdf, image/jpeg, application/msword" required>
            </div>
            <hr>
            <div class="mb-3">
                <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran" required>
            </div>
            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                <select class="form-select" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="">Pilih status pembayaran</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk memuat data provinsi
        function loadProvinsi() {
            $.ajax({
                url: "get_provinsi.php?type=provinsi",
                type: "GET",
                success: function(data) {
                    $("#provinsi_id").html(data);
                }
            });
        }

        // Fungsi untuk memuat data kota berdasarkan provinsi yang dipilih
        function loadKota(provinsiId) {
            $.ajax({
                url: "get_kota.php?type=kota&provinsi_id=" + provinsiId,
                type: "GET",
                success: function(data) {
                    $("#kota_id").html(data);
                }
            });
        }

        // Fungsi untuk memuat data kecamatan berdasarkan kota yang dipilih
        function loadKecamatan(kotaId) {
            $.ajax({
                url: "get_kecamatan.php?type=kecamatan&kota_id=" + kotaId,
                type: "GET",
                success: function(data) {
                    $("#kecamatan_id").html(data);
                }
            });
        }

        // Panggil fungsi loadProvinsi saat halaman selesai dimuat
        $(document).ready(function() {
            loadProvinsi();
        });

        // Panggil fungsi loadKota saat provinsi dipilih
        $("#provinsi_id").change(function() {
            var provinsiId = $(this).val();
            loadKota(provinsiId);
        });

        // Panggil fungsi loadKecamatan saat kota dipilih
        $("#kota_id").on("change", function() {
            var kotaId = $(this).val();
            loadKecamatan(kotaId);
        });
    </script>
</body>

</html>