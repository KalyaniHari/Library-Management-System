<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_name = mysqli_real_escape_string($connection, $_POST['author_name']);
    $query = "INSERT INTO authors (author_name) VALUES ('$author_name')";

    if (mysqli_query($connection, $query)) {
        $success = "Author added successfully!";
    } else {
        $error = "Failed to add author: " . mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Author</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Author</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Author Name</label>
                <input type="text" name="author_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Author</button>
        </form>
    </div>
</body>
</html>
