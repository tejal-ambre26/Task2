<?php
session_start();
include "config.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = trim($_POST["username_email"]);
    $password = trim($_POST["password"]);

    if (empty($username_email) || empty($password)) {
        $message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username_email, $username_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                header("Location: dashboard.php");
                exit;
            } else {
                $message = "Incorrect password!";
            }
        } else {
            $message = "User not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username_email" placeholder="Username or Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Login</button>
    </form>
    <p style="color:red;"><?= $message ?></p>
    <p>Don’t have an account? <a href="signup.php">Signup</a></p>
</div>
</body>
</html>