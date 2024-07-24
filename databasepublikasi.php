<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="penelitian.css">
    <title>Input Jurnal</title>
</head>
<body>
<div class="nav">
    <div class="logo">
        <p><a href="home.php"> UwU Jurnal</a></p>
    </div>
    <div class="right-links">
        <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
    </div>
</div>
<div class="datapeneliti">
    <h3> Data Publikasi </h3>

    <!-- Form Pencarian -->
    <form method="GET" action="">
        <select name="search_id">
            <option value="">Pilih Id Publikasi</option>
            <?php
            include 'php/config.php';
            $result = mysqli_query($con, "SELECT DISTINCT Idpublikasi FROM dbpublikasi");
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['Idpublikasi'] . "'>" . $row['Idpublikasi'] . "</option>";
            }
            ?>
        </select>
        <label for="search_tanggal_start">Tanggal Submit Mulai:</label>
        <input type="date" id="search_tanggal_start" name="search_tanggal_start">
        <label for="search_tanggal_end">Tanggal Submit Akhir:</label>
        <input type="date" id="search_tanggal_end" name="search_tanggal_end">
        <select name="search_jenis">
            <option value="">Pilih Jenis Publikasi</option>
            <?php
            $result = mysqli_query($con, "SELECT DISTINCT jenispublikasi FROM dbpublikasi");
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['jenispublikasi'] . "'>" . $row['jenispublikasi'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Cari">
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Id Publikasi</th>
            <th>Tanggal Submit</th>
            <th>Jenis Publikasi</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $No = 1;
        $query = "SELECT * FROM dbpublikasi WHERE 1=1";
        
        // Cek apakah ada pencarian
        if (isset($_GET['search_id']) && !empty($_GET['search_id'])) {
            $search_id = $_GET['search_id'];
            $query .= " AND Idpublikasi = '$search_id'";
        }
        if (isset($_GET['search_tanggal_start']) && !empty($_GET['search_tanggal_start']) && isset($_GET['search_tanggal_end']) && !empty($_GET['search_tanggal_end'])) {
            $search_tanggal_start = $_GET['search_tanggal_start'];
            $search_tanggal_end = $_GET['search_tanggal_end'];
            $query .= " AND tglsubmit BETWEEN '$search_tanggal_start' AND '$search_tanggal_end'";
        }
        if (isset($_GET['search_jenis']) && !empty($_GET['search_jenis'])) {
            $search_jenis = $_GET['search_jenis'];
            $query .= " AND jenispublikasi = '$search_jenis'";
        }

        $ambildata = mysqli_query($con, $query);
        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['Idpublikasi'] . "</td>
                <td>" . $tampil['tglsubmit'] . "</td>
                <td>" . $tampil['jenispublikasi'] . "</td>
                <td><a href='databasepublikasi.php?id=" . $tampil['Idpublikasi'] . "'>Hapus</a></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET['id'])) {
        mysqli_query($con, "DELETE FROM dbpublikasi WHERE Idpublikasi='$_GET[id]'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=databasepublikasi.php'>";
    }
    ?>
</div>
</body>
</html>
