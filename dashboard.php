<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Welcome, <?= $_SESSION["username"]; ?> 🎉</h2>
    <p>You are now logged in.</p>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>