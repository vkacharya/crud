<?php
// Include the database connection file
require_once("dbConnection.php");

// Fetch data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add.php">Add New Data</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Homepage</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$res['name']."</td>";
                    echo "<td>".$res['age']."</td>";
                    echo "<td>".$res['email']."</td>";    
                    echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | 
                    <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
