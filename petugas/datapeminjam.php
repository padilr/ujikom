<?php 
 
 ob_start();
 session_start();
 
if(!isset($_SESSION['username'])){
    die("<script>window.location= '../login.php'</script>");
}
if($_SESSION['level']!="petugas")
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
        <title>Data Peminjam - Digital Library SMK ARTANITA</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include 'nav.php'; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Peminjam</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                            <button class="btn btn-success"  onclick="exportToExcel('tblexportData')">Download Data</button>

<table id="datatablesSimple">
    <thead>
        <tr>
            <th>PeminjamanID</th>
            <th>Username</th>
            <th>BukuID</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Peminjaman</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>PeminjamanID</th>
            <th>Username</th>
            <th>BukuID</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Peminjaman</th>
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
$query = "SELECT * FROM peminjam"; // Ganti 'nama_tabel' dengan nama tabel Anda
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
// Menampilkan data ke dalam tabel HTML
while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row['peminjamID'] . "</td>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['bukuID'] . "</td>";
echo "<td>" . $row['tanggalpeminjam'] . "</td>";
echo "<td>" . $row['tanggalpengembalian'] . "</td>";
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
<table style="display:none;" id="tblexportData">
    <thead>
        <tr>
            <th>PeminjamanID</th>
            <th>Username</th>
            <th>BukuID</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Peminjaman</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>PeminjamanID</th>
            <th>Username</th>
            <th>BukuID</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Peminjaman</th>
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
$query = "SELECT * FROM peminjam"; // Ganti 'nama_tabel' dengan nama tabel Anda
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
// Menampilkan data ke dalam tabel HTML
while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row['peminjamID'] . "</td>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['bukuID'] . "</td>";
echo "<td>" . $row['tanggalpeminjam'] . "</td>";
echo "<td>" . $row['tanggalpengembalian'] . "</td>";
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
        <script type="text/javascript">
function exportToExcel(tableID, filename = ''){
    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'export_excel_data.xls';
    
    // Create download link element
    downloadurl = document.createElement("a");
    
    document.body.appendChild(downloadurl);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
    }
}
 
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
