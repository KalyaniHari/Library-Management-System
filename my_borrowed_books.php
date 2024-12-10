<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT books.book_name, issued_books.issue_date, issued_books.return_date, issued_books.status 
          FROM issued_books 
          JOIN books ON issued_books.book_id = books.book_id 
          WHERE issued_books.user_id = '$user_id'";

$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Borrowed Books</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>My Borrowed Books</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['book_name']; ?></td>
                        <td><?php echo $row['issue_date']; ?></td>
                        <td><?php echo $row['return_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
