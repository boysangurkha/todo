<?php
include_once("../classes/User.php");
include_once("../classes/Comment.php");
include_once("../classes/Lijst.php");
include_once("../classes/Task.php");
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

$comments = Comment::getCommentsByTaskId($taskId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../helpers/fonts.php")?>
    <link rel="stylesheet" href="../css/list.css">
    <link rel="stylesheet" href="../css/arrow.css">
    <link rel="stylesheet" href="../css/task.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ba573f667f.js" crossorigin="anonymous"></script>
    <title>Tasks - ToDo</title>
</head>
<body>
    <?php include_once("../partials/nav.php")?>
    <a class="arrowBack" href="../index.php"><i class="material-icons">&#xe5cb;</i></a>
    <div class="listBalk">

            <?php
            echo "<nav><h1 class='titel listBalk'>"."Task: ".$task['title'];?>

            <?php
            echo "<a href='../helpers/deleteTask.php/?id=$taskId'><i class='fa fa-trash' aria-hidden='true'></i></a></h1></nav>";
            ?>

    </div>

    <?php
    $datestr = $task['deadline'];
    $date=strtotime($datestr);
    $diff=$date-time();
    $days=floor($diff/(60*60*24));
    if($days < 0){
        $daysVolledig = "<span class='overdue'>"."Deadline overdue!"."</span>";
    }
    else{
        $daysVolledig = "<span class='notOverdue'>"."$days day(s) left"."</span>";
    }
    echo "<div class='taskDiv'>"."<h2 class='taskTekst'>"."Due date: ".$task['deadline']." "."| $daysVolledig"."</h2></div>";
    echo "<h2 class='taskTekst'>"."Estimate hours: ".$task['hours']."</h2>"."</div>";
    ?>

    <div>
        <div class="commentContainer">
            <input type="text" id="commentText" placeholder="Leave a comment">
            <a href="#" id="btnAddComment" data-taskid="<?php echo $taskId?>"><div class="centerIcon"><i class="material-icons">&#xe0b9;</i></div></a>
        </div>

        <ul id="list">
            <?php
            $lenght = count($comments);

            for ($i=0; $i < $lenght; $i++) { 
                echo "<li>".$comments[$i]["comment"]."</li>";
            }
            ?>
        </ul>
        <div class="buttonCenter">

        <?php
            if ($task['uploads']) {
                echo "<a href='../uploads/".$task['uploads']."' target='_blank' >Open file: ". $task['uploads']."</a>";
                echo "<br><a href='deleteFile.php?id=".$task['id']."' > Delete file: ". $task['uploads']."</a>";
            }
            else{   ?></div>
                <div class="buttonCenter" id="destination">
                <form action="fileUploadScript.php?id=<?php echo $_GET["id"] ?>" method="post" enctype="multipart/form-data">
                    <h2 id="upl">Upload a File:</h2>
                    <input type="file" name="the_file" id="fileToUpload">
                    <input type="submit" name="submit" value="Upload" id="uploadFile">
                    
        <?php } ?>
     

                </form>
                </div>
    </div>

    

    <script src="../js/comment.js"></script>
</body>
</html>