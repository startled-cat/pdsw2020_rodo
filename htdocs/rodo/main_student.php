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
    include_once('database_connection.php');
    if( $_POST['submit'] == "student_delete_grade" && isset($_POST['grade_to_delete'])){
      //delete given grade
      $grade_id = $_POST['grade_to_delete'];
      $delete_grade_sql =  "DELETE FROM rodo.grades WHERE id = ".$grade_id.";";
      //echo $delete_grade_sql;
      
      $delete_result = $conn->query($delete_grade_sql);
      //$delete_result = false;
      if(!$delete_result){
          $error = "error while trying to delete grade ";
      }else{
          $success = "successfully deleted grade ";
      }
    }else if( $_POST['submit'] == "student_mark_as_seen_grade" && isset($_POST['grade_seen'])){
      $grade_id = $_POST['grade_seen'];
      $update_seen_grades_sql = "UPDATE `rodo`.`grades` SET `rodo`.`grades`.`seen` = 1 WHERE `rodo`.`grades`.`student_id` = ".$user->id." AND `rodo`.`grades`.`id` = ".$grade_id.";";
      $update_result = $conn->query($update_seen_grades_sql);
      if(!$update_result){
        $error = "error while marking grade as seen";
      }else{
        //$success = "marked grade as seen";
      }

    }
    

  }

?>
</head>



<body>

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
      </nav>
      <div class="container-fluid">
      <?php 
        if(isset($error)) {
          echo "<div class=\"alert alert-danger\">".$error."</div>";
        }
        if(isset($success)){
          echo "<div class=\"alert alert-success\">".$success."</div>";
        }
      ?>

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
              $new = "";
              if($grades_row['seen'] < 1){
                $new = "<span class=\"badge badge-primary\">New</span>";
              }
              echo '
              <div class="card clickable" data-toggle="collapse"  href="#collapse_'.$i.'" aria-expanded="true" aria-controls="collapse_'.$i.'">
                <div class="card-body">
                  <h5 class="card-title">'.$grades_row['value']." - ".$grades_row['task'].' '.$new.'</h5>
                  <div class="collapse multi-collapse" id="collapse_'.$i.'">
                    <p class="card-text">data: '.$grades_row['date'].'<br>komentarz: '.$grades_row['comment'].'<br><i>'.$grades_row['teacher_name'].'</i></p>
                    <form action="main_student.php" method="post">
                      <input type="hidden" name="grade_to_delete" value="'.$grades_row['id'].'">
                      <button type="submit" name="submit" value="student_delete_grade" class="btn btn-danger" >Delete</button>
                      <input type="hidden" name="grade_seen" value="'.$grades_row['id'].'">
                      <button type="submit" name="submit" value="student_mark_as_seen_grade" class="btn btn-primary" >Mark as seen</button>
                    </form>
                  </div>

                </div>
              </div>
              ';
              $i += 1;
            }
          }
        ?>



    </div>

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
          alert(JSON.parse(r).response);
        },
        error: function(error) {
          alert("Ajax request error");
          console.log(error);
        }
      });
    }
    $("#changePasswordButton").click(e => {
      sendChangePasswordRequest();
    });
  </script>
</body>

</html>
