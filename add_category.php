<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $query = "INSERT INTO categories (cat_name) VALUES ('$category_name')";

    if (mysqli_query($connection, $query)) {
        $success = "Category added successfully!";
    } else {
        $error = "Failed to add category: " . mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Category</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</body>
</html>
