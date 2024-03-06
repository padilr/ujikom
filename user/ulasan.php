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
$id = $_GET['bukuID']; // Ambil ID data dari parameter URL

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $userID = $_POST['userID'];
    $bukuID = $_POST['bukuID'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];
    $judul = $_POST['judul'];
    $username = $_POST['username'];
    // Query untuk mengupdate data di tabel mahasiswa
    $query = "INSERT INTO ulasanbuku (userID, bukuID, ulasan, rating, judul, username) VALUES ('$userID', '$bukuID', '$ulasan', '$rating', '$judul', '$username')";
    $result = mysqli_query($conn, $query);
    

    if ($result) {
        header('Location: pinjambuku.php'); // Redirect kembali ke halaman utama setelah berhasil mengedit data
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$query1 = "SELECT * FROM buku WHERE bukuID='$id'";
$result1 = mysqli_query($conn, $query1);
$data = mysqli_fetch_assoc($result1);

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
                        <h1 class="mt-4">Memberi Ulasan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ulasan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Halaman Memberikan Ulasan Buku
                            </div>
          
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                            <form method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                <input class="form-control"  type="hidden" placeholder="Username" name="bukuID" />

                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" name="judul" value='<?php echo $data['judul']; ?>'/>
                                                        <label for="inputFirstName">Judul Buku</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" name="rating" />
                                                        <label for="inputLastName">Rating  1 - 4 (Kurang) 5 - 8 (Lumayan) 9 - 10 (Senang)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" name="ulasan" />
                                                <label for="inputLastName">Ulasan</label>
                                                <input class="form-control"  type="hidden" name="userID" value='<?=$peg['userID']?>'/>
                                                <input class="form-control"  type="hidden" name="bukuID" value='<?php echo $data['bukuID']; ?>'/>
                                            </div>
                                            <div class="row mb-6">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="hidden" name="username" value='<?=$peg['username']?>' />
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
                    <div class="card mb-4">
                           
                            <div class="card-body">
                                <table id="datatablesSimple"  >
                                    <thead>
                                        <tr>
                                            <th>Pengirim</th>
                                            <th>Judul Buku</th>
                                            <th>Rating</th>
                                            <th>Ulasan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Pengirim</th>
                                            <th>Judul Buku</th>
                                            <th>Rating</th>
                                            <th>Ulasan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody >
                                    <?php
    include '../koneksi.php';
    // Memeriksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Melakukan query untuk mendapatkan data dari tabel
    $query = "SELECT * FROM ulasanbuku WHERE bukuID='$id'"; // Ganti 'nama_tabel' dengan nama tabel Anda
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Menampilkan data ke dalam tabel HTML
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr >";
            echo "<td >" . $data['username'] . "</td>";
            echo "<td >" . $data['judul'] . "</td>";
            echo "<td>" . $data['rating'] . "</td>";
            echo "<td>" . $data['ulasan'] . "</td>";
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
