<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch books
$query = "SELECT * FROM books";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Books</h2>
        <a href="add_book.php" class="btn btn-success mb-3">Add New Book</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author ID</th>
                    <th>Category ID</th>
                    <th>Number</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['book_id']; ?></td>
                        <td><?php echo $row['book_name']; ?></td>
                        <td><?php echo $row['author_id']; ?></td>
                        <td><?php echo $row['cat_id']; ?></td>
                        <td><?php echo $row['book_number']; ?></td>
                        <td><?php echo $row['book_price']; ?></td>
                        <td>
                            <a href="edit_book.php?id=<?php echo $row['book_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_book.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
