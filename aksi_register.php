<?php
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username=$_POST['username'];
$password=$_POST['password'];
$ulangipassword=$_POST['ulangipassword'];
$level=$_POST['level'];
$namalengkap=$_POST['namalengkap'];
$email=$_POST['email'];

if($password !== $ulangipassword){
    echo "<script>alert('Ulangi, password Anda tidak sama.');</script>";
}else{
    $hashedPassword = md5($password);
    $sql="INSERT INTO users (username,password,level,nama_lengkap,email) VALUES ('".$username."','".$hashedPassword."','".$level."','".$namalengkap."','".$email."')";
    $b=$koneksi->query($sql);
    if($b === true){
        echo "<script>alert('Anda sukses registrasi.');
        window.location.href='form_login.php';</script)";
        header('location:form_login.php');
    }else{
        echo "<script>alert('Gagal registrasi.');</script>";
    }

}
}
?>