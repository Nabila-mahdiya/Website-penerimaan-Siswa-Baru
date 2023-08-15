 <?php
// session_start();
// include "koneksi.php";
// $username=$_POST['username'];
// $password=$_POST['password'];
// $op=$_GET['op'];

// if($op=="in"){
//     $query_1="SELECT * from users where username='$username'";
//     $h_1=$koneksi->query($query_1);
//     if(mysqli_num_rows($h_1)==1){
//         $d_1=$h_1->fetch_array();
//         if (password_verify($password, $d_1['password'])) {
//             // Login berhasil
//             // ...
//         } else {
//             die("Password salah <a href=\"javascript:history.back()\">kembali</a>");
//         }
//     } else {
//         die("Username tidak ditemukan <a href=\"javascript:history.back()\">kembali</a>");
//     }  
//         $_SESSION['username']=$d_1['username'];
//         $_SESSION['level']=$d_1['level'];
//         if($d_1['level']=="Administrator"){
//             header("location:home.php");
//         }
//         else if($d_1['level']=="Petugas Verifikasi"){
//             header("location:home.php");
//         }
//         else if($d_1['level']=="Tim Seleksi"){
//             header("location:home.php");
//         }
//         else if($d_1['level']=="Calon Siswa"){
//             header("location:home.php");
//         } else{
//             die("Password salah <a href=\"javascript:history.back()\">kembali</a>");
//         }
//     }
// else if($op=="out"){
//     unset($_SESSION['username']);
//     unset($_SESSION['level']);
//     header("location:form_login.php");
// }
session_start();
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];

if ($op == "in") {
    $query_1 = "SELECT * from users where username='$username'";
    $h_1 = $koneksi->query($query_1);
    if (mysqli_num_rows($h_1) == 1) {
        $d_1 = $h_1->fetch_array();
        $hashedPassword = md5($password);
        if ($hashedPassword === $d_1['password']) {
            $_SESSION['username'] = $d_1['username'];
            $_SESSION['level'] = $d_1['level'];
            if ($d_1['level'] == "Administrator" || $d_1['level'] == "Petugas Verifikasi" || $d_1['level'] == "Tim Seleksi" || $d_1['level'] == "Calon Siswa") {
                header("location: home.php");
                exit; // Make sure to exit after redirection
            } else {
                die("Level pengguna tidak valid");
            }
        } else {
            die("Password salah <a href=\"javascript:history.back()\">kembali</a>");
        }
    } else {
        die("Username tidak ditemukan <a href=\"javascript:history.back()\">kembali</a>");
    }
} else if ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    header("location: form_login.php");
    exit; // Make sure to exit after redirection
}
?> 

 
