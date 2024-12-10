<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$query = "SELECT issued_books.issue_id, books.book_name, users.name AS user_name, 
          issued_books.issue_date, issued_books.return_date, issued_books.status 
          FROM issued_books 
          JOIN books ON issued_books.book_id = books.book_id 
          JOIN users ON issued_books.user_id = users.user_id";

$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Issued Books</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Issued Books</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Issue ID</th>
                    <th>Book Name</th>
                    <th>User Name</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['issue_id']; ?></td>
                        <td><?php echo $row['book_name']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['issue_date']; ?></td>
                        <td><?php echo $row['return_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <?php if ($row['status'] == 'Issued') { ?>
                                <a href="return_book.php?id=<?php echo $row['issue_id']; ?>" class="btn btn-success btn-sm">Mark as Returned</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
