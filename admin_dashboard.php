<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch admin details if needed
$admin_id = $_SESSION['admin_id'];
$query = "SELECT name FROM admin WHERE admin_id='$admin_id'";
$result = mysqli_query($connection, $query);
$admin = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($admin['name']); ?></h2>
        <ul>
            <li><a href="manage_books.php">Manage Books</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_issued_books.php">Manage Issued Books</a></li>
        </ul>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
