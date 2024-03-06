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
            echo '<script>alert("Pendaftaran berhasil! Terima kasih, ' . $username . ', telah mendaftar dengan email ' . $email . '");
            // Redirect setelah 3 detik
            setTimeout(function() {
                window.location.href = "login.php";
            }, 1000); // 1000 milidetik (3 detik)
            </script>';
        
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Menutup koneksi
mysqli_close($conn);
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - Digital Library SMK ARTANITA</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Daftar AKun</h3></div>
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
                                                        <input class="form-control" type="hidden" placeholder="Alamat Lengkap" name="level" value="peminjam"/>
                                                        <label for="inputPasswordConfirm">Alamat Lengkap</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block">Daftar</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Sudah punya akun? Silahkan Login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
