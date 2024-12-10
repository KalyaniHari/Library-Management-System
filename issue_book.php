<?php
session_start();
require('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = mysqli_real_escape_string($connection, $_POST['book_id']);
    $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
    $issue_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime('+7 days')); // Default return date: 7 days

    $query = "INSERT INTO issued_books (book_id, user_id, issue_date, return_date, status) 
              VALUES ('$book_id', '$user_id', '$issue_date', '$return_date', 'Issued')";

    if (mysqli_query($connection, $query)) {
        $success = "Book issued successfully!";
    } else {
        $error = "Failed to issue book: " . mysqli_error($connection);
    }
}

// Fetch available books and users for dropdowns
$books_query = "SELECT * FROM books";
$books_result = mysqli_query($connection, $books_query);

$users_query = "SELECT * FROM users";
$users_result = mysqli_query($connection, $users_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Issue Book</h2>
        <?php if (isset($success)) echo "<p class='text-success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" class="mt-3">
            <div class="form-group">
                <label>Book</label>
                <select name="book_id" class="form-control" required>
                    <option value="">Select a Book</option>
                    <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                        <option value="<?php echo $book['book_id']; ?>"><?php echo $book['book_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>User</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select a User</option>
                    <?php while ($user = mysqli_fetch_assoc($users_result)) { ?>
                        <option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Issue Book</button>
        </form>
    </div>
</body>
</html>
