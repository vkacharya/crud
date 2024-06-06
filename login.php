<?php
session_start();
require_once("dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: index.php");
    } else {
        echo "Invalid email or password.";
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
    <h2>Login</h2>
    <form method="post">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
