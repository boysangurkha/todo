<?php
include_once("../classes/user.php");
include_once("../classes/Lijst.php");
include_once("../classes/task.php");
include_once("../helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    if(!empty($_POST)){
    }
}
else{
    header("Location: ../login.php");
}

$user = User::getUserByEmail($_SESSION['email']);


$task = Task::getById($_GET['id']);
$taskId = $task['id'];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<h1>".$task['title']."</h1>";
    echo "<h2>".$task['deadline']."</h2>";
    echo "<h2>".$task['hours']." "."hour(s)"."</h2>";
    echo "<a href='../helpers/deleteTask.php/?id=$taskId'>DELETE TASK</a><br><br>";
    ?>


</body>
</html>