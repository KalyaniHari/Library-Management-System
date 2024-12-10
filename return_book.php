<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Issue ID is required.");
}

$issue_id = $_GET['id'];
$query = "UPDATE issued_books SET status='Returned' WHERE issue_id='$issue_id'";

if (mysqli_query($connection, $query)) {
    header("Location: view_issued_books.php?message=Book marked as returned.");
    exit();
} else {
    die("Failed to update status: " . mysqli_error($connection));
}
?>
