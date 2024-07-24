<?php
session_start();
include("php/config.php");

// Check if the user is logged in and is an admin
if(!isset($_SESSION['valid']) || $_SESSION['peran'] !== 'Admin') {
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
    <title>Data Karyawan</title>
</head>
<body>
<div class="nav">
    <div class="logo">
        <p><a href="admin.php">Admin Dashboard</a></p>
    </div>
    <div class="right-links">
        <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
    </div>
</div>

<div class="datapeneliti">
    <h3> Data Karyawan </h3>
    <!-- Form Pencarian -->
    <form method="GET" action="">
        <input type="text" name="search_nama" placeholder="Cari nama karyawan...">
        <input type="text" name="search_jabatan" placeholder="Cari jabatan...">
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Id Karyawan</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT * FROM karyawan WHERE 1=1";
        
        // Cek apakah ada pencarian
        if (isset($_GET['search_nama']) && !empty($_GET['search_nama'])) {
            $search_nama = $_GET['search_nama'];
            $query .= " AND nama LIKE '%$search_nama%'";
        }
        if (isset($_GET['search_jabatan']) && !empty($_GET['search_jabatan'])) {
            $search_jabatan = $_GET['search_jabatan'];
            $query .= " AND jabatan LIKE '%$search_jabatan%'";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['Idkaryawan'] . "</td>
                <td>" . $tampil['nama'] . "</td>
                <td>" . $tampil['jeniskel'] . "</td>
                <td>" . $tampil['jabatan'] . "</td>
                <td>" . $tampil['alamat'] . "</td>
                <td>" . $tampil['notelepon'] . "</td>
                <td><a href='editkaryawan.php?id=" . $tampil['Idkaryawan'] . "'>Edit</a></td>
                <td><a href='datakaryawan.php?id=" . $tampil['Idkaryawan'] . "'>Hapus</a></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET['id'])) {
        mysqli_query($con, "DELETE FROM karyawan WHERE Idkaryawan='$_GET[id]'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=datakaryawan.php'>";
    }
    ?>
</div>
</body>
</html>
