<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="###">Digital Library</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link"href="../logout.php" >Logout</a>
                    
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="pinjambuku.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Pinjam Buku
                            </a>
                            <a class="nav-link" href="kembalikan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                 Buku Yang di Pinjam
                            </a>
                            <a class="nav-link" href="koleksi.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                Koleksi
                            </a>
                            <a class="nav-link" href="pesan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-inbox"></i></div>
                                Pesan                                    <?php

include '../koneksi.php';

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


// Melakukan query untuk menghitung jumlah data di dalam tabel
$query = "SELECT COUNT(*) AS total FROM pesan WHERE status='belum dibaca' and username='$_SESSION[username]' "; // Ganti 'nama_tabel' dengan nama tabel Anda
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
                            </a>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <?php
                    include '../koneksi.php';
        $tampilPeg    =mysqli_query($conn, "SELECT * FROM user WHERE username='$_SESSION[username]'");
        $peg    =mysqli_fetch_array($tampilPeg);
    ?>
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['username']; ?> (<?=$peg['level']?>)
                    </div>
                </nav>
            </div>