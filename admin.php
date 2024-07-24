<?php
session_start();
include("php/config.php");

// Memeriksa apakah pengguna telah login dan merupakan admin
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
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="admin.php">Admin Dashboard</a></p>
            <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>

        <div class="right-links">
            <a href="home.php"><button class="btn">Dashboard User</button></a>
        </div>
        <div class="right-links">
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <div class="main-box">
        <div class="middle">
            <div class="box">
                <a href="laporan1.php">Laporan Perawatan dan Penggantian Aset</a>
            </div>
            <div class="box">
                <a href="laporan2.php">Laporan Perbaikan dan Penggantian Aset</a>
            </div>
            <div class="box">
                <a href="laporan3.php">Laporan Aset dan Status Perbaikan</a>
            </div>
            <div class="box">
                <a href="laporan4.php">Laporan Penggantian Aset Terakhir</a>
            </div>
            <div class="box">
                <a href="laporan5.php">Laporan Perbaikan Aset Berdasarkan Kategori</a>
            </div>
            <!-- Add more admin functionalities here -->
        </div>
    </div>
    <div class="main-box">
        <div class="left">
            <div class="box">
                <a href="addakun.html">Tambah Akun</a>
            </div>
            <div class="box">
                <a href="manage_users.php">Manage Akun Users</a>
            </div>
            <div class="box">
                <a href="datakaryawan.php">Data Karyawan</a>
            </div>
            <div class="box">
                <a href="dataaset.php">Data Aset</a>
            </div>
            <div class="box">
                <a href="dataperawatan.php">Data Perawatan</a>
            </div>
            <div class="box">
                <a href="datapengganti.php">Data Pengganti</a>
            </div>
            <div class="box">
                <a href="dataperbaikan.php">Data Perbaikan</a>
            </div>
            <!-- Add more admin functionalities here -->
        </div>
    </div>
</body>
</html>
