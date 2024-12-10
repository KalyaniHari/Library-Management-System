<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

if (!isset($_GET['book_id'])) {
    die("Book ID is required.");
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id'];
$issue_date = date('Y-m-d');
$return_date = date('Y-m-d', strtotime('+7 days'));

$query = "INSERT INTO issued_books (book_id, user_id, issue_date, return_date, status) 
          VALUES ('$book_id', '$user_id', '$issue_date', '$return_date', 'Issued')";

if (mysqli_query($connection, $query)) {
    header("Location: my_borrowed_books.php?message=Book borrowed successfully.");
    exit();
} else {
    die("Failed to borrow book: " . mysqli_error($connection));
}
?>
