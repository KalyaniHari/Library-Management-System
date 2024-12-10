<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Author ID is required.");
}

$author_id = $_GET['id'];
$query = "DELETE FROM authors WHERE author_id='$author_id'";

if (mysqli_query($connection, $query)) {
    header("Location: manage_authors.php?message=Author deleted successfully.");
    exit();
} else {
    die("Failed to delete author: " . mysqli_error($connection));
}
?>
