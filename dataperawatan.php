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
    <meta http-equiv="X-UA-Compatible="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin.css">
    <title>Data Perawatan</title>
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
    <h3>Data Perawatan</h3>
    <!-- Form Pencarian -->
    <form method="GET" action="">
        <input type="text" name="search_nama_aset" placeholder="Cari nama aset...">
        <input type="text" name="search_kategori" placeholder="Cari kategori...">
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Perawatan</th>
            <th>Nama Aset</th>
            <th>Kategori</th>
            <th>Tanggal Perawatan</th>
            <th>Keterangan</th>
            <th>Biaya</th>
            <th>Aksi</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT perawatan.*, aset.nama_aset, aset.kategori FROM perawatan 
                  JOIN aset ON perawatan.id_aset = aset.id_aset WHERE 1=1";

        // Cek apakah ada pencarian
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
                <td><a href='data_perawatan.php?id=" . $tampil['id_perawatan'] . "'>Hapus</a></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET['id'])) {
        mysqli_query($con, "DELETE FROM perawatan WHERE id_perawatan='$_GET[id]'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=data_perawatan.php'>";
    }
    ?>
</div>
</body>
</html>
