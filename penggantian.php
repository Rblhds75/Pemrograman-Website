<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Registrasi Penggantian Aset</title>
</head>
<body>
<div class="nav">
    <div class="logo">
        <p><a href="home.php"> Website Fasilitas</a></p>
    </div>
    <div class="right-links">
        <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
    </div>
</div>
<div class="container">
    <div class="box form-box">

        <?php
        include("php/config.php");

        if (isset($_POST['submit'])) {
            $id_aset_lama = $_POST['id_aset_lama'];
            $id_aset_baru = $_POST['id_aset_baru'];
            $tanggal_penggantian = $_POST['tanggal_penggantian'];
            $alasan_penggantian = $_POST['alasan_penggantian'];

            // Perbaikan sintaks pada query INSERT
            $query = "INSERT INTO penggantian (id_aset_lama, id_aset_baru, tanggal_penggantian, alasan_penggantian) 
                      VALUES ('$id_aset_lama', '$id_aset_baru', '$tanggal_penggantian', '$alasan_penggantian')";

            if (mysqli_query($con, $query)) {
                echo "<div class='message'>
                        <p>Penggantian aset berhasil!</p>
                      </div> <br>";
                echo "<a href='home.php'><button class='btn'>Halaman Utama</button></a>";
            } else {
                echo "Error: " . mysqli_error($con);
            }

        } else {

        ?>

        <header>Registrasi Penggantian Aset</header>
        <form action="" method="post">
            <div class="field input">
                <label for="id_aset_lama">ID Aset Lama</label>
                <select name="id_aset_lama" id="id_aset_lama" required>
                    <?php
                    // Ambil daftar aset dari database
                    $result = mysqli_query($con, "SELECT id_aset, nama_aset FROM aset");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_aset']}'>{$row['nama_aset']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="field input">
                <label for="id_aset_baru">ID Aset Baru</label>
                <select name="id_aset_baru" id="id_aset_baru" required>
                    <?php
                    // Ambil daftar aset dari database
                    $result = mysqli_query($con, "SELECT id_aset, nama_aset FROM aset");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id_aset']}'>{$row['nama_aset']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="field input">
                <label for="tanggal_penggantian">Tanggal Penggantian</label>
                <input type="date" name="tanggal_penggantian" id="tanggal_penggantian" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="alasan_penggantian">Alasan Penggantian</label>
                <textarea name="alasan_penggantian" id="alasan_penggantian" rows="4" required></textarea>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Submit">
            </div>
            <div class="links">
                <a href="home.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php } ?>
</div>
</body>
</html>
