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
    <title>Data Penggantian Aset</title>
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
    <h3>Data Penggantian Aset</h3>
    <!-- Form Pencarian -->
    <form method="GET" action="">
        <input type="text" name="search_nama_aset_lama" placeholder="Cari nama aset lama...">
        <input type="text" name="search_nama_aset_baru" placeholder="Cari nama aset baru...">
        <input type="date" name="search_tanggal_penggantian" placeholder="Cari tanggal penggantian...">
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Penggantian</th>
            <th>Nama Aset Lama</th>
            <th>Nama Aset Baru</th>
            <th>Tanggal Penggantian</th>
            <th>Alasan Penggantian</th>
            <th>Aksi</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT penggantian.*, aset_lama.nama_aset AS nama_aset_lama, aset_baru.nama_aset AS nama_aset_baru 
                  FROM penggantian 
                  JOIN aset AS aset_lama ON penggantian.id_aset_lama = aset_lama.id_aset 
                  JOIN aset AS aset_baru ON penggantian.id_aset_baru = aset_baru.id_aset WHERE 1=1";

        // Cek apakah ada pencarian
        if (isset($_GET['search_nama_aset_lama']) && !empty($_GET['search_nama_aset_lama'])) {
            $search_nama_aset_lama = $_GET['search_nama_aset_lama'];
            $query .= " AND aset_lama.nama_aset LIKE '%$search_nama_aset_lama%'";
        }
        if (isset($_GET['search_nama_aset_baru']) && !empty($_GET['search_nama_aset_baru'])) {
            $search_nama_aset_baru = $_GET['search_nama_aset_baru'];
            $query .= " AND aset_baru.nama_aset LIKE '%$search_nama_aset_baru%'";
        }
        if (isset($_GET['search_tanggal_penggantian']) && !empty($_GET['search_tanggal_penggantian'])) {
            $search_tanggal_penggantian = $_GET['search_tanggal_penggantian'];
            $query .= " AND penggantian.tanggal_penggantian = '$search_tanggal_penggantian'";
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
                <td><a href='data_penggantian.php?id=" . $tampil['id_penggantian'] . "'>Hapus</a></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET['id'])) {
        mysqli_query($con, "DELETE FROM penggantian WHERE id_penggantian='$_GET[id]'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=data_penggantian.php'>";
    }
    ?>
</div>
</body>
</html>
