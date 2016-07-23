<?php
include('session.php');
?>

<?php
//$requests_num =2;
//$appointments_num =0;
//$expirations_num =0;
include('notifications.php');
include('main_tables.php');
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
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
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
                    echo '<li> <a href="#"> <h4> Doctor '
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
              <?php if($expirations_num>0)'<span class="label label-warning">'.$expirations_num.'</span>'; ?>
            </a>
            <ul class="dropdown-menu">
              
              <li class="header"><?php echo $expirations_num; ?> Contracts timed out</li>
              <?php 
                  while($row = $expirations->fetch_assoc()) 
                  {
                    echo '<li> <a href="#"> <h4> Doctor '
                    .$row['doc_fname'].' '.$row['doc_sname'].' '.$row['doc_lname'].'</h4>'
                    .$row['med_type'].'s contract '.$row['contract_code'].' expired</p></a></li>';
                  }
              ?>
              <li class="footer"><a href="#">View all timed out</a></li> 
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-odnoklassniki"></i>
              <?php if($appointments_num>0) echo '<span class="label label-danger">'.$appointments_num.'</span>'; ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo $appointments_num ?> new appointments</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <?php 
                  while($row = $appointments->fetch_assoc()) 
                  {
                    echo '<li> <a href="#"> <h4>'.$row['pat_name'].'</h4>'
                    .'<p>Appointment in Dr. '.$row['doc_fname'].' '.$row['doc_sname']."'s ".$row['med_type'].'</p></a></li>';
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
              <!-- The user image in the menu -->
              <!--<li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>-->

              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#tab_patients" data-toggle="tab">Patients</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="admins.php">Admins</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#tab_doctors" data-toggle="tab">Doctors</a>
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
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <!--li class="active"><a href="#"><i class="fa fa-link"></i> <span>Pending Publishing Requests</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Not confirmed patients</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>All Pateints</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>All Doctors</span></a></li>-->
        
        <li class="treeview">
          <a href="#"><i class="fa fa-user-md"></i> <span>Doctors</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#tab_requests" data-toggle="tab">Pending publishing requests</a></li>
            <li><a href="#tab_contracts" data-toggle="tab">Running contracts</a></li>
            <li><a href="#tab_doctors" data-toggle="tab">All doctors</a></li>

          </ul>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa fa-medkit"></i> <span>Medical</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#tab_clinics" data-toggle="tab">Clinics</a></li>
            <li><a href="#tab_hospitals" data-toggle="tab">Hospitals</a></li>
            <li><a href="#tab_laps" data-toggle="tab">Laps</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-odnoklassniki "></i> <span>Patients</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#tab_appointments" data-toggle="tab">Pending appointments</a></li>
            <li><a href="#tab_confirmed" data-toggle="tab">Confirmed appointments</a></li>
            <li><a href="#tab_patients" data-toggle="tab">All patients</a></li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    


    <!-- Main content -->
    <section class="content">
      
      <div class="tab-content">

        <!--_________________Requests Tab Starts____________________-->
            <div class="tab-pane" id="tab_requests">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select id="request_swith" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=0>Username</option>
                      <option value=1>Name</option>
                      <option value=3>Phone</option>
                      </span></select>
                     </div>

                     <!-- type select-->
                          <div class="input-group-btn">
                          <select type="button" id="reqs_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down">
                          <option value="">All Types</option>
                          <option value="clinic">Clinic</option>
                          <option value="hospital">Hospital</option>
                          <option value="lap">Lap</option>
                          </span></select>
                         </div>

                    <!-- /btn-group -->
                    <input type="text" id="request_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_requests();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="request_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th>Address</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  mysqli_data_seek($requests, 0);
                                  while($row = $requests->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["doc_phone"]."</td>
                                            <td>".$row["doc_address"]."</td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>

          <!--_________________Contracts Tab Starts____________________-->
              <div class="tab-pane" id="tab_contracts">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="contract_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=1>Username</option>
                      <option value=0>Contract Code</option>
                      <option value=2>Name</option>
                      </span></select>
                     </div>

                     <!-- type select-->
                          <div class="input-group-btn">
                          <select type="button" id="conts_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down">
                          <option value="">All Types</option>
                          <option value="clinic">Clinic</option>
                          <option value="hospital">Hospital</option>
                          <option value="lap">Lap</option>
                          </span></select>
                         </div>

                    <!-- /btn-group -->
                    <input type="text" id="contract_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_contracts();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="contract_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Contract Code</th>
                            <th>Username</th>
                            <th>Doctor's name</th>
                            <th>Type</th>
                            <th>Start date</th>
                            <th>Expiration Date</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $contracts->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["contract_code"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["start_date"]."</td>
                                            <td>".$row["exp_date"]."</td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                </div>

              <!--_________________Doctors Tab Starts____________________-->
              <div class="tab-pane" id="tab_doctors">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="doctor_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=0>Username</option>
                      <option value=1>Name</option>
                      <option value=2>Phone</option>
                      <option value=4>Specialty</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" id="doctor_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_doctors();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="doctor_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Specialty</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $doctors->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["doc_phone"]."</td>
                                            <td>".$row["doc_address"]."</td>
                                            <td>".$row["spec_name"]."</td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>

        <!--_________________Clinics Tab Starts____________________-->
            <div class="tab-pane" id="tab_clinics">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="clinic_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=4>Doctor's Username</option>
                      <option value=5>Doctor's Name</option>
                      <option value=1>Clinic's Name</option>
                      <option value=2>Clinic's Phone</option>

                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" id="clinic_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_clinics();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="clinic_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Clinic's Name</th>
                            <th>Clinic's Phone</th>
                            <th>Clinic's Address</th>
                            <th>Doctor's Username</th>
                            <th>Doctor's Name</th>
                            <th>Is Active</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $clinics->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["med_id"]."</td>
                                            <td>".$row["med_name"]."</td>
                                            <td>".$row["phone"]."</td>
                                            <td>".$row["detailed"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["is_active"]."</td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>

          <!--_________________Hospitals Tab Starts____________________-->
              <div class="tab-pane" id="tab_hospitals">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="hospital_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=4>Doctor's Username</option>
                      <option value=5>Doctor's Name</option>
                      <option value=1>Hospital's Name</option>
                      <option value=2>Hospital's Phone</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" id="hospital_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_hospitals();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="hospital_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Hospital's Name</th>
                            <th>Hospital's Phone</th>
                            <th>Hospital's Address</th>
                            <th>Doctor's Username</th>
                            <th>Doctor's Name</th>
                            <th>Is Active</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                                  while($row = $hospitals->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["med_id"]."</td>
                                            <td>".$row["med_name"]."</td>
                                            <td>".$row["phone"]."</td>
                                            <td>".$row["detailed"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["is_active"]."</td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                </div>

              <!--_________________Laps Tab Starts____________________-->
              <div class="tab-pane" id="tab_laps">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="lap_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=4>Doctor's Username</option>
                      <option value=5>Doctor's Name</option>
                      <option value=1>Lap's Name</option>
                      <option value=2>Lap's Phone</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" id="lap_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_laps();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="lap_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Lap's Name</th>
                            <th>Lap's Phone</th>
                            <th>Lap's Address</th>
                            <th>Doctor's Username</th>
                            <th>Doctor's Name</th>
                            <th>Is Active</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $laps->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["med_id"]."</td>
                                            <td>".$row["med_name"]."</td>
                                            <td>".$row["phone"]."</td>
                                            <td>".$row["detailed"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["is_active"]."</td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>

              <!--_________________Appointments Tab Starts____________________-->
              <div class="tab-pane" id="tab_appointments">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="appointment_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value="Pat_id">Patient National ID</option>
                      <option value="pat_name">Patient's name</option>
                      <option value="doc_name">Doctor's name</option>
                      <option value="med_name">Medical Name</option>
                      <option value="med_Phone">Medical Phone</option>
                      </span></select>
                     </div>

                        <!-- type select-->
                          <div class="input-group-btn">
                          <select type="button" id="apps_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down">
                          <option value="">All Types</option>
                          <option value="clinic">Clinic</option>
                          <option value="hopital">Hospital</option>
                          <option value="lap">Lap</option>
                          </span></select>
                         </div>

                    <!-- /btn-group -->
                    <input type="text" id="appointment_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_appointments();"/>
                    </span>

                    </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="appointment_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Patient's ID</th>
                            <th>Pateint's Name</th>
                            <th>Doctor's Name</th>
                            <th>Medical ID</th>
                            <th>Medical Name</th>
                            <th>Medical Type</th>
                            <th>Medical Phone</th>
                            <th>Date & Time</th>
                            <th>Specialty</th>
                            <th>Operations</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                                  mysqli_data_seek($appointments, 0);
                                  while($row = $appointments->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["nat_id"]."</td>
                                            <td>".$row["pat_name"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_id"]."</td>
                                            <td>".$row["med_name"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["phone"]."</td>
                                            <td>".$row["time_date"]."</td>
                                            <td>".$row["spec_name"]."</td>
                                            <td><input type='button' value='confirm'></td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>

              <!--_________________Confirmed Tab Starts____________________-->
              <div class="tab-pane" id="tab_confirmed">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="confirmed_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value="Pat_id">Patient National ID</option>
                      <option value="pat_name">Patient's name</option>
                      <option value="doc_name">Doctor's name</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_confirmed();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="confirmed_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Patient's ID</th>
                            <th>Pateint's Name</th>
                            <th>Doctor's username</th>
                            <th>Doctor's Name</th>
                            <th>Medical ID</th>
                            <th>Medical Type</th>
                            <th>Appointment Date</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $confirmed->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["nat_id"]."</td>
                                            <td>".$row["pat_name"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_id"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["time_date"]."</td>
                                            </tr>";
                                  }
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>

              <!--_________________Patients Tab Starts____________________-->
              <div class="tab-pane" id="tab_patients">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="pateint_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value="Pat_id">National ID</option>
                      <option value="pat_name">Name</option>
                      <option value="Pat_phone">Phone</option>
                      <option value="pat_email">Email</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_patients();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="patient_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>National ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>E-mail</th>
                            <th>Address</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $patients->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["nat_id"]."</td>
                                            <td>".$row["pat_name"]."</td>
                                            <td>".$row["pat_phone"]."</td>
                                            <td>".$row["pat_email"]."</td>
                                            <td>".$row["pat_address"]."</td>
                                            </tr>";
                                  }
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                  </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->

    </div>
  </aside>
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="searches.js"></script>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
