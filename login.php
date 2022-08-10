<?php
// include_once("bootstrap.php");
    if(!empty($_POST)){
        try{
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        include_once(__DIR__ . "/classes/User.php");
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        
        if($user->canLogin()){
            session_start();
            $_SESSION['email'] = user::getEmailByUsername($username)['email'];
            header("Location: index.php");
        }

        }
        //catch
        catch(Exception $e){
            $error = $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ToDo</title>
</head>
<body>
    <form method="post" action=>
        <h1>Login</h1>
        <input name="username" type="username" placeholder="Username">
        <input name="password" type="password" placeholder="Password">
        <button class="btn" name="login" type="submit" value="Login">
            <span>LOGIN</span>
        </button>
    </form>
</body>
</html>