<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$query = "SELECT * FROM books";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Available Books</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Author ID</th>
                    <th>Category ID</th>
                    <th>Book Number</th>
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
                            <a href="borrow_book.php?book_id=<?php echo $row['book_id']; ?>" class="btn btn-primary btn-sm">Borrow</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
