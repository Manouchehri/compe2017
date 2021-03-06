<?php
include_once '../utils/utils.php';
include_once '../utils/messaging.php';

if (isset($_POST['employee_email']) && isset($_POST['employee_password'])) {
  $res = $db->rawQuery('SELECT * FROM employees WHERE employee_email = ? and employee_password = ?', array($_POST['employee_email'], md5($_POST['employee_password'])));
  if (sizeof($res) > 0) {
    $_SESSION['identity'] = $res[0];
  } else {
    die();
  }
} else {
    die();
  }
  confirm_auth();
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>WTIIAAS — Messaging</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
    </style>
  </head>
  <body>

    <div class="container-fluid">
      <div class="row content">
        <div class="col-sm-3 sidenav">
          <h4>WTIIAAS — Intranet</h4>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="/intranet/">News</a></li>
            <li class="active"><a href="/messaging/">Messaging <span class="badge"><?= get_unread_message_count() ?></span></a></li>
            <li><a href="/intranet/logout.php">Log Out</a></li>
          </ul><br>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Blog..">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
          </div>
        </div>

        <div class="col-md-9">
          <h1>Messaging</h1>
          <hr>
          <?php
          $message = get_message_by_id_latest();
          ?>

          <div class="row">
            <div class="col-md-2">
              <span><h2><small>From</small></h2></span>
            </div>
            <div class="col-md-9">
              <span><h2><small>Subject</small></h2></span>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-2">
              <div class="well">
                <p><?=$message['employee_lname'].", ".$message['employee_fname']?></p>
              </div>
            </div>
            <div class="col-md-9">
              <div class="well">
                <p><?=$message['message_subject']?></p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-1">
              <span><h2><small>Message</small></h2></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-11">
              <div class="well">
                <p><?=$message['message_content']?></p>
              </div>
            </div>

          </div>
        </div>
      </div>

      <footer class="container-fluid">
        <p>Footer Text</p>
      </footer>

  </body>
</html>
