<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
    $author_id = mysqli_real_escape_string($connection, $_POST['author_id']);
    $cat_id = mysqli_real_escape_string($connection, $_POST['cat_id']);
    $book_number = mysqli_real_escape_string($connection, $_POST['book_number']);
    $book_price = mysqli_real_escape_string($connection, $_POST['book_price']);

    $query = "INSERT INTO books (book_name, author_id, cat_id, book_number, book_price) VALUES 
              ('$book_name', '$author_id', '$cat_id', '$book_number', '$book_price')";
    if (mysqli_query($connection, $query)) {
        $success = "Book added successfully!";
    } else {
        $error = "Failed to add book: " . mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Book</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Book Name</label>
                <input type="text" name="book_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Author ID</label>
                <input type="number" name="author_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Category ID</label>
                <input type="number" name="cat_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Book Number</label>
                <input type="text" name="book_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Book Price</label>
                <input type="number" step="0.01" name="book_price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
</body>
</html>
