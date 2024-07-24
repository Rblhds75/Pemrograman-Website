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
    <title>Laporan Perbaikan Aset</title>
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
    <h3>Laporan Perbaikan Aset</h3>
    <!-- Form Pencarian -->
    <form method="GET" action="">
        <input type="text" name="search_nama_aset" placeholder="Cari nama aset...">
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Perbaikan</th>
            <th>Nama Aset</th>
            <th>Tanggal Perbaikan</th>
            <th>Keterangan</th>
            <th>Biaya</th>
            <th>Aksi</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT perbaikan.*, aset.nama_aset FROM perbaikan 
                  JOIN aset ON perbaikan.id_aset = aset.id_aset WHERE 1=1";

        // Cek apakah ada pencarian
        if (isset($_GET['search_nama_aset']) && !empty($_GET['search_nama_aset'])) {
            $search_nama_aset = $_GET['search_nama_aset'];
            $query .= " AND aset.nama_aset LIKE '%$search_nama_aset%'";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['id_perbaikan'] . "</td>
                <td>" . $tampil['nama_aset'] . "</td>
                <td>" . $tampil['tanggal_perbaikan'] . "</td>
                <td>" . $tampil['keterangan'] . "</td>
                <td>" . $tampil['biaya'] . "</td>
                <td><a href='laporan_perbaikan.php?id=" . $tampil['id_perbaikan'] . "'>Hapus</a></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET['id'])) {
        mysqli_query($con, "DELETE FROM perbaikan WHERE id_perbaikan='$_GET[id]'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=laporan_perbaikan.php'>";
    }
    ?>
</div>
</body>
</html>
