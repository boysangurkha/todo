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
    
    <div class="listBalk">

            <?php
            echo "<nav><h1 class='titel listBalk'>"."List: ".$list['title'];?>

            <?php
            echo "<a href='../helpers/deleteList.php/?id=$listId'><i class='fa fa-trash' aria-hidden='true'></i></a></nav></h1>";
            ?>

    </div>
    
    <div class="container2">
        <div class="flex-container">
            <?php
            $tasks = Task::getByListId($list['id']);
            foreach($tasks as $task){
                if($task['checked'] == 1){ ?>
                    <div class="flex">
                        <input type='checkbox' class="checked" id='check1' onclick="location.href = 'check.php?id=<?php echo $task['id'];?>&check=1';" checked>
                        <a class='taskName' href='../tasks/?id=<?php echo $task['id'];?>'>
                        <?php echo "<h1 style='text-decoration-line: line-through; font-weight: 300; font-style: italic;'>".$task["title"]."</h1>"; ?>
                        </a> 
                    </div>
                <?php } else{ ?>
                    <div class="flex">
                        <input type='checkbox' class="checked" id='check2' onclick="location.href = 'check.php?id=<?php echo $task['id'];?>&check=0';">
                        <a class='taskName' href='../tasks/?id=<?php echo $task['id'];?>'>
                        <?php echo "<h1>".$task["title"]."</h1>";?>
                        </a>
                    </div>
                <?php } ?>
                <div class="flex2">
                    <h2><?php 
                    $datestr = $task['deadline'];
                    $date=strtotime($datestr);
                    $diff=$date-time();
                    $days=floor($diff/(60*60*24));
                    echo "$days day(s) remaining";

                    ?></h2>
                </div>
            <?php } ?>
        </div>
    </div>

    

    <form method="POST">
        <div class="buttonCenter">
            <button class="btn" name="newTask" type="submit">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span>NEW TASK</span>
            </button>
        </div>
    </form>  

    

</body>
</html>