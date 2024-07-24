<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Registrasi Karyawan</title>
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
            $Idkaryawan = $_POST['Idkaryawan'];
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $alamat = $_POST['alamat'];
            $notelepon = $_POST['notelepon'];
            $jeniskel = $_POST['jeniskel'];

            // Verifikasi keunikan email
            $verify_query = mysqli_query($con, "SELECT Idkaryawan FROM karyawan WHERE Idkaryawan='$Idkaryawan'");

            if(mysqli_num_rows($verify_query) != 0){
                echo "<div class='message'>
                        <p>ID Karyawan ini sudah digunakan, coba yang lain!</p>
                    </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button></a>";
            }
            else{
                // Perbaikan sintaks pada query INSERT
                $query = "INSERT INTO karyawan (Idkaryawan, nama, jabatan, alamat, notelepon, jeniskel) 
                        VALUES ('$Idkaryawan', '$nama', '$jabatan', '$alamat', '$notelepon', '$jeniskel')";

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

        <header>Registrasi Karyawan</header>
        <form action="" method="post">
            <div class="field input">
                <label for="Idkaryawan">ID Karyawan</label>
                <input type="number" name="Idkaryawan" id="Idkaryawan" autocomplete="off" required>
            </div>
            <div class="field input">
                <label for="nama">Nama Karyawan</label>
                <input type="text" name="nama" id="nama" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="notelepon">No. Telepon</label>
                <input type="text" name="notelepon" id="notelepon" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="jeniskel">Jenis Kelamin</label>
                <select name="jeniskel" required>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
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
