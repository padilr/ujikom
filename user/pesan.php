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

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pesan Peminjam - Digital Library SMK ARTANITA</title>
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
                        <h1 class="mt-4">Pesan </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pesan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Halaman Pesan Dari Admin
                            </div>

    
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                            <table id="datatablesSimple">
                            <thead >
                                <tr >
                                    <th>Kode Pesan</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode Pinjaman</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
    include '../koneksi.php';
    // Memeriksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Melakukan query untuk mendapatkan data dari tabel
    $query = "SELECT * FROM pesan WHERE username='$_SESSION[username]'"; // Ganti 'nama_tabel' dengan nama tabel Anda
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Menampilkan data ke dalam tabel HTML
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['pesanID'] . "</td>";
            echo "<td>" . $row['judulpesan'] . "</td>";
            echo "<td>" . $row['isipesan'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><a href='dibaca.php?pesanID=" . $row['pesanID'] . "'><i class='fa-solid fa-check'></i>Click Sudah Dibaca</a></td>";
            echo "</tr>";
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Menutup koneksi
    mysqli_close($conn);
    ?>
                            </tbody>
                        </table>
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
