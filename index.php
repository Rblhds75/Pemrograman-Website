<?php
session_start();
include("php/config.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query untuk mendapatkan data pengguna berdasarkan email
    $result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'") or die("Select Error");

    // Mengambil data pengguna
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['katasandi'])) {
        // Menyimpan data pengguna ke sesi
        $_SESSION['valid'] = $row['email'];
        $_SESSION['username'] = $row['namapengguna'];
        $_SESSION['id'] = $row['Idpengguna'];
        $_SESSION['peran'] = $row['peran']; // Menyimpan peran pengguna ke sesi

        // Mengarahkan ke halaman dashboard yang sesuai
        if ($_SESSION['peran'] === 'Admin') {
            header("Location: admin.php");
        } else {
            header("Location: home.php");
        }
        exit;
    } else {
        echo "<div class='message'>
                <p>Wrong Username or Password</p>
            </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
