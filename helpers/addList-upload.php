<?php
include_once("../classes/lijst.php");
if(isset($_POST['submit'])){
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
?>ren