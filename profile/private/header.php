<?php
if(!$loggedin)
  header("location: /ekshefle/");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Ekshifly</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="/ekshefle/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ekshefle/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/ekshefle/css/font-awesome.min.css">
    <link rel="stylesheet" href="/ekshefle/css/main.css">
    <link rel="stylesheet" href="/ekshefle/css/sl-slide.css">

    <link rel="stylesheet" href="/ekshefle/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/ekshefle/admin/bootstrap/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/ekshefle/admin/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/ekshefle/admin/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/ekshefle/admin/plugins/select2/select2.min.css">
    
    <link rel="stylesheet" href="/ekshefle/admin/plugins/pace/pace.min.css">    


    <script src="/ekshefle/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ekshefle/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ekshefle/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ekshefle/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ekshefle/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

<!--Header-->
<header class="navbar navbar-fixed-top">
  <div class="navbar-inner">
      <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </a>
          <a id="logo" class="pull-left"  style="background:url(/ekshefle/images/logo-eng.png) no-repeat 0 50%;" href="/ekshefle/"></a>
          <div class="nav-collapse collapse pull-right">
              <ul class="nav navbar-nav">
                  <li><a href="/ekshefle/"><h5>Home</h5></a></li>
                  <li><a href="/ekshefle/reservation.php"><h5>Reservation</h5></a></li>
                  <!--
                  <li><a href="about-us.html"><h5>About</h5></a></li>
                  <li><a href="services.html"><h5>Services</h5></a></li>
                  <li><a href="contact-us.html"><h5>Contact</h5></a></li>
                  -->
                  
                  <!-- User Account Menu --><!--.....................................-->
                  <li class="dropdown text-center">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="hidden-xs"><?php echo $_SESSION['loggedin_user']; ?>
                        <i class="icon-angle-down"></i>
                      </span>
                    </a>
                    <ul class="dropdown-menu" style="box-shadow: 0 0 4px 4px #222;">
                        <li class="box-body">
                          <br>
                        <a href="/ekshefle/profile/"><h4><i class="fa fa-user-md"></i>  PROFILE</h4></a>
                        </li>
                        <li class="box-footer">
                            <a href="/ekshefle/profile/logout.php" class="btn btn-danger" style="color:#333">Sign out</a>
                        </li>
                        <br>
                    </ul>
                  </li>
              </ul>        
                    
          </div><!--/.nav-collapse -->
      </div>
  </div>
</header>
<!-- /header -->