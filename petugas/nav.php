<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Digital Library</a>
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
                
                            <a class="nav-link" href="databuku.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Data Buku
                            </a>
                            <a class="nav-link" href="datapeminjam.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Data Peminjam
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