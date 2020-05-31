<!DOCTYPE html>
<html lang="en">

<head>
  

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMS - teacher</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  
  <link href="vendor/open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  <?php

  include_once('classes.php');
  include_once('database_connection.php');

  session_start();
  if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    if(!$user->is_teacher){
      echo "<b> u is nto teacher</b>";
    //redirect to index?
    }
  }else{
    echo "<b> u r not logged, go away!</b>";
    //redirect to index?
  }
  if(isset($_POST) && isset($_POST["submit"]) ){
    echo "<div class=\"alert alert-info\">";
    if($_POST["submit"] == ""){
      // ------------------------------------------------------------------------------ just display file here
      include "file_display.php";
    }else{
      //upload file
      include "file_upload.php";
    }
    echo "</div>";
  }

?>
<?PHP
    if(isset($table) && $table != ""){
      echo "
      <script src=\"script/jquery.min.js\"></script>

      <script>
        $(window).on('load',function(){
          $('#uploadModal').modal('show');
        });
      </script>";
    }
  ?>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">SMS</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#uploadModal">upload grades</a>
        <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#generateModal">generate accounts</a>
        <a href="#" data-toggle="modal" data-target="#exampleModal" class="list-group-item list-group-item-action bg-light">report a bug</a>
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
        
      
      <button type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#uploadModal">Upload marks</button>

      <button type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#generateModal">Generate passwords</button>

      <h2 class="text-center recent-marks">
        Recent marks:
      </h2>

      <?php
        $tasks_query = "select task from rodo.grades where teacher_id = ".$user->id." group by task;";
        //echo $query;
        $marks_tasks_result = $conn->query($tasks_query);
        if ($marks_tasks_result->num_rows > 0) {
          // output data of each row
          $i = 0;
          while($marks_tasks_row = $marks_tasks_result->fetch_assoc()) {
            echo '
            <div class="card clickable" data-toggle="collapse"  href="#collapse_'.$i.'" aria-expanded="true" aria-controls="collapse_'.$i.'">
            <div class="card-body">
              <h5 class="card-title">'. $marks_tasks_row["task"].'</h5>
              <div class="collapse multi-collapse" id="collapse_'.$i.'">
                <p class="card-text">';

            //echo "task: " . $marks_tasks_row["task"]."<br>";
            $marks_query = "SELECT * FROM rodo.v_students_grades where teacher_id = ".$user->id." and task = '".$marks_tasks_row["task"]."';";
            //echo $marks_query;
            $marks_result = $conn->query($marks_query);
            if ($marks_result->num_rows > 0) {
              echo '
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">index</th>
                    <th scope="col">mark</th>
                    <th scope="col">comment</th>
                    <th scope="col">date</th>
                  </tr>
                </thead>
                <tbody>';
              // output data of each row
              while($marks_row = $marks_result->fetch_assoc()) {
                echo "
                  <tr>
                      <th>".$marks_row["student_number"]."</th>
                      <td>".$marks_row["value"]."</td>
                      <td>".$marks_row["comment"]."</td>
                      <td>".$marks_row["date"]."</td>
                    </tr>
                  ";
              }
              echo '</tbody>
              </table>';
            }
            echo '
                  </p>
                  <a href="#" class="btn btn-danger">delete all</a>
                </div>

              </div>
            </div>
            ';
            $i += 1;
          }
          
        } else {
          echo "0 results";
        }
      ?>

      

    </div>

    </div>
    <!-- /#page-content-wrapper -->



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name" value="bugreporting@example.com">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light btn-lg btn-block btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-secondary btn-lg btn-block">Send message</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" 
  id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" 
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Upload Marks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="main_teacher.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="asd", value="ASD">
          <div class="modal-body">
          
            <div class="form-group">
              <label for="file">CSV file input:</label>
              <input required type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" >
              <script>
                const fileSelector = document.getElementById('fileToUpload');
                fileSelector.addEventListener('change', (event) => {
                  const fileList = event.target.files;
                  console.log(fileList);
                });
              </script>
              Mark title:
              <input name="mark_name" id="mark_name" class="form-control" type="text" <?php if(isset($mark_title) && $mark_title != "") echo "value=\"$mark_title\""; ?>placeholder="from file or enter manually">
              View:
              <?PHP
                if(isset($table) && $table != ""){
                  echo $table;
                }
              ?>
              <!--
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Index</th>
                    <th scope="col">Mark</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>242000</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>213769</td>
                    <td>3.5</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>299888</td>
                    <td>5</td>
                  </tr>
                </tbody>
              </table>
              -->
            </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light btn-lg btn-block btn-outline-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" value="" class="btn btn-secondary btn-lg btn-block" style="margin-top:0">Load</button>
            <button type="submit" name="submit" value="yez" class="btn btn-secondary btn-lg btn-block" style="margin-top:0">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="generateModalLabel">Generate passwords</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">CSV file input:</label>
              <input required type="file" class="form-control-file" id="exampleFormControlFile1">
              View:
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Index</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>242000</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>213769</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>299888</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-lg btn-block btn-outline-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-secondary btn-lg btn-block " style="margin-top:0">Generate</button>
        </div>
      </div>
    </div>
  </div>


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

</body>

</html>
