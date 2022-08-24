<?php
include_once("../helpers/Security.php");
include_once("../classes/User.php");
include_once("../classes/Lijst.php");
include_once("../classes/Task.php");
if(Security::onlyLoggedInUsers()){
    if(!empty($_POST)){
    }
}
else{
    header("Location: login.php");
}

$id = $_GET['id'];

if(!empty($_POST)){
    $title = $_POST['taskTitle'];
    $deadline = $_POST['deadline'];
    $hours = $_POST['hours'];
    if (Task::checkTaskName($title)) {
        echo "<div class='errorMessage'>Task name is already taken</div>";
    }
    else{
        header("Location: addTask-upload.php?id=$id&title=$title&deadline=$deadline&hours=$hours");
    }
}

$user = User::getUserByEmail($_SESSION['email']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/error.css">
    <link rel="stylesheet" href="../css/add.css">
    <link rel="stylesheet" href="../css/repeat.css">
    <link rel="stylesheet" href="../css/arrow.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php include_once("../helpers/fonts.php")?>
    <script src="https://kit.fontawesome.com/ba573f667f.js" crossorigin="anonymous"></script>
    <title> Add Task - ToDo</title>
</head>
<body>
<?php if(isset($error)): ?>
        <div class="errorMessage"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php include_once("../partials/nav.php")?>
    <a class="arrowBack" href="/todo/lists/?id=<?php echo $id?>"><i class="material-icons">&#xe5cb;</i></a>
    <nav>
        <h1 class="titel">New Task</h1>
    </nav>
    <div class="inputContainer">
        <form method="POST" enctype="multipart/form-data"> 
            <div class="velden">
                <input type="text" name="taskTitle" placeholder="Task title">
                <input type="date" name="deadline" placeholder="Deadline">
                <input type="number" name="hours" placeholder="Estimate hours">
            </div>
            
            <div class="buttonCenter">
                <button class="btn" name="newList" type="submit">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <span>ADD TASK</span>
                </button>
            </div>  
        </form>
    </div>      
    
</body>
</html>