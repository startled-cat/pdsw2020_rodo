<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMS - login</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/the-big-picture.css" rel="stylesheet">
  
<?php

  include_once('classes.php');
  session_start();

  //print_r($_SESSION);

  if(isset($_SESSION["user"])){
    //echo 'user logged in';
    $user = $_SESSION["user"];
    if($user->is_teacher){
      //echo 'teacher already logged in, redirecting...';
      header('Location: ' . "main_teacher.php", true, $permanent ? 301 : 302);
    }elseif($user->is_student){
      //echo 'student already logged in, redirecting...';
      header('Location: ' . "main_student.php", true, $permanent ? 301 : 302);
    }else{
      //invalid user variable
      header('Location: ' . "logout.php", true, $permanent ? 301 : 302);
    }

  }else{

    
  }

  if( isset($_POST) and isset($_POST["login"]) and isset($_POST["password"]) ){

    //echo " login = ". $_POST["login"];
    //echo " password = ". $_POST["password"];
    $pass = $_POST["password"];
    $login = $_POST["login"];
    //echo " pass = ". $pass;
    $user = new User();
        $user->set_login($login);

    if($_POST["type"] == "teacher"){
      $errormsg = $user->login_as_teacher($pass);
      if($errormsg == ""){
          //set user as session variable
          $user->is_teacher = true;
          $_SESSION["user"] = $user;
          //print_r( $user);
          //echo 'logged in, redirecting...';
          header('Location: ' . "main_teacher.php", true, $permanent ? 301 : 302);
        }else{
          $errormsg = 'user does not exist or wrong password';
          //echo $errormsg;
        }
    
    }elseif($_POST["type"] == "student"){

      $errormsg = $user->login_as_student($pass);
        if($errormsg == ""){
          $user->is_student = true;
          //set user as session variable
          $_SESSION["user"] = $user;
          //echo 'logged in, redirecting...';
          //print_r($_SESSION["user"]);
          header('Location: ' . "main_student.php", true, $permanent ? 301 : 302);
        }else{
            //$errormsg = 'user does not exist or wrong password';
            //echo $errormsg;
        }
    
    
    }
  }

?>
</head>

<body>
  
  <?php 
  if(isset($errormsg)){
    echo '<div class="alert alert-danger">'.$errormsg.'</div>';
  }
  ?>
  

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
    <div class="container">
      <a class="navbar-brand" href="#">Welcome to SMS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!--
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
      -->

    </div>
  </nav>

  <!-- Page Content -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <!--
          <h1 class="mt-5">Student Mark System</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt voluptates rerum eveniet sapiente repellat esse, doloremque quod recusandae deleniti nostrum assumenda vel beatae sed aut modi nesciunt porro quisquam voluptatem.</p>
            -->
        </div>
      </div>
    </div>
  </section>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
  
   
      <!-- Login Form -->
      <form method="post" action="index.php">

        <input required type="text" id="login" class="form-control fadeIn second" name="login" placeholder="login">
        <input required type="password" id="password" class="form-control fadeIn third" name="password" placeholder="password">
        <input required type="radio" id="student" name="type" value="student" selected>
          <label for="student">student</label>
        <input type="radio" id="teacher" name="type" value="teacher">
          <label for="teacher">teacher</label>
        <input type="submit" class="btn btn-lg btn-block btn-secondary fadeIn fourth" value="Log In" >

      </form>
  
      <!-- Remind Passowrd --><!--
      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>
      -->
  
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
