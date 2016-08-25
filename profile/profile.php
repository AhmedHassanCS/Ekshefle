<?php

require_once("../private/session.php");
require_once("../controlers/doctor.php");
require_once("../controlers/medical.php");
if(!$loggedin)
	header("location: /ekshefle/");

$doc_email=$_SESSION['loggedin_user'];
$doc_id= get_doc_id($doc_email);

require_once("private/header.php");
?>

<div class="containerall">
<div class="profileimg" ><label>
  <?php print "<img src='/ekshefle/images/profile_pics/".$doc_email.".jpg' />"; ?>
</label></div>
<label>
<div class="fullname" >
<?php echo get_doc_fname($doc_email)." ".get_doc_sname($doc_email)." ".get_doc_lname($doc_email); ?>
</div></label>

<div class="box box-success personalinfo" >
<ul>
<li><?php echo get_degree($doc_email);?><i class="fa fa-user-md" aria-hidden="true"></i></li>
<li><?php echo get_spec($doc_email);?><i class="fa fa-stethoscope" aria-hidden="true"></i></li>
<li><?php echo get_doc_address($doc_email);?><i class="fa fa-home" aria-hidden="true"></i></li>
<li> <?php echo get_doc_phone($doc_email);?><i class="fa fa-phone" aria-hidden="true"></i></li>
<li> <?php echo $doc_email;?> <i class="fa fa-envelope" aria-hidden="true"></i></li>
</ul>
</div>
<div id="meds" class="box box-primary meds">
<div class="col-md-6">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class=""><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">عيادات</a></li>
              <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">مستشفيات</a></li>
              <li class="active"><a href="#tab_3-2" data-toggle="tab" aria-expanded="true">معامل</a></li>
        
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1-1">
      			   <?php
                if(is_active($doc_email,'Clinic')){
                  $arrr=get_clinics($doc_email);
                  for($i=0;$i<count($arrr);$i++) 
                  {
                      echo "<b>".get_med_name($arrr[$i])."</b><br>";
                      echo"<p> "; print_r (get_med_location($arrr[$i])); echo "<br></p>";
                      $sp=get_med_side_spec_price($arrr[$i]);
                      echo"<p> ".$sp["side_spec"]. "<br></p>";
                      echo"<p> ".$sp["price"]. "<br></p><hr>";
                    
                  }
                }
               ?>
              </div>
              <div class="tab-pane" id="tab_2-2">
              </div>
              <div class="tab-pane active" id="tab_3-2">
              </div>
            </div>
          </div>
        </div>
</div>
</div>

<?php
/* print '<div id="siding">';
require_once("/private/sidebar.php");
print'</div>'; */
?>

<?php
require_once("../private/footer.html");
?>
<style>
.personalinfo{
width:30%; float:right; background-color:white; overflow:hidden; text-align:right;
border-radius:5px;
font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
font-weight: 400;
font-size:16px;
font-weight:bold;
padding:2%;
}

.personalinfo i{margin-left:16px;}

.personalinfo li{list-style:none; margin-top:3px;}

.meds{ 
padding:2%;
float:right;
border-radius:5px;
text-align:right;
width:55%;
margin-right:5%;
background-color:white;
overflow:hidden;
}

.containerall{width:80%;
overflow:hidden;
padding:5%;
margin:20px auto;
border-radius:10px;}

.profileimg{
margin:5px auto;
width:10%;	
border: 3px solid #d2d6de;
border-radius:50%;
overflow:hidden;
height:100px;
}

.fullname:hover{color:#ff0000;}

.fullname{ font-size:30px;
color:#12ac12;
text-align:center;
padding:10px 10px;
overflow:hidden;
margin:10px auto;
}
</style>
</body>
<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>
<script src="/ekshefle/admin/dist/js/app.min.js"></script>

</html>