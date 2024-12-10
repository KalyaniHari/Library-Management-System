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
$query = "DELETE FROM books WHERE book_id='$book_id'";

if (mysqli_query($connection, $query)) {
    header("Location: manage_books.php?message=Book deleted successfully.");
    exit();
} else {
    die("Failed to delete book: " . mysqli_error($connection));
}
?>
