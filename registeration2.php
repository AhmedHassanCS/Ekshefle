<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Doctor Registeration</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sl-slide.css">

    <link rel="stylesheet" href="../admin/dist/css/AdminLTE.min.css">

    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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
                <a id="logo" class="pull-left" href="index.html"></a>
                <div class="nav-collapse collapse pull-right">
                    <ul class="nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="contact-us.html">Contact</a></li>
                        <li class="login">
                            <a data-toggle="modal" href="#loginForm"><i class="icon-lock"></i></a>
                        </li>
                        <li><a href="registeration.php">Doctor -> Register</a></li>
                    </ul>        
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </header>
    <!-- /header -->

<section class="title">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h1>Registration</h1>
        </div>
        <div class="span6">
          <ul class="breadcrumb pull-right">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li><a href="#">Pages</a> <span class="divider">/</span></li>
            <li class="active">Registration</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title -->       


  <section id="registration-page" class="container">
    <form class="center" action='' method="POST">
      <fieldset class="registration-form">
        
		
		
		
		
		<div class="control-group">
          <!-- Username -->
          <div class="form-group" id="user_cont">
            <input type="text" id="username" name="username" placeholder="Username" class="form-control" onblur="check_user()">
            <span class="help-block" id="user_error"></span>
          </div>
        </div>

		
		
		
		
		<div class="control-group">
          <!-- Username -->
          <div class="form-group" id="user_cont2">
            <input type="text" id="username2" name="username" placeholder="Username" class="form-control" onblur="check_user2()">
            <span class="help-block" id="user_error2"></span>
          </div>
        </div>
		
          
		  
		  
		  
		  
		<div class="control-group"  >
          <!-- name -->
			<strong>Name</strong>
			<div class="form-group"  id="name_cont">
				<input type="text" id="fname" name="fname" placeholder="First Name"   class="form-control"  onblur="check_fname()">	
				<span class="help-block" id="user_fname"></span>
				<input type="text" id="sname" name="sname" placeholder="Second Name"  class="form-control">
				<input type="text" id="lname" name="lname" placeholder="last Name"    class="form-control">
			</div>
		</div>


				

		
		<div class="control-group">
		  <strong>Nick Name</strong>
          <!-- nick-name -->
          <div class="form-group">
            <input type="text" id="nick_name" name="nick_name" placeholder="Nick Name" class="form-control">
          </div>
        </div>
		

		  
		  
		  

        <div class="control-group">
		  
          <!-- E-mail -->
          <div class="form-group">
		    <p>
			<label for='email' > <strong> E-mail </strong> </label>
            
			<input type="text" id="email" name="email"  placeholder="someone@example.com" class="form-control"  >
          </p>
		  </div>
        </div>

		
		
        <div class="control-group">
          <strong>make password</strong>
		  <!-- Password-->
          <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
          </div>
        </div>

		
		
        
		
		<div class="control-group">
		  <strong>confirm password</strong>
          <!-- Confirm-Password -->
          <div class="form-group">
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Password (Confirm)" class="form-control">
          </div>
        </div>		
		

		
		
		
		<div class="control-group">
		  <strong>Gender</strong>
          <!-- gender -->
          <div class="form-group">
            <input type="radio" id="gender" name="gender" value="male" checked> Male<br>
			<input type="radio" name="gender" value="female"> Female<br> class="form-control">
          </div>
        </div>

		
		
		
		
		<div class="control-group">
		  <strong>Your Phone</strong>
		  <!-- doc-phnoe -->
          <div class="form-group">
            <input type="text" id="doc_phone" name="doc_phone" placeholder="01000000000" class="form-control">
          </div>
        </div>
		


		<div class="control-group">
		  <strong>Your Main specialty</strong>
          <!-- doc-main-specialty -->
          <div class="form-group">
            <input type="text" id="main_speicality" name="main_speicality" placeholder="Main specialty" class="form-control">
          </div>
        </div>		
		
		
		<div class="control-group">
		  <strong>Your Current Degree</strong>
          <!-- degree -->
          <div class="form-group">
            <input type="text" id="degree" name="degree" placeholder="Degree" class="form-control">
          </div>
        </div>
		
		
		
		
		<div class="control-group">
		  <strong>Your Biography if you like</strong>
          <!-- bio -->
          <div class="form-group">
            <input type="text" id="bio" name="bio" placeholder="Your Bio" class="form-control">
          </div>
        </div>		
		
		
		
		

		
		
		
		
		<div class="control-group">
		  <strong>Your address if you like</strong>
          <!-- doc_address -->
          <div class="form-group">
            <input type="text" id="doc_address" name="doc_address" placeholder="Your Address" class="form-control">
          </div>
        </div>		
		
		
		
		
		<div class="control-group">
		  <strong>Your picture</strong>
          <!-- picture -->
          <div class="form-group">
                <input type="file" name="ImageToUpload" id="ImageToUpload"   placeholder="No picture chosen" class="form-control">
          </div>
        </div>		
		
		
		
		
		
		


      
	  
	  

		<div class="control-group">
          <!-- Button -->
          <div class="form-group">
            <button class="btn btn-success btn-large btn-block">Register</button>
          </div>
        </div>
      
	  
	  
	  </fieldset>
    </form>
  </section>
  <!-- /#registration-page -->


    <!--Bottom-->
