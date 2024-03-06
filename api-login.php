<?php
// mengaktifkan session pada php
ob_start();
session_start();

include 'koneksi.php';
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5('password');

$login = mysqli_query($conn,"SELECT * FROM user WHERE username= '$username' and password='$password'");

$cek = mysqli_num_rows($login);

if($cek > 0){

 $data = mysqli_fetch_assoc($login);

 if($data['level']=="admin"){

  $_SESSION['username'] = $username;
  $_SESSION['level'] = "admin";
  header("location:index.php");

 }else if($data['level']=="peminjam"){

  $_SESSION['username'] = $username;
  $_SESSION['level'] = "peminjam";
  header("location:user/");

 }else if($data['level']=="petugas"){

  $_SESSION['username'] = $username;
  $_SESSION['level'] = "petugas";
  header("location:petugas/databuku.php");

 }
}else{
  die("<script>window.location= 'login.php'</script>");
}

?>