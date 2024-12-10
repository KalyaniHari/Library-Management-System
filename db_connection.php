<?php
// Database connection details from Clever Cloud
$host = "bvvpfqy5ygklqyov2khf-mysql.services.clever-cloud.com";
$user = "usg5xykjnogo2sdc";
$password = "qZGlkNWHLk66pODF4pw5";
$database = "bvvpfqy5ygklqyov2khf";
$port = 3306;

// Establish a connection to the MySQL database
$connection = mysqli_connect($host, $user, $password, $database, $port);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
