<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT name FROM users WHERE user_id='$user_id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
        <ul>
            <li><a href="view_books.php">Browse Books</a></li>
            <li><a href="my_borrowed_books.php">My Borrowed Books</a></li>
            <li><a href="user_profile.php">My Profile</a></li>
            <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
        </ul>
    </div>
</body>
</html>
