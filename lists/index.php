<?php
include_once("../classes/user.php");
include_once("../classes/Lijst.php");

$list = Lijst::getById($_GET['id']);
$user = User::getUserById($list['user_id']);
$listId = $list['id'];

echo "<h1>".$list['title']."</h1>";
echo "<span class='desc'>".$list['description']."</span>";
echo "<a href='../helpers/deleteList.php/?id=$listId'>DELETE LIST</a><br><br>";



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>