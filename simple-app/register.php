<?php
require 'config.php';

$isTaken = false;
$message = ''; // Initialize a message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $userCount = $stmt->fetchColumn();

    if ($userCount > 0) {
        // Set the error message to red
        $message = '<p class="error-message">Username already taken!</p>';
        $isTaken = true;
    }
    if (!$isTaken) {
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        if ($stmt->execute([$username, $password])) {
            $message = '<p class="success-message">User registered successfully.</p>';
        } else {
            $message = '<p class="error-message">Failed to register!</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <form method="post" action="register.php">
        <h1>Register:</h1>

        <!-- Display the success or error message here -->
        <?php echo $message; ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="4-10 characters" minlength="4" maxlength="10" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" minlength="4" maxlength="10" placeholder="4-10 characters" required>
        <br>
        <div class="buttons">
            <button type="submit">Register</button>
            <button type="button" onclick="window.location.href='login.php'">Login</button>
        </div>
    </form>
</body>

</html>
