<?php
include '../koneksi.php';

 ob_start();
 session_start();
 
 if(!isset($_SESSION['username'])){
    die("<script>window.location= '../login.php'</script>");//
}
if($_SESSION['level']!="peminjam")
{
    die("<script>window.location= '../login.php'</script>");
}


$id = $_GET['koleksiID']; // Ambil ID data dari parameter URL

// Query untuk menghapus data dari tabel mahasiswa
$query = "DELETE FROM koleksipribadi WHERE koleksiID=$id";
$result = mysqli_query($conn, $query);

if ($result) {
    header('Location: koleksi.php'); // Redirect kembali ke halaman utama setelah berhasil menghapus data
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>