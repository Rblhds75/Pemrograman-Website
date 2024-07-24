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
    <title>Laporan Perawatan dan Penggantian Aset</title>
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
    <h3>Laporan Perawatan dan Penggantian Aset</h3>
    <form method="GET" action="">
        <input type="text" name="search_nama_aset" placeholder="Cari nama aset...">
        <input type="text" name="search_kategori" placeholder="Cari kategori...">
        <input type="submit" value="Cari">
    </form>

    <h4>Data Perawatan</h4>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Perawatan</th>
            <th>Nama Aset</th>
            <th>Kategori</th>
            <th>Tanggal Perawatan</th>
            <th>Keterangan</th>
            <th>Biaya</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT perawatan.*, aset.nama_aset, aset.kategori FROM perawatan 
                  JOIN aset ON perawatan.id_aset = aset.id_aset WHERE 1=1";

        if (isset($_GET['search_nama_aset']) && !empty($_GET['search_nama_aset'])) {
            $search_nama_aset = $_GET['search_nama_aset'];
            $query .= " AND aset.nama_aset LIKE '%$search_nama_aset%'";
        }
        if (isset($_GET['search_kategori']) && !empty($_GET['search_kategori'])) {
            $search_kategori = $_GET['search_kategori'];
            $query .= " AND aset.kategori LIKE '%$search_kategori%'";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['id_perawatan'] . "</td>
                <td>" . $tampil['nama_aset'] . "</td>
                <td>" . $tampil['kategori'] . "</td>
                <td>" . $tampil['tanggal_perawatan'] . "</td>
                <td>" . $tampil['keterangan'] . "</td>
                <td>" . $tampil['biaya'] . "</td>
            </tr>";
        }
        ?>
    </table>

    <h4>Data Penggantian</h4>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Penggantian</th>
            <th>Nama Aset Lama</th>
            <th>Nama Aset Baru</th>
            <th>Tanggal Penggantian</th>
            <th>Alasan Penggantian</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT penggantian.*, aset_lama.nama_aset as nama_aset_lama, aset_baru.nama_aset as nama_aset_baru FROM penggantian 
                  JOIN aset as aset_lama ON penggantian.id_aset_lama = aset_lama.id_aset 
                  JOIN aset as aset_baru ON penggantian.id_aset_baru = aset_baru.id_aset WHERE 1=1";

        if (isset($_GET['search_nama_aset']) && !empty($_GET['search_nama_aset'])) {
            $search_nama_aset = $_GET['search_nama_aset'];
            $query .= " AND (aset_lama.nama_aset LIKE '%$search_nama_aset%' OR aset_baru.nama_aset LIKE '%$search_nama_aset%')";
        }
        if (isset($_GET['search_kategori']) && !empty($_GET['search_kategori'])) {
            $search_kategori = $_GET['search_kategori'];
            $query .= " AND (aset_lama.kategori LIKE '%$search_kategori%' OR aset_baru.kategori LIKE '%$search_kategori%')";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['id_penggantian'] . "</td>
                <td>" . $tampil['nama_aset_lama'] . "</td>
                <td>" . $tampil['nama_aset_baru'] . "</td>
                <td>" . $tampil['tanggal_penggantian'] . "</td>
                <td>" . $tampil['alasan_penggantian'] . "</td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
