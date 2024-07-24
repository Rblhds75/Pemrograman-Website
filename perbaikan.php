<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Registrasi Perbaikan Aset</title>
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
            $id_aset = $_POST['id_aset'];
            $tanggal_perbaikan = $_POST['tanggal_perbaikan'];
            $keterangan = $_POST['keterangan'];
            $biaya = $_POST['biaya'];

            // Query untuk menyimpan data perbaikan aset
            $query = "INSERT INTO perbaikan (id_aset, tanggal_perbaikan, keterangan, biaya) 
                      VALUES ('$id_aset', '$tanggal_perbaikan', '$keterangan', '$biaya')";

            if (mysqli_query($con, $query)) {
                echo "<div class='message'>
                        <p>Perbaikan aset berhasil!</p>
                      </div> <br>";
                echo "<a href='home.php'><button class='btn'>Halaman Utama</button></a>";
            } else {
                echo "Error: " . mysqli_error($con);
            }

        } else {

        ?>

        <header>Registrasi Perbaikan Aset</header>
        <form action="" method="post">
            <div class="field input">
                <label for="id_aset">ID Aset</label>
                <select name="id_aset" id="id_aset" required>
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
                <label for="tanggal_perbaikan">Tanggal Perbaikan</label>
                <input type="date" name="tanggal_perbaikan" id="tanggal_perbaikan" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="4" required></textarea>
            </div>

            <div class="field input">
                <label for="biaya">Biaya</label>
                <input type="text" name="biaya" id="biaya" autocomplete="off" required>
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
