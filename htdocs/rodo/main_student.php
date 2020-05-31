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
  }else{
    echo "<b> u r not logged, go away!</b>";
    //redirect to index?
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
          Recent marks:
        </h2>


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
            <button type="button" class="btn btn-secondary btn-lg btn-block" style="margin-top:0">Send message</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="changePassModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changePassModalLabel">Change password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Old password:</label>
                <input type="password" class="form-control" id="oldpass">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">New parrword:</label>
                <input type="password" class="form-control" id="newpass">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light btn-lg btn-block btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-secondary btn-lg btn-block" style="margin-top:0">Change</button>
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