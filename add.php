<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once("dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    
    $photo = $_FILES['photo']['name'];
    $target = "uploads/" . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        $mysqli->query("INSERT INTO users (name, email, password, gender, city, photo) VALUES ('$name', '$email', '$password', '$gender', '$city', '$photo')");
        header("Location: index.php");
    } else {
        echo "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Data</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Data</h2>
    <form method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        Gender: 
        <input type="radio" name="gender" value="male" required> Male
        <input type="radio" name="gender" value="female" required> Female<br>
        City: 
        <select name="city" required>
            <option value="New York">New York</option>
            <option value="Los Angeles">Los Angeles</option>
            <option value="Chicago">Chicago</option>
        </select><br>
        Photo: <input type="file" name="photo" required><br>
        <input type="submit" value="Add">
    </form>
</body>
</html>
