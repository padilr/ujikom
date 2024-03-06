<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: login");
}
 

include 'koneksi.php';

if($conn === false){
    die("EROR: No Connect . " 
    .mysqli_connect_error());
}

$id = $_POST['id']
$a = $_POST['judul'];
$b = $_POST['penulis'];
$c = $_POST['penerbit'];
$d = $_POST['tahunterbit'];


$sql = "INSERT INTO buku VALUES ('$id','$a','$b','$c','$d')";

if(mysqli_query($conn, $sql)){   
 die("<script>window.location= 'databuku.php'</script>");
}else{
echo "Pendaftaran Gagal";
}

mysqli_close($conn);

?>