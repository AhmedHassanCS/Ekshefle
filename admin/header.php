<?php
require_once('session.php');
require_once('notifications.php');
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ekshefle Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Ekshefle</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <!-- Navbar Right Menu -->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
      <div class="pull-left" >
      
        <small class="logo">Admin Manager</small>
      
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-stethoscope"></i>
              <?php if($requests_num > 0) 
                      echo '<span class="label label-success">'.$requests_num.'</span>'; ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $requests_num ?> requests</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                    <?php 
                      while($row = $requests->fetch_assoc()) 
                      {
                        echo '<li> <a onclick="load_requests(true,'."'".$row['doc_email']."'".');" href="#" data-toggle="tab"> <h4> Doctor '
                        .$row['doc_fname'].' '.$row['doc_sname'].' '.$row['doc_lname'].'</h4>'
                        .'<p>Wants to publish his '.$row['med_type'].'s</p></a></li>';
                      }
                  ?>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#tab_requests" data-toggle="tab">View all requests</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-calendar-times-o"></i>
              <?php if($expirations_num > 0) 
                      echo '<span class="label label-danger">'.$expirations_num.'</span>'; ?>
            </a>
            <ul class="dropdown-menu">
              
              <li class="header"><?php echo $expirations_num; ?> Contracts timed out</li>
              <?php 
                  while($row = $expirations->fetch_assoc()) 
                  {
                    echo '<li> <a onclick="load_expired(true, '."'".$row['doc_email']."'".');" href="#tab_expired" data-toggle="tab"> <h4> Doctor '
                    .$row['doc_fname'].' '.$row['doc_sname'].' '.$row['doc_lname'].'</h4>'
                    .$row['med_type'].'s contract '.$row['cont_code'].' expired</p></a></li>';
                  }
              ?>
              <li class="footer"><a href="#tab_expired" data-toggle="tab">View all timed out</a></li> 
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-odnoklassniki"></i>
              <?php if($appointments_num>0) echo '<span class="label label-success  ">'.$appointments_num.'</span>'; ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo $appointments_num ?> new appointments</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <?php 
                  while($row = $appointments->fetch_assoc()) 
                  {
                    echo '<li> <a onclick="load_appointments(true, '."'".$row['nat_id']."'".');" href="#tab_appointments" data-toggle="tab"> <h5>'
                    .$row['pat_name'].'</h5>'
                    .'<p><small>Appointment in Dr. '.$row['doc_fname'].' '.$row['doc_sname']."'s ".$row['med_type'].'</small></p></a></li>';
                  }
                  ?>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#tab_appointments" data-toggle="tab">View all pending appointments</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['login_user']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#" onclick="load_patients();" data-toggle="tab">Patients</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Admins</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#" onclick="load_doctors();" data-toggle="tab">Doctors</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <?php
    require_once("sidebar.php");
  ?>
  