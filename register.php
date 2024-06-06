<?php
require_once("dbConnection.php");

// Define variables and initialize with empty values
$name = $email = $password = $gender = $city = $photo = "";
$name_err = $email_err = $password_err = $gender_err = $city_err = $photo_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $gender_err = "Please select your gender.";
    } else {
        $gender = $_POST["gender"];
    }

    // Validate city
    if (empty($_POST["city"])) {
        $city_err = "Please select your city.";
    } else {
        $city = $_POST["city"];
    }

    // Validate photo
    if (empty($_FILES["photo"]["name"])) {
        $photo_err = "Please select a photo.";
    } else {
        $photo = $_FILES["photo"]["name"];
    }

    // If no validation errors, proceed with form processing
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($gender_err) && empty($city_err) && empty($photo_err)) {
        // Prepare the SQL statement
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, gender, city, photo) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssss", $name, $email, $password, $gender, $city, $photo);

        // Execute the prepared statement
        if ($stmt->execute()) {
            header("Location: login.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        <span class="error"><?php echo $name_err; ?></span><br>
        Email: <input type="email" name="email" required><br>
        <span class="error"><?php echo $email_err; ?></span><br>
        Password: <input type="password" name="password" required><br>
        <span class="error"><?php echo $password_err; ?></span><br>
        Gender: 
        <input type="radio" name="gender" value="male" required> Male
        <input type="radio" name="gender" value="female" required> Female<br>
        <span class="error"><?php echo $gender_err; ?></span><br>
        City: 
        <select name="city" required>
            <option value="" selected disabled>Select City</option>
            <option value="New York">New York</option>
            <option value="Los Angeles">Los Angeles</option>
            <option value="Chicago">Chicago</option>
        </select><br>
        <span class="error"><?php echo $city_err; ?></span><br>
        Photo: <input type="file" name="photo" required><br>
        <span class="error"><?php echo $photo_err; ?></span><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
