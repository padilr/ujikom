<?php
// Mulai sesi
session_start();

// Memeriksa apakah pengguna sudah login sebagai admin
if (isset($_SESSION["username"]) && isset($_SESSION["level"]) && $_SESSION["level"] == "peminjam") {
} else {
    // Jika tidak, redirect ke halaman login
    header("Location: ../login.php");
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
        <title>Dashboard - Digital Library SMK ARTANITA</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/15e516fe35.js" crossorigin="anonymous"></script>
        <style>
  /* Style untuk overlay */
  #overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Warna overlay dengan transparansi */
    display: none; /* Mulai dengan tidak ditampilkan */
    z-index: 999; /* Pastikan overlay muncul di atas konten */
  }

  /* Style untuk konten overlay */
  #overlay-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 10px;
  }
</style>
    </head>
    <body class="sb-nav-fixed">
      <?php include 'nav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat datang <?php echo $_SESSION['username']; ?> di Digital Library SMK ARTANITA KOTA TASIKMALAYA</li>
                        </ol>
                        <div class="row">
                        <div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Buku Yang di Pinjam</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php

include '../koneksi.php';

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$kondisi1 = "username='$_SESSION[username]'";

// Melakukan query untuk menghitung jumlah data di dalam tabel
$query = "SELECT COUNT(*) AS total FROM peminjam WHERE $kondisi1"; // Ganti 'nama_tabel' dengan nama tabel Anda
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
    // Mendapatkan hasil query
    $row = mysqli_fetch_assoc($result);
    $total_pinjam = $row['total'];
    echo "$total_pinjam";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
?>
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Buku Yang Tersedia</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php

include '../koneksi.php';

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


// Melakukan query untuk menghitung jumlah data di dalam tabel
$query = "SELECT COUNT(*) AS total FROM buku"; // Ganti 'nama_tabel' dengan nama tabel Anda
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
    // Mendapatkan hasil query
    $row = mysqli_fetch_assoc($result);
    $total_pinjam = $row['total'];
    echo "$total_pinjam";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
?>
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Koleksi Pribadi</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?php

include '../koneksi.php';

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$kondisi1 = "username='$_SESSION[username]'";

// Melakukan query untuk menghitung jumlah data di dalam tabel
$query = "SELECT COUNT(*) AS total FROM koleksipribadi WHERE $kondisi1"; // Ganti 'nama_tabel' dengan nama tabel Anda
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
    // Mendapatkan hasil query
    $row = mysqli_fetch_assoc($result);
    $total_pinjam = $row['total'];
    echo "$total_pinjam";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
?>
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        



                            <div class="card-body">History Peminjaman</div>
                            <table id="datatablesSimple">
                            <thead >
                                <tr >
                                    <th>Kode Pinjaman</th>
                                    <th>Judul  Buku</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Kode Pinjaman</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    
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
    $query = "SELECT * FROM peminjam WHERE username='$_SESSION[username]'"; // Ganti 'nama_tabel' dengan nama tabel Anda
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Menampilkan data ke dalam tabel HTML
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['peminjamID'] . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['tanggalpeminjam'] . "</td>";
            echo "<td>" . $row['statuspeminjaman'] . "</td>";
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
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Digital Library SMK ARTANITA 2023</div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
