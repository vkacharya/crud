<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once("dbConnection.php");

$result = $mysqli->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <h1 class="logo"><a href="index.php">Your Logo</a></h1>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="add.php">Add New Data</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <h2>Homepage</h2>
        <table border="1" align="center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>City</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$res['name']."</td>";
                    echo "<td>".$res['email']."</td>";
                    echo "<td>".$res['gender']."</td>";
                    echo "<td>".$res['city']."</td>";    
                    echo "<td><img src='uploads/".$res['photo']."' width='50'></td>";
                    echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | 
                    <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Your Company. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
