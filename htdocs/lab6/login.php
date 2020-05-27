

<?php

include 'class_definitions.php';
session_start();
$errormsg = "";

if(isset($_SESSION["user"])){
    echo 'already logged in, redirecting...';
    header('Location: ' . "index.php", true, $permanent ? 301 : 302);
}else{
    if(isset($_POST) and isset($_POST["login"])){
        //do login stuff
        $user = new User();
        $user->set_name($_POST["login"]);
    
        if($user->load()){
            //set user as session variable
            $_SESSION["user"] = $user;
            header('Location: ' . "index.php", true, $permanent ? 301 : 302);
        }else{
            $errormsg = 'user doen not exist';
        }
    
    }
}




?>
<html>

<head>
    <title>php file system</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="text-center bg-dark text-light">
    <form class="form-signin" action="login.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="login" class="sr-only">login</label>
        <input name="login" type="text" id="login" class="form-control" placeholder="login" required autofocus>
        <button class="btn btn-lg btn-secondary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-danger"> <?php echo $errormsg; ?></p>
        <p class="mt-5 mb-3 text-muted">author: Adam Kowalczyk 215771</p>
    </form>
    
</body>
</html>