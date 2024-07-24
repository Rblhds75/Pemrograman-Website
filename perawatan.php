<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Registrasi Perawatan</title>
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
            $tanggal_perawatan = $_POST['tanggal_perawatan'];
            $keterangan = $_POST['keterangan'];
            $biaya = $_POST['biaya'];

            // Perbaikan sintaks pada query INSERT
            $query = "INSERT INTO perawatan (id_aset, tanggal_perawatan, keterangan, biaya) 
                      VALUES ('$id_aset', '$tanggal_perawatan', '$keterangan', '$biaya')";

            if (mysqli_query($con, $query)) {
                echo "<div class='message'>
                        <p>Submit berhasil!</p>
                      </div> <br>";
                echo "<a href='home.php'><button class='btn'>Halaman Utama</button></a>";
            } else {
                echo "Error: " . mysqli_error($con);
            }

        } else {

        ?>

        <header>Registrasi Perawatan</header>
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
                <label for="tanggal_perawatan">Tanggal Perawatan</label>
                <input type="date" name="tanggal_perawatan" id="tanggal_perawatan" autocomplete="off" required>
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
