<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMS - student</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <link href="vendor/open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
<?php

  include_once('classes.php');
  session_start();
  if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    if(!$user->is_student){
      echo "<b> u is nto studnet</b>";
      header('Location: ' . "index.php", true, $permanent ? 301 : 302);

    //redirect to index?
    }
  }else{
    echo "<b> u r not logged, go away!</b>";
    header('Location: ' . "index.php", true, $permanent ? 301 : 302);

    //redirect to index?
  }

  if(isset($_POST) && isset($_POST['submit']) ){
    if( $_POST['submit'] == "student_delete_grade" && isset($_POST['grade_to_delete'])){
      //delete given grade
      $grade_id = $_POST['grade_to_delete'];
      $delete_grade_sql =  "DELETE FROM rodo.grades WHERE id = ".$grade_id.";";
      //echo $delete_grade_sql;
      include_once('database_connection.php');
      $delete_result = $conn->query($delete_grade_sql);
      //$delete_result = false;
      if(!$delete_result){
          $error = "error while trying to delete grade ";
      }else{
          $success = "successfully deleted grade ";
      }

    }
    

  }

?>
</head>



<body>

<?php 
  if(isset($error)) {
    echo "<div class=\"alert alert-danger\">".$error."</div>";
  }
  if(isset($success)){
    echo "<div class=\"alert alert-success\">".$success."</div>";
  }
?>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">SMS</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">view your grades</a>
        <a href="#" data-toggle="modal" data-target="#exampleModal" class="list-group-item list-group-item-action bg-light">report a bug</a>
        <a href="#" data-toggle="modal" data-target="#changePassModal" class="list-group-item list-group-item-action bg-light">change password</a>
        <a href="logout.php" class="list-group-item list-group-item-action bg-light">logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-light" id="menu-toggle"><span class="oi oi-menu"></span></button>
        <?php echo "Hello $user->name " ?>
<!--
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
-->
        
      </nav>
      <div class="container-fluid">

        <h2 class="text-center recent-marks">
          Your recent marks:
        </h2>
        <?php
          $grades_sql = "SELECT * FROM rodo.v_students_grades WHERE student_id = ".$user->id.";";
          include_once('database_connection.php');
          $grades_result = $conn->query($grades_sql);
          if ($grades_result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($grades_row = $grades_result->fetch_assoc()) {
              echo '
              <div class="card clickable" data-toggle="collapse"  href="#collapse_'.$i.'" aria-expanded="true" aria-controls="collapse_'.$i.'">
                <div class="card-body">
                  <h5 class="card-title">'.$grades_row['value']." - ".$grades_row['task'].'  <span class="badge badge-primary">New</span></h5>
                  <div class="collapse multi-collapse" id="collapse_'.$i.'">
                    <p class="card-text">data: '.$grades_row['date'].'<br>komentarz: '.$grades_row['comment'].'<br><i>'.$grades_row['teacher_name'].'</i></p>
                    <form action="main_student.php" method="post">
                      <input type="hidden" name="grade_to_delete" value="'.$grades_row['id'].'">
                      <button type="submit" name="submit" value="student_delete_grade" class="btn btn-danger" >Delete</button>
                    </form>
                  </div>

                </div>
              </div>
              ';
              $i += 1;
            }
          }
        ?>

        <!--
        <div class="card clickable" data-toggle="collapse"  href="#collapse_1" aria-expanded="true" aria-controls="collapse_1">
          <div class="card-body">
            <h5 class="card-title">5 - PDSwww <span class="badge badge-primary">New</span></h5>
            <div class="collapse multi-collapse" id="collapse_1">
              <p class="card-text">28/04/2020 short information about this exam</p>
              <a href="#" class="btn btn-danger">delete</a>
            </div>

          </div>
        </div>
        <div class="card clickable" data-toggle="collapse"  href="#collapse_2" aria-expanded="true" aria-controls="collapse_2">
          <div class="card-body">
            <h5 class="card-title">4 - PSI </h5>
            <div class="collapse multi-collapse" id="collapse_2">
              <p class="card-text">01/04/2020 homework</p>
              <a href="#" class="btn btn-danger">delete</a>
            </div>
          </div>
        </div>
        <div class="card clickable" data-toggle="collapse"  href="#collapse_3" aria-expanded="true" aria-controls="collapse_3">
          <div class="card-body">
            <h5 class="card-title">3 - SCR </h5>
            <div class="collapse multi-collapse" id="collapse_3">
              <p class="card-text">25/03/2020 exercise 2</p>
              <a href="#" class="btn btn-danger">delete</a>
            </div>
          </div>
        </div>
      </div>
      -->


    </div>
    <!-- /#page-content-wrapper -->


    <?php
    include "bug_report_form.php";
    ?>

    <?PHP
      include "change_password_form.php";
    ?>



  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script>
    function sendChangePasswordRequest() {
      var oldPass = document.getElementById("oldpass").value;
      var newPass = document.getElementById("newpass").value;
      var login = "<?php Print($user->login); ?>";//this is... weird, but i dont know how to do it better
      $.ajax({
        url: "change_password.php",
        type: "post",
        datatype: "application/json",
        data: {user_type: "student", login: login, old_password: oldPass, new_password: newPass},
        success: function(r) {
          console.log(r);
          // alert(JSON.parse(r).response);
          var responseObj = JSON.parse(r);
          var responseString = responseObj.response;
          var colorString = responseObj.success === "true" ? "#1b9400" : "#c40000";
          $("#changePassResponseInfo").
              empty().
              append(`<h2 style="margin-left: 25px; color: ${colorString}; font-size:18px;">${responseString}</h2>`).
              hide().
              fadeIn(750).
              delay(3500).
              fadeOut('slow');
        },
        error: function(error) {
          alert("Ajax request error");
          console.log(error);
        }
      });
    }
    
  </script>
  <script>
    $("#changePasswordButton").click(e => {
      sendChangePasswordRequest();
    });
  </script>
</body>

</html>
