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
    <title>Document</title>
</head>
<body>
    <?php
    $datestr = $task['deadline'];
    $date=strtotime($datestr);
    $diff=$date-time();
    $days=floor($diff/(60*60*24));

    echo "<h1>".$task['title']."</h1>";
    echo "<h2>".$task['deadline']." "."($days days remaining)"."</h2>";
    echo "<h2>"."Estimate hours:".$task['hours']."</h2>";
    ?>

    <div>
        <div>
            <input type="text" id="commentText" placeholder="Type a comment">
            <a href="#" id="btnAddComment" data-taskid="<?php echo $taskId?>">Add comment</a>
        </div>

        <ul id="list">
        <?php
        $lenght = count($comments);

        for ($i=0; $i < $lenght; $i++) { 
            echo "<li>".$comments[$i]["comment"]."</li>";
        }
        ?>
        </ul>
    </div>

    
    <form action="file-upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="images[]" value='' multiple>
        <button class="btn" name="uploadFile" type="submit">
            <span>UPLOAD FILES</span>
        </button>
    </form>  

    <?php
    echo "<a href='../helpers/deleteTask.php/?id=$taskId'>DELETE TASK</a><br><br>";
    ?>

    <script src="../js/comment.js"></script>
</body>
</html>