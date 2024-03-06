<?php 
 
include 'koneksi.php';

 ob_start();
 session_start();
 
 if(!isset($_SESSION['username'])){
    die("<script>window.location= 'login.php'</script>");//
}
if($_SESSION['level']!="admin")
{
    die("<script>window.location= 'login.php'</script>");
}
?>

<?php
// Fungsi untuk memeriksa apakah email sudah terdaftar di database
function isEmailExists($conn, $email) {
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses formulir saat metode POST dipanggil

    // Validasi input
    $username = $_POST["username"];
    $password = md5("password");
    $email = $_POST["email"];
    $namalengkap = $_POST["namalengkap"];
    $alamat = $_POST["alamat"];
    $level = $_POST["level"];

    if (empty($username) || empty($email)) {
        echo '<script>alert("Harap lengkapi semua bidang!");</script>';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo '<script>alert("Format email tidak valid!");</script>';
    } elseif (isEmailExists($conn, $email)) {
        echo '<script>alert("Email sudah terdaftar!");</script>';
    } else {
        // Proses penyimpanan data
        $query = "INSERT INTO user (username, password, email, namalengkap, alamat, level) VALUES ('$username', '$password' ,'$email', '$namalengkap', '$alamat', '$level')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Menambahkan berhasil! Terima kasih, ' . $username . ', telah mendaftar dengan email ' . $email . '");
            // Redirect setelah 3 detik
            setTimeout(function() {
                window.location.href = "setting.php";
            }, 1000); // 1000 milidetik (3 detik)
            </script>';
        
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Menutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Peminjam - Digital Library SMK ARTANITA</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
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
                        <h1 class="mt-4">Setting</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Setting</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Halaman Setting Akun
                            </div>
                            <button onclick="showOverlay()" class="btn btn-primary">Tambahkan Pengguna</button>
                            <div id="overlay" class="overlay">
                               
    <div class="overlay-content" style="width:70%;">
      
        <h2>Tambah Akun</h2>
        <div class="card-body">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" placeholder="Username" name="username" />
                                                        <label for="inputFirstName">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="password" name="password" placeholder="Password" />
                                                        <label for="inputLastName">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="email" placeholder="name@example.com" name="email"/>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" placeholder="Nama Lengkap" name="namalengkap" />
                                                        <label for="inputPassword">Nama Lengkap</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" placeholder="Alamat Lengkap" name="alamat"/>
                                                        <label for="inputPasswordConfirm">Alamat Lengkap</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mt-3 mb-md-0">
                                                        <select class="form-control" name="level">
                                                            <option value="admin" >admin</option>
                                                            <option value="petugas" >petugas</option>
                                                            <option value="peminjam" >peminjam</option>
                                                        </select>
                                                        <label for="inputPasswordConfirm">Sebagai</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block">Daftar</button></div>
                                            </div>
                                        </form>
                                        <button onclick="hideOverlay()" class="btn btn-danger" style="width:100%;margin-top:5px;">Kembali</button>
                                    </div>
    </div>
</div>
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Sebagai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Sebagai</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
    include 'koneksi.php';
    // Memeriksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Melakukan query untuk mendapatkan data dari tabel
    $query = "SELECT * FROM user"; // Ganti 'nama_tabel' dengan nama tabel Anda
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Menampilkan data ke dalam tabel HTML
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['namalengkap'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['level'] . "</td>";
            echo "<td><a href='edituser.php?userID=" . $row['userID'] . "'>Edit</a> | <a href='hapususer.php?userID=" . $row['userID'] . "'>Hapus</a></td>";
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
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
