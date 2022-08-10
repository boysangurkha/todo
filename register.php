<?php 
//hey
    if(!empty($_POST)){
        try {
            include_once(__DIR__ . "/classes/User.php");

            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            $user->setPassword(($_POST['password']));
            $user->register();

            session_start();
            $_SESSION['email'] = $user->getEmail();            
            header("Location: index.php");
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ToDo</title>
</head>
<body>
    <form method="post" action=>
        <h1>Register</h1>
        <input name="email" type="email" placeholder="Email">
        <input name="username" type="username" placeholder="Username">
        <input name="password" type="password" placeholder="Password">
        <button class="btn" name="register" type="submit" value="Register">
            <span>SIGN UP</span>
        </button>
        <h2>Already an account?</h2>
        <a href="login.php">Login</a>
    </form>
</body>
</html>