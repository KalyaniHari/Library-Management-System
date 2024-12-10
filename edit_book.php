<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Book ID is required.");
}

$book_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
    $author_id = mysqli_real_escape_string($connection, $_POST['author_id']);
    $cat_id = mysqli_real_escape_string($connection, $_POST['cat_id']);
    $book_number = mysqli_real_escape_string($connection, $_POST['book_number']);
    $book_price = mysqli_real_escape_string($connection, $_POST['book_price']);

    $query = "UPDATE books SET 
              book_name='$book_name', 
              author_id='$author_id', 
              cat_id='$cat_id', 
              book_number='$book_number', 
              book_price='$book_price' 
              WHERE book_id='$book_id'";

    if (mysqli_query($connection, $query)) {
        $success = "Book updated successfully!";
    } else {
        $error = "Failed to update book: " . mysqli_error($connection);
    }
}

$query = "SELECT * FROM books WHERE book_id='$book_id'";
$result = mysqli_query($connection, $query);
if (!$result || mysqli_num_rows($result) != 1) {
    die("Book not found.");
}
$book = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Book</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Book Name</label>
                <input type="text" name="book_name" class="form-control" value="<?php echo $book['book_name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Author ID</label>
                <input type="number" name="author_id" class="form-control" value="<?php echo $book['author_id']; ?>" required>
            </div>
            <div class="form-group">
                <label>Category ID</label>
                <input type="number" name="cat_id" class="form-control" value="<?php echo $book['cat_id']; ?>" required>
            </div>
            <div class="form-group">
                <label>Book Number</label>
                <input type="text" name="book_number" class="form-control" value="<?php echo $book['book_number']; ?>" required>
            </div>
            <div class="form-group">
                <label>Book Price</label>
                <input type="number" step="0.01" name="book_price" class="form-control" value="<?php echo $book['book_price']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html>
