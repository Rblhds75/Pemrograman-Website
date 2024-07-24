<?php
session_start();
include("php/config.php");

// Check if the user is logged in and is an admin
if(!isset($_SESSION['valid']) || $_SESSION['peran'] !== 'Admin') {
    header("Location: index.php");
    exit;
}

if(isset($_POST['submit'])){
    $namapengguna = $_POST['namapengguna'];
    $email = $_POST['email'];
    $katasandi = password_hash($_POST['katasandi'], PASSWORD_BCRYPT); // Enkripsi kata sandi
    $peran = $_POST['peran'];

    // Verifikasi keunikan email
    $verify_query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($con, $verify_query);

    if($result === false) {
        echo "Error: " . mysqli_error($con);
    } else {
        if(mysqli_num_rows($result) != 0) {
            echo "<div class='message'>
                    <p>This email is already in use, try another one.</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } else {
            $insert_query = "INSERT INTO users (namapengguna, email, katasandi, peran) VALUES ('$namapengguna', '$email', '$katasandi', '$peran')";
            
            if (mysqli_query($con, $insert_query)) {
                echo "<div class='message'>
                        <p>User created successfully!</p>
                      </div> <br>";
                echo "<a href='admin.php'><button class='btn'>Back to Dashboard</button></a>";
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
            }
        }
    }
}
?>
