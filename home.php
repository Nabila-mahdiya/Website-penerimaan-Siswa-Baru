<?php
session_start();
include "koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}
$user = $_SESSION['username'];
$sql = "SELECT * from users where username='$user'";
$query = $koneksi->query($sql);
$data = $query->fetch_array();
?>
Selamat Datang
<?php echo $user; ?></br>
<?php
if ($data['level'] == 'Administrator') {
?>

    <?php  header('location:UserManagement.php');

} elseif ($data['level'] == 'Tim Seleksi') {
?>
    <?php header('location:form_seleksi.php');


} elseif ($data['level'] == 'Calon Siswa') {
?>
    <?php  header('location:form_pendaftaran.php');?>
<?php
}