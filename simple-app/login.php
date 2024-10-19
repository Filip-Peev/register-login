<?php
require 'config.php';
session_start();

$errorMessage = ''; // Initialize an empty error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT password FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: welcome.php');
        exit;
    } else {
        // Set the error message if credentials are invalid
        $errorMessage = '<p class="error-message">Invalid credentials.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <form method="post">
        <h1>Login:</h1>

        <!-- Display the error message here -->
        <?php echo $errorMessage; ?>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <div class="buttons">
            <button type="submit">Login</button>
            <button type="button" onclick="window.location.href='register.php'">Register</button>
        </div>
    </form>
</body>
</html>
