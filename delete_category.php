<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Category ID is required.");
}

$cat_id = $_GET['id'];
$query = "DELETE FROM categories WHERE cat_id='$cat_id'";

if (mysqli_query($connection, $query)) {
    header("Location: manage_categories.php?message=Category deleted successfully.");
    exit();
} else {
    die("Failed to delete category: " . mysqli_error($connection));
}
?>
