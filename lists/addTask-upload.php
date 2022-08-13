<?php
include_once("../classes/task.php");
include_once("../classes/Lijst.php");
include_once("../classes/user.php");
$list = Lijst::getById($_GET['id']);

$title = $_GET["title"];
$deadline = $_GET["deadline"];
$hours = $_GET["hours"];


$listId = $list['id'];


session_start();
$user = User::getUserByEmail($_SESSION['email']);

$user_id = $user["id"];

try{
    if(!empty($title)){


    $task = new Task();
    $task->setTitle($title);
    $task->setListId($listId);
    $task->setHours($hours);
    $task->setDeadline($deadline);
    $task->setUserId($user_id);
    $task->save();
    header("Location: index.php?id=$listId");
    }
}
catch(Throwable $error) {
    $error = $error->getMessage();
    echo $error;
}
?>