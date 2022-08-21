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
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <title>ToDo - <?php echo ($user['username']);?></title>
    <link rel="stylesheet" href="css/repeat.css">
    <script src="https://kit.fontawesome.com/ba573f667f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once("partials/nav.php")?>
    <a id="uitloggen" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <nav>
        <h1 class="titel">Lists</h1>
    </nav>

    
    <div class="container">
    <?php
    $lists = Lijst::getByUserId($user['id']);
    foreach($lists as $list){
        $listId = $list['id'];

        echo "<div class='list'>";
        echo "<a class='listName' href='lists/?id=$listId'>";
        echo "<h1>".$list['title']."</h1>";
        echo "<h2>".$list['description']."</h2>";
        echo "</a>";
        echo "</div>";
    }
    ?>
    </div>

    
    <form action="lists/addList.php" method="POST">
        <div class="buttonCenter">
            
            <button class="btn" name="newList" type="submit">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <span>NEW LIST</span>
            </button>
        </div>  
    </form>  


</body>
</html>