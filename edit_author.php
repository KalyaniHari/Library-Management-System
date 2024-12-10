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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_name = mysqli_real_escape_string($connection, $_POST['author_name']);
    $query = "UPDATE authors SET author_name='$author_name' WHERE author_id='$author_id'";

    if (mysqli_query($connection, $query)) {
        $success = "Author updated successfully!";
    } else {
        $error = "Failed to update author: " . mysqli_error($connection);
    }
}

$query = "SELECT * FROM authors WHERE author_id='$author_id'";
$result = mysqli_query($connection, $query);
if (!$result || mysqli_num_rows($result) != 1) {
    die("Author not found.");
}
$author = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Author</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Author Name</label>
                <input type="text" name="author_name" class="form-control" value="<?php echo $author['author_name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Author</button>
        </form>
    </div>
</body>
</html>
