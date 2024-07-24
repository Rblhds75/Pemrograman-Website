<?php
session_start();
include("php/config.php");

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit;
}

// Menentukan apakah pengguna yang login adalah admin
$is_admin = isset($_SESSION['peran']) && $_SESSION['peran'] === 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <?php 
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Idpengguna=$id");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['namapengguna'];
                $res_Email = $result['email'];
                $res_katasandi = $result['katasandi'];
                $res_id = $result['Idpengguna'];
            }
            ?>

            <p><a href="home.php">Website Fasilitas</a></p>
            <p>Hello, <?php echo htmlspecialchars($res_Uname); ?></p>
        </div>

        <div class="right-links">
            <?php if ($is_admin) { ?>
                <a href="admin.php"><button class="btn">Admin Dashboard</button></a>
            <?php } ?>
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <div class="main-box">
        <div class="left">
            <div class="box">
                <a href="regiskaryawan.php">Registrasi Karyawan</a>
            </div>
            <div class="box">
                <a href="aset.php">Aset</a>
            </div>
            <div class="box">
                <a href="perawatan.php">Perawatan</a>
            </div>
            <div class="box">
                <a href="penggantian.php">penggantian</a>
            </div>
            <div class="box">
                <a href="perbaikan.php">Perbaikan</a>
            </div>
        </div>

        <div class="bottom">
            <div class="box">
                <p>Selamat datang di Dashboard UwU Jurnal! Di sini, Anda akan menemukan semua alat yang Anda butuhkan untuk mencatat perjalanan hidup dan refleksi pribadi Anda. Website kami dirancang dengan antarmuka yang ramah pengguna, memungkinkan Anda untuk dengan mudah menambahkan, mengedit, dan mengorganisir entri jurnal Anda. Fitur unggulan kami meliputi analisis sentimen untuk memahami suasana hati Anda.</p>
            </div>
        </div>
    </div>
</body>
</html>
