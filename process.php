<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$username = '';
$password = '';

//      Check if save button is press
if (isset($_POST['save'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];

    $mysqli->query("INSERT INTO data (username, password) VALUES ('$name', '$password')") or
        die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or
        die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die(mysqli_error($mysqli));
    if (true) {
        $row = $result->fetch_array();
        $username = $row['username'];
        $password = $row['password'];
        $update = true;
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $mysqli->query("UPDATE data SET username='$username', password='$password' WHERE id='$id' ") or die($mysqli->error);

    $_SESSION['message'] = 'Record hs been updated';
    $_SESSION['msg_type'] = 'success';

    header('location: index.php');
}