<section id="bottom" class="main">
    <!--Container-->
    <div class="container">

        <!--row-fluids-->
        <div class="row-fluid">

            <!--Contact Form-->
            <div class="span3">
                <h4>ADDRESS</h4>
                <ul class="unstyled address">
                    <li>
                        <i class="icon-home"></i><strong>Address:</strong> 1032 Wayback Lane, Wantagh<br>NY 11793
                    </li>
                    <li>
                        <i class="icon-envelope"></i>
                        <strong>Email: </strong> support@email.com
                    </li>
                    <li>
                        <i class="icon-globe"></i>
                        <strong>Website:</strong> www.domain.com
                    </li>
                    <li>
                        <i class="icon-phone"></i>
                        <strong>Toll Free:</strong> 631-409-3105
                    </li>
                </ul>
            </div>
            <!--End Contact Form-->

            <!--Important Links-->
            <div id="tweets" class="span3">
                <h4>OUR COMPANY</h4>
                <div>
                    <ul class="arrow">
                        <li><a href="#">About Us</a></li>
                        lhfgjmkklll<li><a href="#">Support</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">We are hiring</a></li>
                        <li><a href="#">Clients</a></li>

                    </ul>
                </div>  
            </div>
            <!--Important Links-->

    </div>
    <!--/row-fluid-->
</div>
<!--/container-->

</section>
<!--/bottom-->

<!--Footer-->
<footer id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span5 cp">
                &copy; 2016. Ekshefle All Rights Reserved.
            </div>
            <!--/Copyright-->

            <div class="span6">
                <ul class="social pull-right">
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class="icon-google-plus"></i></a></li>                       
                </ul>
            </div>

            <div class="span1">
                <a id="gototop" class="gototop pull-right" href="#"><i class="icon-angle-up"></i></a>
            </div>
            <!--/Goto Top-->
        </div>
    </div>
</footer>
<!--  Login form -->
<div class="modal hide fade in" id="loginForm" aria-hidden="false">
    <div class="modal-header">
        <i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
        <h4>Login Form</h4>
    </div>
    <!--Modal Body-->
    <div class="modal-body">
        <form class="form-inline" action="index.html" method="post" id="form-login">
            <input type="text" class="input-small" placeholder="Email">
            <input type="password" class="input-small" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox"> Remember me
            </label>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
        <a href="#">Forgot your password?</a>
    </div>
    <!--/Modal Body-->
</div>
<!--  /Login form -->
<script>
function check_user()
{
	var user= document.getElementById('username').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('user_cont');
		var user_error= document.getElementById('user_error');
		user_cont.className +=' has-error';
		user_error.innerHTML="short username";
	
	}
	
	

}


function check_user2()
{
	var user= document.getElementById('username2').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('user_cont2');
		var user_error= document.getElementById('user_error2');
		user_cont.className +=' has-error';
		user_error.innerHTML="short username2";
	}

}



function check_fname()
{
	var user= document.getElementById('fname').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('name_cont');
		var user_error= document.getElementById('fname_error');
		user_cont.className +=' has-error';
		user_error.innerHTML="short fname";
	}
}

$.ajax()
{
  
}



$.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/nova/check_reg.php",
        data:{doc_email: user},
        success: function(data){alert(data);}
        });





</script>
<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
