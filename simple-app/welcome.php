<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Use the same stylesheet for consistency -->
</head>

<body>
    <div class="main-menu">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <div class="button-logout">
            <button onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>
</body>

</html>