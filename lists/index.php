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
    <link rel="stylesheet" href="../css/list.css">
    <link rel="stylesheet" href="../css/arrow.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ba573f667f.js" crossorigin="anonymous"></script>
    <title>Lists - ToDo</title>
</head>
<body>
    <?php include_once("../partials/nav.php")?>
    <a class="arrowBack" href="../index.php"><i class="material-icons">&#xe5cb;</i></a>
    <div class="listBalk">

            <?php
            echo "<nav><h1 class='titel listBalk'>"."List: ".$list['title'];?>

            <?php
            echo "<a href='../helpers/deleteList.php/?id=$listId'><i class='fa fa-trash' aria-hidden='true'></i></a></h1></nav>";
            ?>

    </div>
    
        <div class="container">
            <?php
            $tasks = Task::getByListId($list['id']);
            foreach($tasks as $task){
                if($task['checked'] == 1){ ?>
                    <div class="taskContainer">
                        <div class="gegevens">
                            <input type='checkbox' class="checked" id='check1' onclick="location.href = 'check.php?id=<?php echo $task['id'];?>&check=1';" checked>
                            <label class="strikethrough"><a class='taskName' href='../tasks/?id=<?php echo $task['id'];?>'>
                            <?php echo "<h1>".$task["title"]."</h1>"; ?>
                            </a>
                            </label>
                        </div>
                        <div class="time">
                            <h2><?php 
                            $datestr = $task['deadline'];
                            $date=strtotime($datestr);
                            $diff=$date-time();
                            $days=floor($diff/(60*60*24));
                            if($days < 0){
                                $daysVolledig = "<span class='overdue'>"."Deadline overdue!"."</span>";
                                echo $daysVolledig;
                            }
                            else{
                                $daysVolledig = "$days day(s) left";
                                echo $daysVolledig;
                            }
                            ?></h2> 
                        </div>
                    </div>    
                <?php } else{ ?>
                    <div class="taskContainer">
                        <div class="gegevens">
                            <input type='checkbox' class="checked" id='check2' onclick="location.href = 'check.php?id=<?php echo $task['id'];?>&check=0';">
                            <label class="strikethrough"><a class='taskName' href='../tasks/?id=<?php echo $task['id'];?>'>
                            <?php echo "<h1>".$task["title"]."</h1>";?>
                            </a>
                            </label>
                        </div>
                        <div class="time">
                            <h2><?php 
                            $datestr = $task['deadline'];
                            $date=strtotime($datestr);
                            $diff=$date-time();
                            $days=floor($diff/(60*60*24));
                            if($days < 0){
                                $daysVolledig = "<span class='overdue'>"."Deadline overdue!"."</span>";
                                echo $daysVolledig;
                            }
                            else{
                                $daysVolledig = "$days day(s) left";
                                echo $daysVolledig;
                            }
                            ?></h2>
                        </div>
                    </div>   
                <?php } ?>
                    
            <?php } ?>
        </div>

    

    <form method="POST">
        <div class="buttonCenter" id="destination">
            <button class="btn" name="newTask" type="submit">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span>NEW TASK</span>
            </button>
        </div>
    </form>  

    
<script src="../js/list.js"></script>
</body>
</html>