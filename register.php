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
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <title>Register - ToDo</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/error.css">
</head>
<body>
    <?php if(isset($error)): ?>
        <div class="errorMessage"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="inputContainer">
        <h1>TODO</h1>
        <form method="post" action=>
            <h2>Register</h1>
            <div class="velden">
                <input name="email" type="email" placeholder="Email">
                <input name="username" type="username" placeholder="Username">
                <input name="password" type="password" placeholder="Password">
                <div class="buttonContainer">
                    <div class="center">
                        <button class="btn" name="register" type="submit" value="Register">
                            <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                            <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                            <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                            </svg>
                            <span id="registerBtn">SIGN UP</span>
                        </button>
                    </div>
                </div>
            </div>
            <h3>Already an account?</h3>
            <a href="login.php">LOGIN</a>
        </form>
    </div>
    
</body>
</html>