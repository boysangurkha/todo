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

if(!empty($_POST)){
    $id = $_GET['id'];
    header("Location: addTask.php?id=$id");
}

$user = User::getUserByEmail($_SESSION['email']);

$list = Lijst::getById($_GET['id']);
$listId = $list['id'];

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
    echo "<h1>".$list['title']."</h1>";
    echo "<h2 class='desc'>".$list['description']."</h2>";
    ?>

    <div class="container">
        <?php
        $tasks = Task::getByListId($list['id']);
        foreach($tasks as $task){

            $taskId = $task['id'];
            echo "<a class='taskName' href='../tasks/?id=$taskId'>";
            echo "<h1>".$task['title']."</h1>";
            echo "</a>";

        }
        ?>
    </div>

    <form method="POST">
        <button class="btn" name="newTask" type="submit">
            <span>NEW TASK</span>
        </button>
    </form>  

    <?php
    echo "<a href='../helpers/deleteList.php/?id=$listId'>DELETE LIST</a><br><br>";
    ?>


</body>
</html>