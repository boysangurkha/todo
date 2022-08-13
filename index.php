<?php
include_once(__DIR__ . "/helpers/bootstrap.php");
include_once(__DIR__ . "/helpers/Security.php");
include_once("./classes/Lijst.php");
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
    <title>ToDo - <?php echo ($user['username']);?></title>
</head>
<body>

    <div class="container">
    <?php
    $lists = Lijst::getByUserId($user['id']);
    foreach($lists as $list){
        $listId = $list['id'];

        echo "<div class='list'>";
        echo "<a class='listName' href='lists/?id=$listId'>";
        echo "<h1>".$list['title']."</h1>";
        echo "</a>";
        //echo "<h2>".$list['description']."</h2>";
        echo "</div>";
    }
    ?>
    </div>

    <form action="lists/addList.php" method="POST">
        <button class="btn" name="newList" type="submit">
            <span>NEW LIST</span>
        </button>
    </form>  

    <a href="logout.php">Logout</a>
</body>
</html>