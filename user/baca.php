<?php 
 

 ob_start();
 session_start();
 
 if(!isset($_SESSION['username'])){
    die("<script>window.location= '../login.php'</script>");//
}
if($_SESSION['level']!="peminjam")
{
    die("<script>window.location= '../login.php'</script>");
}

include '../koneksi.php';

$id = $_GET['bukuID']; // Ambil ID data dari parameter URL

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $userID = $_POST['userID'];
    $bukuID = $_POST['bukuID'];
    $tanggalpeminjam = $_POST['tanggalpeminjam'];
    $tanggalpengembalian = $_POST['tanggalpengembalian'];
    $statuspeminjaman = $_POST['statuspeminjaman'];
    $username = $_POST['username'];
    $judul = $_POST['judul'];

    // Query untuk mengupdate data di tabel mahasiswa
    $query = "INSERT INTO peminjam (userID, bukuID, tanggalpeminjam, tanggalpengembalian, statuspeminjaman, username, judul) VALUES ('$userID', '$bukuID', '$tanggalpeminjam', '$tanggalpengembalian', '$statuspeminjaman', '$username', '$judul')";
    $result = mysqli_query($conn, $query);
    

    if ($result) {
        header('Location: pinjambuku.php'); // Redirect kembali ke halaman utama setelah berhasil mengedit data
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$ambil = "SELECT * FROM buku WHERE bukuID='$id'";
$tampil = mysqli_query($conn, $ambil);
$data = mysqli_fetch_assoc($tampil);

?>

<?php
        $tampilPeg    =mysqli_query($conn, "SELECT * FROM user WHERE username='$_SESSION[username]'");
        $peg    =mysqli_fetch_array($tampilPeg);
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pinjam Buku - Digital Library SMK ARTANITA</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
    /* CSS untuk overlay */
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }
    .overlay-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
</style>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'nav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Baca Buku</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Baca</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Halaman Baca Buku
                            </div>
          
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                                <h3><?php echo $data['judul']; ?></h3> <br>
                                <p> <?php echo $data['kontenbuku']; ?></p>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
  // Fungsi untuk menampilkan overlay
  function showOverlay() {
        document.getElementById('overlay').style.display = 'block';
    }

    // Fungsi untuk menyembunyikan overlay
    function hideOverlay() {
        document.getElementById('overlay').style.display = 'none';
    }
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
