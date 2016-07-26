<?php
include('session.php');
?>

<?php
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
                    echo '<li> <a onclick="req_click('."'".$row['doc_email']."'".');" href="#tab_requests" data-toggle="tab"> <h4> Doctor '
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
                    echo '<li> <a onclick="exp_click('."'".$row['doc_email']."'".');" href="#tab_expired" data-toggle="tab"> <h4> Doctor '
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
                    echo '<li> <a onclick="app_click('."'".$row['nat_id']."'".');" href="#tab_appointments" data-toggle="tab"> <h5>'.$row['pat_name'].'</h5>'
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
            <li><a href="#tab_expired" data-toggle="tab">Expired contracts</a></li>
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
                            <th>Operations</th>
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
                                            <td><input class='btn btn-success btn-xs' type='button' data-toggle='modal' data-target='#approve_div' value='Approve' 
                                                  onclick='approve(\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/>
                                                <input class='btn btn-danger btn-xs' type='button' value='Deny' data-toggle='modal' data-target='#deny_div' 
                                                  onclick='deny(\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/></td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="request_reset();"/>
                  </div>

                      <!-- approve handling-->
                        <div id="approve_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Approve publishing request</h3>  
                                </div>  

                                <form action="operations/approve.php" method="post">
                                  <div class="modal-body"> 

                                      <h5>Owner doctor:</h5>
                                      <input type="text" class="form-control" id="approve_doc" name="doc_email"/> 
                                      <h5>Medical Type to publish:</h5>  
                                      <input type="text" class="form-control" id="approve_type" name="med_type" />
                                      <h5>Contract Code:</h5>  
                                      <input type="text" class="form-control" name="cont_code" />
                                      <h5>Start Date:</h5>  
                                      <input type="date" name="start_date" />
                                      <h5>Expiration Date:</h5>  
                                      <input type="date" name="exp_date" />
                                  </div> 
                                      
                                  <div class="modal-footer">  
                                  <input type="submit" class="btn btn-success" value="Submit"/>  
                                  <a href="#" class="btn" data-dismiss="modal">Close</a>  
                                  </div>
                                </form>     

                            </div>          
                           </div>
                         </div>
                         <!-- Deny handling-->
                        <div id="deny_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Are you sure you want to deny this request?</h3>  
                                </div>  

                              <form action="operations/deny.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Owner doctor:</h5>
                                      <input type="text" class="form-control" id="deny_doc" name="doc_email"/> 
                                      <h5>Medical type:</h5>  
                                      <input type="text" class="form-control" id="deny_type" name="med_type"/>  
                                </div> 

                                <div class="modal-footer"> 
                                <input type="submit"  class="btn btn-danger" value="Deny"/>  
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                              </form>
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
                            <th>Operations</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  while($row = $contracts->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["cont_code"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["start_date"]."</td>
                                            <td>".$row["exp_date"]."</td>
                                            <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_contract_div' value='Delete' 
                                                  onclick='delete_contract(\"".$row["cont_code"]."\",\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/></td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="contract_reset();"/>
                     <div class="pull-right">
                      <input type="button" class="btn btn-success btn-flat" value="New Contract" data-toggle="modal" data-target="#new_contract_div"/>
                     </div>
                </div>

                        <!-- new contract handling-->
                        <div id="new_contract_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Add new contract</h3>  
                                </div>  

                              <form action="operations/add_contract.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Email/Username of owner doctor:</h5>
                                      <input type="text" class="form-control" id="approve_doc" name="doc_email"/> 
                                      <h5>Medical Type to publish:</h5>  
                                      <input type="text" id="approve_type" name="med_type" />
                                      <h5>Contract Code:</h5>  
                                      <input type="text" name="cont_code" />
                                      <h5>Start Date:</h5>  
                                      <input type="date" name="start_date" />
                                      <h5>Expiration Date:</h5>  
                                      <input type="date" name="exp_date" /> 
                                  </div> 
                                <div class="modal-footer"> 
                                <input type="submit"  class="btn btn-danger" value="Submit"/>  
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                              </form>
                            </div>          
                           </div>                          
                        </div>

                        <!-- delete contract handling-->
                        <div id="del_contract_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Are you sure? deleting this contract can't be undone!</h3>  
                                </div>  

                              <form action="operations/delete_contract.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Contract Code:</h5>  
                                      <input type="text" class="form-control" id="del_cont_code" name="cont_code"/>
                                      <h5>Email/Username of owner doctor:</h5>
                                      <label id="del_cont_doc"></label> 
                                      <h5>Medical Type to publish:</h5>  
                                      <label id="del_cont_type"></label>
                                  </div> 
                                <div class="modal-footer"> 
                                <input type="submit"  class="btn btn-danger" value="Submit"/>  
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                              </form>
                            </div>          
                           </div>                          
                        </div>

          <!--_________________Expired Tab Starts____________________-->
              <div class="tab-pane" id="tab_expired">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="expired_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=1>Username</option>
                      <option value=0>Contract Code</option>
                      <option value=2>Name</option>
                      <option value=4>Phone</option>
                      </span></select>
                     </div>

                     <!-- type select-->
                          <div class="input-group-btn">
                          <select type="button" id="exp_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down">
                          <option value="">All Types</option>
                          <option value="clinic">Clinic</option>
                          <option value="hospital">Hospital</option>
                          <option value="lap">Lap</option>
                          </span></select>
                         </div>

                    <!-- /btn-group -->
                    <input type="text" id="expired_sval" class="form-control">
                    <span class="input-group-btn">
                      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_expired();"/>
                    </span>
                  </div>
                  <!-- search ends-->
                  <div class="box">
                      <div class="box-body">
                        <table id="expired_tbl" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>Contract Code</th>
                            <th>Username</th>
                            <th>Doctor's name</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th>Expiration Date</th>
                            <th>Operations<th/>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                                  mysqli_data_seek($expirations, 0);
                                  while($row = $expirations->fetch_assoc()) {
                                      echo "<tr>
                                            <td>".$row["cont_code"]."</td>
                                            <td>".$row["doc_email"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["doc_phone"]."</td>
                                            <td>".$row["exp_date"]."</td>
                                            <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_expired_div' value='Delete' 
                                                  onclick='delete_expired(\"".$row["cont_code"]."\",\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/></td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="expired_reset();"/>
                     <a href="operations/del_all_exp.php" class="btn btn-danger btn-flat pull-right">Delete all expired</a>
                </div>

                <!-- delete expired handling-->
                        <div id="del_expired_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Are you sure? deleting this contract can't be undone!</h3>  
                                </div>  

                              <form action="operations/delete_contract.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Contract Code:</h5>  
                                      <input type="text" class="form-control" id="del_exp_code" name="cont_code"/>
                                      <h5>Email/Username of owner doctor:</h5>
                                      <label id="del_exp_doc"></label> 
                                      <h5>Medical Type:</h5>  
                                      <label id="del_exp_type"></label>
                                  </div> 
                                <div class="modal-footer"> 
                                <input type="submit"  class="btn btn-danger" value="Submit"/>  
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                              </form>
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
                            <th>Operations</th>
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
                                            <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_doctor_div' value='Delete' 
                                                  onclick='delete_doctor(\"".$row["doc_email"]."\")'/></td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="doctor_reset();"/>
                  </div>

                       <!-- delete doctor handling-->
                        <div id="del_doctor_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Are you sure? deleting this doctor can't be undone!</h3>  
                                </div>  

                              <form action="operations/delete_doctor.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Email/Username of owner doctor:</h5>  
                                      <input type="text" class="form-control" id="del_doc_email" name="doc_email"/>
                                </div> 
                                <div class="modal-footer"> 
                                <input type="submit"  class="btn btn-danger" value="Delete"/>  
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                              </form>
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
                                            <td>".$row["detailed_add"]."</td>
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
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="clinic_reset();"/>
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
                                            <td>".$row["detailed_add"]."</td>
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
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="hospital_reset();"/>
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
                                            <td>".$row["detailed_add"]."</td>
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
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="lap_reset();"/>
                  </div>

              <!--_________________Appointments Tab Starts____________________-->
              <div class="tab-pane" id="tab_appointments">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="appointment_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=1>Patient National ID</option>
                      <option value=2>Patient's name</option>
                      <option value=3>Doctor's name</option>
                      <option value=5>Medical Name</option>
                      <option value=6>Medical Phone</option>
                      </span></select>
                     </div>

                        <!-- type select-->
                          <div class="input-group-btn">
                          <select type="button" id="apps_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down">
                          <option value="">All Types</option>
                          <option value="clinic">Clinic</option>
                          <option value="hospital">Hospital</option>
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
                            <th></th>
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
                                            <td>".$row["app_id"]."</td>
                                            <td>".$row["nat_id"]."</td>
                                            <td>".$row["pat_name"]."</td>
                                            <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                            <td>".$row["med_id"]."</td>
                                            <td>".$row["med_name"]."</td>
                                            <td>".$row["med_type"]."</td>
                                            <td>".$row["phone"]."</td>
                                            <td>".$row["time_date"]."</td>
                                            <td>".$row["spec_name"]."</td>
                                            <td><input class='btn btn-success btn-xs' type='button' data-toggle='modal' data-target='#confirm_div' value='Confirm' 
                                                  onclick='confirm(\"".$row["app_id"]."\",\"".$row["nat_id"]."\",\"".$row["med_id"]."\",\"".$row["time_date"]."\")'/>
                                                <input class='btn btn-danger btn-xs' type='button' value='Cancel' data-toggle='modal' data-target='#cancel_div' 
                                                  onclick='cancel(\"".$row["app_id"]."\",\"".$row["nat_id"]."\",\"".$row["med_id"]."\")'/></td>
                                            </tr>";
                                  }
                              
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="appointment_reset();"/>
                    </div>
                        <!-- confirmation handling-->
                        <div id="confirm_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Confirm this patient</h3>  
                                </div>  

                                <form action="operations/confirm.php" method="post">
                                  <div class="modal-body"> 
                                      <h5>Appointment ID:</h5>
                                      <input type="text" class="form-control" id="conf_app_id" name="app_id"/> 
                                      <h5>Patient ID:</h5>
                                      <label id="conf_pat_id"></label> 
                                      <h5>Medical ID:</h5>  
                                      <label id="conf_med_id"></label> 
                                      <h5>Date & Time:</h5>  
                                      <input type="text" id="conf_date_time" name="real_date"/> 
                                  </div> 
                                      
                                  <div class="modal-footer">  
                                  <input type="submit" class="btn btn-success" value="Confirm"/>  
                                  <a href="#" class="btn" data-dismiss="modal">Close</a>  
                                  </div>
                                </form>     

                            </div>          
                           </div>
                         </div>
                         <!-- Cancelation handling-->
                        <div id="cancel_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Are you sure you want to cancel this appointment?</h3>  
                                </div>  

                              <form action="operations/cancel.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Appointment ID:</h5>
                                      <input type="text" class="form-control" id="cancel_app_id" name="app_id"/> 
                                      <h5>Patient ID:</h5>
                                      <label id="cancel_pat_id"></label> 
                                      <h5>Medical ID:</h5>  
                                      <label id="cancel_med_id"></label>  
                                </div> 

                                <div class="modal-footer"> 
                                <input type="submit"  class="btn btn-danger" value="Yes"/>  
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>

                              </form>
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
                      <option value=0>Patient National ID</option>
                      <option value=1>Patient's name</option>
                      <option value=2>Doctor's username</option>
                      <option value=3>Doctor's name</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" id="confirmed_sval" class="form-control">
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
                                            <td>".$row["real_date"]."</td>
                                            </tr>";
                                  }
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="confirmed_reset();"/>
                  </div>

              <!--_________________Patients Tab Starts____________________-->
              <div class="tab-pane" id="tab_patients">
                <!-- search -->
                <div class="input-group margin">
                    <div class="input-group-btn">
                      <select type="button" id="patient_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
                      <option value="">Search with</option>
                      <option value=0>National ID</option>
                      <option value=1>Name</option>
                      <option value=2>Phone</option>
                      <option value=3>Email</option>
                      </span></select>
                     </div>
                    <!-- /btn-group -->
                    <input type="text" id="patient_sval" class="form-control">
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
                            <th>Operations</th>
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
                                            <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_patient_div' value='Delete' 
                                                  onclick='delete_patient(\"".$row["nat_id"]."\")'/></td>
                                            </tr>";
                                  }
                            ?>
                          </tbody>
                         </table>
                       </div>
                     </div>
                     <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="patient_reset();"/>
                  </div>

                    <!-- delete Patient handling-->
                        <div id="del_patient_div" class="modal fade" style="display: none; "> 
                            <div class="modal-dialog">
                            <div class="modal-content"> 

                                <div class="modal-header">  
                                    <a class="close" data-dismiss="modal">×</a>  
                                    <h3>Are you sure? deleting this Patient can't be undone!</h3>  
                                </div>  

                              <form action="operations/delete_patient.php" method="post">
                                <div class="modal-body"> 
                                      <h5>Patient National ID:</h5>  
                                      <input type="text" class="form-control" id="del_pat_id" name="nat_id"/>
                                </div> 
                                <div class="modal-footer"> 
                                  <input type="submit"  class="btn btn-danger" value="Delete"/>  
                                  <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                              </form>
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
<script src="operations.js"></script>
<script src="resets.js"></script>
<!-- ./wrapper -->
<script src="notif_click.js"></script>
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
