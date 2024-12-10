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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    $query = "UPDATE categories SET cat_name='$category_name' WHERE cat_id='$cat_id'";

    if (mysqli_query($connection, $query)) {
        $success = "Category updated successfully!";
    } else {
        $error = "Failed to update category: " . mysqli_error($connection);
    }
}

$query = "SELECT * FROM categories WHERE cat_id='$cat_id'";
$result = mysqli_query($connection, $query);
if (!$result || mysqli_num_rows($result) != 1) {
    die("Category not found.");
}
$category = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Category</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" value="<?php echo $category['cat_name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
</body>
</html>
