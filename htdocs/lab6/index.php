<?php
include 'class_definitions.php';
session_start();


if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}

$content = new Content();

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
$level = 0;
if(isset($user)){
    $level = $user->level;
}
$sql = "SELECT * FROM lab6.pages WHERE level <= $level";
//echo $sql;
if($result = $conn->query($sql)){
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $new_page = new Page();
            $new_page->id = $row["id"];
            $new_page->title = $row["title"];
            $new_page->content = $row["content"];
            $new_page->level = $row["level"];

            $content->pages[$new_page->id] = $new_page;

        }
    } else {
        
    }
}
//print_r($content);
$conn->close();


?>
<html>

<head>
    <title>Main Page</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/style.css">-->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="text-center bg-dark text-light">
    
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">
    <a class="navbar-brand" href="index.php">Welcome</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

            <?php
            
            foreach($content->pages as $page){
                $css_class = '';
                if(isset($_GET['page']) and $_GET['page'] == $page->id) $css_class = 'active';
                
                echo '
                <li class="nav-item '.$css_class.'">
                    <a class="nav-link" href="index.php?page='.$page->id.'">'.$page->title.'</a>
                </li>
                ';
            }

            ?>
        </ul>
        <?php
        
        if(isset($user)){
            //is logged in
            echo "<hr />";
            echo "<p class=\"text-light\" style=\"
                margin-top: auto;
                margin-bottom: auto;
                padding:10px;
                \">
                Logged in as: $user->login</p>";
            echo '<button class="btn btn-outline-danger text-light my-2 my-sm-0" onclick="location.href = \'logout.php\';" >Logout</button>';
        }else{
            //not logged in 
            echo '<button class="btn btn-outline-success text-light my-2 my-sm-0" onclick="location.href = \'login.php\';" >Login</button>';
        }

        ?>
        
       
    </div>
</nav>
<div class="container" style="margin-top: 100px;">
    
    <?php
    
    
    if(isset($_GET['page'])){
        //echo 'requested page = ';
        $page =  $_GET['page'];
        if(isset($content->pages[$page])){
            echo($content->pages[$page]->content);
        }else{
            echo '<span class="text-danger"><h1>404</h1>page does not exist</span>';
        }
        
    }else{
        echo "<h2>Welcome to my page</h2>Choose topic from top navigation bar.";
    }
    
    ?>
</div>
</body>
</html>