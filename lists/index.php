<?php
include_once("../classes/User.php");
include_once("../classes/Lijst.php");
include_once("../classes/task.php");
include_once("../helpers/Security.php");
include_once("../classes/Db.php");
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
    <?php include_once("../helpers/fonts.php")?>
    <link rel="stylesheet" href="../css/repeat.css">
    <script src="https://kit.fontawesome.com/ba573f667f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php include_once("../partials/nav.php")?>
    <a id="uitloggen" href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <?php
    echo "<h1 class='titel'>"."List: ".$list['title']."</h1>";
    ?>
    <hr>

    <div class="">
        <?php
        $tasks = Task::getByListId($list['id']);
        foreach($tasks as $task){
            if($task['checked'] == 1){ ?>
                <a class='taskName' href='../tasks/?id=<?php echo $task['id'];?>'>
                <?php echo "<h1 style='text-decoration: line-through;'>".$task["title"]."</h1>"; ?>
                </a>
                <input type='checkbox' class="checked" id='check1' onclick="location.href = 'check.php?id=<?php echo $task['id'];?>&check=1';" checked>
            <?php } else{ ?>
                <a class='taskName' href='../tasks/?id=<?php echo $task['id'];?>'>
                <?php echo "<h1>".$task["title"]."</h1>";?>
                </a>
                <input type='checkbox' class="checked" id='check2' onclick="location.href = 'check.php?id=<?php echo $task['id'];?>&check=0';">
            <?php } ?>
            <h2><?php 
            $datestr = $task['deadline'];
            $date=strtotime($datestr);
            $diff=$date-time();
            $days=floor($diff/(60*60*24));
            echo "$days days remaining";
            echo "<br>";
            ?></h2>
        <?php } ?>
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