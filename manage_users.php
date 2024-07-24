<?php
session_start();
include("php/config.php");

// Check if the user is logged in and is an admin
if(!isset($_SESSION['valid']) || $_SESSION['peran'] !== 'Admin') {
    header("Location: index.php");
    exit;
}

// Handle user deletion
if(isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])){
    $id = intval($_GET['id']);
    $delete_query = "DELETE FROM users WHERE Idpengguna=$id";
    if(mysqli_query($con, $delete_query)){
        echo "<div class='message'><p>User deleted successfully!</p></div>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch users
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/manage.css">
    <title>Manage Users</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="admin.php">Admin Dashboard</a></p>
        </div>

        <div class="right-links">
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <div class="main-box">
        <h2>Manage Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Idpengguna']); ?></td>
                        <td><?php echo htmlspecialchars($row['namapengguna']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['peran']); ?></td>
                        <td>
                            <a href="?action=delete&id=<?php echo $row['Idpengguna']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
