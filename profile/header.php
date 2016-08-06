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
    <link rel="stylesheet" href="/ekshefle/admin/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/ekshefle/admin/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/ekshefle/admin/dist/css/skins/skin-blue.min.css">




    <script src="/ekshefle/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/ekshefle/images/ico/favicon.ico">
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
          <a id="logo" class="pull-left" href="/ekshefle/"></a>
          <div class="nav-collapse collapse pull-right">
              <ul class="nav">
                  <li><a href="/ekshefle/"><h4>رئيسية</h4></a></li>
                  <li><a href="about-us.html"><h4>معلومات</h4></a></li>
                  <li><a href="services.html"><h4>خدمات</h4></a></li>
                  <li><a href="contact-us.html"><h4>تواصل معنا</h4></a></li>
                  <li><a href="contact-us.html"><h4>إحجز الأن</h4></a></li>
                  
                  <!-- User Account Menu --><!--.....................................-->
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['loggedin_user'];?><i class="icon-angle-down"></i></a>
                            <ul class="dropdown-menu" style="border:1px solid red;">
                                <br>
                                <li><a href="/ekshefle/profile/"><label>View Profile</label></a></li>
                                <li><a href="#"><label>Edit Information</label></a></li>
                                <li><a href="#"><label>Owned</label></a></li>
                                <br>
                                <li class="user-footer">
                                  <div class="text-center">
                                    <a href="logout.php" class="btn btn-danger btn-flat">Sign out</a>
                                  <br>
                                  </div>
                                </li>
                                <br>
                      </li>
              </ul>        
                    
          </div><!--/.nav-collapse -->
      </div>
  </div>
</header>
<!-- /header -->