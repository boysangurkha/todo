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
            echo $error;
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <title>Login - ToDo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/error.css">
</head>
<body>
    <?php if(isset($error)): ?>
        <div class="errorMessage"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="container">
        <h1>TODO</h1>
        <form method="post" action=>
            <h2>Login</h2>
            <div class="velden">
                <input name="username" type="username" placeholder="Username">
                <input name="password" type="password" placeholder="Password">
                <div class="buttonContainer">
                    <div class="center">
                        <button class="btn" name="login" type="submit" value="Login">
                            <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                            <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                            <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                            </svg>
                            <span id="registerBtn">LOGIN</span>
                        </button>
                    </div>
                </div>
            </div>
            <h3>Not registered?</h3>
            <a href="register.php">REGISTER</a>
        </form>
    </div>
</body>
</html>