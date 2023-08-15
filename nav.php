<?php
function generateHeader()
{
    echo '
    <style>
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 30 30\'%3e%3cpath stroke=\'rgba%2870, 130, 180, 1%29\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' stroke-width=\'2\' d=\'M4 7h22M4 15h22M4 23h22\'/%3e%3c/svg%3e");
    }
    .content {
        font-size: 20px;
        color: rgb(51, 102, 204);
    }
    .footer {
        background-color: #f9f9f9;
        margin-top: 10px;
        color: rgb(51, 102, 204);
        text-align: center;
    }
    .navbar-toggler {
        border: 1px solid rgb(70, 130, 180);
    }
    </style>
    ';
}
function NavAdmin()
{
    echo '
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid content">
                <img class="navbar-brand" src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" height="80">Sekolah Menengah Pertama</img>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse content" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="UserManagement.php">Konfigurasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Manajemen Pengumuman</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><button type="button" class="btn btn-outline-info" style="height: 35px; font-size: 17px;">Logout</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    ';

}
function NavSeleksi()
{
    echo '
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid content">
                <img class="navbar-brand" src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" height="80">Sekolah Menengah Pertama</img>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse content" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="form_seleksi.php">Input Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_rekap.php">Rekap Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_calon_siswa.php">Data Calon Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><button type="button" class="btn btn-outline-info" style="height: 35px; font-size: 17px;">Logout</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    ';

}
function NavSiswa()
{
    echo '
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid content">
                <img class="navbar-brand" src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" height="80">Sekolah Menengah Pertama</img>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse content" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="form_pendaftaran.php">Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pengumuman_siswa.php">Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Profil.php">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><button type="button" class="btn btn-outline-info" style="height: 35px; font-size: 17px;">Logout</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    ';

}
function generateNav()
{
    echo '
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid content">
                <img class="navbar-brand" src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_of_Ministry_of_Education_and_Culture_of_Republic_of_Indonesia.svg" height="80">Sekolah Menengah Pertama</img>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse content" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="UI_home.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="UI_VisiMisi.php">Visi Misi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="UI_alur_pendaftaran.php">Alur Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_login.php"><button type="button" class="btn btn-outline-info" style="height: 35px; font-size: 17px;">Login</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
    ';

}


function generateFooter()
{
    echo '
        <footer class="footer" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5>Kontak:</h5>
                        <p >Alamat: Jalan Sucipto, Kota Sumbawa, Negara Indonesia</p>
                        <p>Email: example@example.com</p>
                        <p>Telepon: +1234567890</p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    ';
}
?>