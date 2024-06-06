<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once("dbConnection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT photo FROM users WHERE id=$id");
    if ($result->num_rows > 0) {
        $res = $result->fetch_assoc();
        $photo = $res['photo'];
        if (file_exists("uploads/" . $photo)) {
            unlink("uploads/" . $photo);
        }
    }
    $mysqli->query("DELETE FROM users WHERE id=$id");
    header("Location: index.php");
}
?>
