<?php 
 
include '../koneksi.php';

 ob_start();
 session_start();
 
 if(!isset($_SESSION['username'])){
    die("<script>window.location= 'login.php'</script>");//
}
if($_SESSION['level']!="petugas")
{
    die("<script>window.location= 'login.php'</script>");
}
$id = $_GET['bukuID']; // Ambil ID data dari parameter URL

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunterbit = $_POST['tahunterbit'];

    // Query untuk mengupdate data di tabel mahasiswa
    $query = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahunterbit='$tahunterbit' WHERE bukuID=$id";
    $result = mysqli_query($conn, $query);
    

    if ($result) {
        header('Location: databuku.php'); // Redirect kembali ke halaman utama setelah berhasil mengedit data
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$query1 = "SELECT * FROM buku WHERE bukuID='$id'";
$result1 = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result1);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Buku - Digital Library SMK ARTANITA</title>
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
                        <h1 class="mt-4">Edit Data Buku</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Halaman Untuk Edit Data Buku
                            </div>
          
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                            <form method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                <input class="form-control"  type="hidden" placeholder="Username" name="bukuID" />

                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" name="judul" value='<?php echo $row['judul']; ?>'/>
                                                        <label for="inputFirstName">Judul Buku</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" name="penulis" value='<?php echo $row['penulis']; ?>' />
                                                        <label for="inputLastName">Penulis</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" name="penerbit" value='<?php echo $row['penerbit']; ?>'/>
                                                <label for="inputEmail">Penerbit</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" name="tahunterbit" value='<?php echo $row['tahunterbit']; ?>' />
                                                        <label for="inputPassword">Tahun Terbit</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block" name="submit">Daftar</button></div>
                                            </div>
                                        </form>
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
