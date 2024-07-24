<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Registrasi Aset</title>
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
        if(isset($_POST['submit'])){
            $nama_aset = $_POST['nama_aset'];
            $kategori = $_POST['kategori'];
            $tanggal_pembelian = $_POST['tanggal_pembelian'];
            $harga = $_POST['harga'];
            $status = $_POST['status'];

            // Verifikasi keunikan nama aset
            $verify_query = mysqli_query($con, "SELECT nama_aset FROM aset WHERE nama_aset='$nama_aset'");

            if(mysqli_num_rows($verify_query) != 0){
                echo "<div class='message'>
                        <p>Nama aset ini sudah digunakan, coba yang lain!</p>
                    </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button></a>";
            }
            else{
                // Perbaikan sintaks pada query INSERT
                $query = "INSERT INTO aset (nama_aset, kategori, tanggal_pembelian, harga, status) 
                        VALUES ('$nama_aset', '$kategori', '$tanggal_pembelian', '$harga', '$status')";

                if(mysqli_query($con, $query)){
                    echo "<div class='message'>
                            <p>Submit berhasil!</p>
                          </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Halaman Utama</button></a>";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }

        } else {

        ?>

        <header>Registrasi Aset</header>
        <form action="" method="post">
            <div class="field input">
                <label for="nama_aset">Nama Aset</label>
                <input type="text" name="nama_aset" id="nama_aset" autocomplete="off" required>
            </div>
            <div class="field input">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="tanggal_pembelian">Tanggal Pembelian</label>
                <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" autocomplete="off" required>
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
