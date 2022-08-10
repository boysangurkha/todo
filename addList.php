<?php
include_once(__DIR__ . "/helpers/bootstrap.php");
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    if(!empty($_POST)){
    }
}
else{
    header("Location: login.php");
}

$user = User::getUserByEmail($_SESSION['email']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new List - <?php echo ($user['username']);?></title>
</head>
<body>
    <form action="addList-upload.php">
        
    </form>
</body>
</html>