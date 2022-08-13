<?php
include_once("../helpers/Security.php");
include_once("../classes/user.php");
include_once("../classes/Lijst.php");
if(Security::onlyLoggedInUsers()){
    if(!empty($_POST)){
    }
}
else{
    header("Location: login.php");
}

if(!empty($_POST)){
    $id = $_GET['id'];
    $title = $_POST['taskTitle'];
    $deadline = $_POST['deadline'];
    $hours = $_POST['hours'];
    header("Location: addTask-upload.php?id=$id&title=$title&deadline=$deadline&hours=$hours");
}

$user = User::getUserByEmail($_SESSION['email']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new List - <?php echo ($user['username']);?></title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data"> 
        <h1>New Task</h1>
        <input type="text" name="taskTitle" placeholder="Task title">
        <input type="date" name="deadline" placeholder="Deadline">
        <input type="number" name="hours" placeholder="Estimate hours">

        <button class="btn" name="submit" type="submit" value="addTask">
            <span>ADD TASK</span>
        </button>
    </form>
</body>
</html>