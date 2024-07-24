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
    <title>Laporan Perbaikan Aset Berdasarkan Kategori</title>
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
    <h3>Laporan Perbaikan Aset Berdasarkan Kategori</h3>

    <form method="GET" action="">
        <input type="text" name="search_kategori" placeholder="Cari kategori...">
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Perbaikan</th>
            <th>Nama Aset</th>
            <th>Kategori</th>
            <th>Tanggal Perbaikan</th>
            <th>Keterangan</th>
            <th>Biaya</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT perbaikan.*, aset.nama_aset, aset.kategori 
                  FROM perbaikan 
                  JOIN aset ON perbaikan.id_aset = aset.id_aset 
                  WHERE 1=1";

        if (isset($_GET['search_kategori']) && !empty($_GET['search_kategori'])) {
            $search_kategori = $_GET['search_kategori'];
            $query .= " AND aset.kategori LIKE '%$search_kategori%'";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['id_perbaikan'] . "</td>
                <td>" . $tampil['nama_aset'] . "</td>
                <td>" . $tampil['kategori'] . "</td>
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
