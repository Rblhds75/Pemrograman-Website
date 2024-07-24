<?php
session_start();
include("php/config.php");

// Check if the user is logged in and is an admin
if (!isset($_SESSION['valid']) || $_SESSION['peran'] !== 'Admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <title>Laporan Aset dan Status Perbaikan</title>
</head>
<body>
<div class="nav">
    <div class="logo">
        <p><a href="admin.php">Admin Dashboard</a></p>
    </div>
    <div class="right-links">
        <a href="php/logout.php"><button class="btn">Log Out</button></a>
    </div>
</div>

<div class="data">
    <h3>Laporan Aset dan Status Perbaikan</h3>

    <form method="GET" action="">
        <input type="text" name="search_nama_aset" placeholder="Cari nama aset...">
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Aset</th>
            <th>Nama Aset</th>
            <th>Kategori</th>
            <th>Status Perbaikan</th>
            <th>Tanggal Perbaikan</th>
            <th>Keterangan</th>
            <th>Biaya</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT aset.id_aset, aset.nama_aset, aset.kategori, 
                  perbaikan.tanggal_perbaikan, perbaikan.keterangan, perbaikan.biaya 
                  FROM aset 
                  LEFT JOIN perbaikan ON aset.id_aset = perbaikan.id_aset WHERE 1=1";

        if (isset($_GET['search_nama_aset']) && !empty($_GET['search_nama_aset'])) {
            $search_nama_aset = $_GET['search_nama_aset'];
            $query .= " AND aset.nama_aset LIKE '%$search_nama_aset%'";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['id_aset'] . "</td>
                <td>" . $tampil['nama_aset'] . "</td>
                <td>" . $tampil['kategori'] . "</td>
                <td>" . ($tampil['tanggal_perbaikan'] ? 'Ada' : 'Tidak Ada') . "</td>
                <td>" . $tampil['tanggal_perbaikan'] . "</td>
                <td>" . $tampil['keterangan'] . "</td>
                <td>" . $tampil['biaya'] . "</td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
