<?php
$dir = dirname(__DIR__, 1);

include_once("$dir/classes/Db.php");
include_once("$dir/classes/User.php");
include_once("$dir/helpers/Security.php");
include_once("../classes/lijst.php");
if(Security::onlyLoggedInUsers()){
    if(!empty($_POST)){
        try{
            if(!empty($_POST['listTitle'])&&!empty($_POST['listDescription'])){
            include_once("../classes/user.php");
            
            session_start();
            $user = User::getUserByEmail($_SESSION['email']);
    
            $list = new Lijst();
            $list->setTitle($_POST['listTitle']);
            $list->setDescription($_POST['listDescription']);
            $list->setUserId($user['id']);
            $list->setCreatedAt(date('Y-m-d H:i:s'));
            $list->save();
            header("Location:../index.php");
            }
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }
}
else{
    header("Location: ../login.php");
}
//../helpers/addList-upload.php
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
    <?php include_once("../helpers/fonts.php")?>
    <title>Add new List - <?php echo ($user['username']);?></title>
</head>
<body>
    <?php if(isset($error)): ?>
        <div class="errorMessage"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php include_once("../partials/nav.php")?>
    <form action="" method="POST" enctype="multipart/form-data"> 
        <h1>New List</h1>
        <input type="text" name="listTitle" placeholder="List title">
        <input type="text" name="listDescription" placeholder="List description">
        <button class="btn" name="submit" type="submit" value="addList">
            <span>ADD LIST</span>
        </button>
    </form>
</body>
</html>