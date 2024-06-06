<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once("dbConnection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM users WHERE id=$id");

    if ($result->num_rows > 0) {
        $res = $result->fetch_assoc();
        $name = $res['name'];
        $email = $res['email'];
        $password = $res['password'];
        $gender = $res['gender'];
        $city = $res['city'];
        $photo = $res['photo'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    
    $photo = $_FILES['photo']['name'];
    if ($photo) {
        $target = "uploads/" . basename($photo);
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            echo "Failed to upload image.";
            exit();
        }
    } else {
        $photo = $_POST['current_photo'];
    }

    $mysqli->query("UPDATE users SET name='$name', email='$email', password='$password', gender='$gender', city='$city', photo='$photo' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
    <h2>Edit Data</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $email; ?>" required><br>
        Password: <input type="password" name="password" value="<?php echo $password; ?>" required><br>
        Gender: 
        <input type="radio" name="gender" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?> required> Male
        <input type="radio" name="gender" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?> required> Female<br>
        City: 
        <select name="city" required>
            <option value="New York" <?php echo ($city == 'New York') ? 'selected' : ''; ?>>New York</option>
            <option value="Los Angeles" <?php echo ($city == 'Los Angeles') ? 'selected' : ''; ?>>Los Angeles</option>
            <option value="Chicago" <?php echo ($city == 'Chicago') ? 'selected' : ''; ?>>Chicago</option>
        </select><br>
        Photo: <input type="file" name="photo"><br>
        <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
        <img src="uploads/<?php echo $photo; ?>" width="50"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
