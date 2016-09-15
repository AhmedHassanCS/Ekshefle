<?php

require_once("../private/session.php");
require_once("../controlers/doctor.php");
require_once("../controlers/medical.php");

if(!isset($_GET['doc_email']))
  header("location: /ekshefle/");
if($loggedin)
  require_once("private/header.php");
else require_once("../private/header.html");  
$doc_email=mysqli_real_escape_string($db,$_GET['doc_email']);
$doc_id= get_doc_id($doc_email);


?>

<div class="containerall">

  <?php 
    $file_jpg=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$doc_email.'.jpg';
    $file_png=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$doc_email.'.png';

    if(file_exists($file_jpg))
      echo '<img class="profileimg" src="/ekshefle/images/profile_pics/'.$doc_email.'.jpg" data-toggle="modal" data-target="#view_full_img">';
    elseif(file_exists($file_png))
      echo '<img class="profileimg" src="/ekshefle/images/profile_pics/'.$doc_email.'.png" data-toggle="modal" data-target="#view_full_img">';
    else
      echo '<img class="profileimg" src="/ekshefle/images/profile_pics/default.png" data-toggle="modal" data-target="#view_full_img">';

  ?>
<div class="fullname" >
<?php echo get_doc_fname($doc_email)." ".get_doc_sname($doc_email)." ".get_doc_lname($doc_email); ?>
</div>


<div class="box box-success personalinfo" >
<ul>
<li><?php echo get_degree($doc_email);?><i class="fa fa-user-md" aria-hidden="true"></i></li>
<li><?php echo get_spec($doc_email);?><i class="fa fa-stethoscope" aria-hidden="true"></i></li>
<li> <?php echo get_doc_address($doc_email);?><i class="fa fa-home" aria-hidden="true"></i></li>
<li> <?php echo get_doc_phone($doc_email);?><i class="fa fa-phone" aria-hidden="true"></i></li>
<li> <?php echo $doc_email;?> <i class="fa fa-envelope" aria-hidden="true"></i></li>
</ul>
</div>
<div id="meds" class="box box-success meds">
<div class="col-md-6">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">عيادات</a></li>
              <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">مستشفيات</a></li>        
            </ul>

            <div class="tab-content" style="width:100%">
              <div class="tab-pane active" id="tab_1-1">

                  <?php
                  $clinic_query= $db->query("SELECT med_id from medical 
                              where doc_id=$doc_id
                              and med_type='Clinic'
                              and is_active=1");
                    while($clinic_db=$clinic_query->fetch_assoc()){
                      echo '<table class="table box box-solid box-primary"><tbody><tr><td style="float:left; text-align:right;">';
                      $clinic=get_clinic($clinic_db['med_id']);
                      $days=json_decode($clinic["aval_days"]);
                      echo "<table class='table bordered-table text-center'>
                                <thead>
                                  <th>إلي</th>
                                  <th>من</th>
                                  <th>اليوم</th>
                                </thead>
                                <tbody>";
                      $sat=$days->{"sat"};
                      if(isset($sat))
                        echo "<tr><td>".$sat->{"to"}."</td>"."<td>".$sat->{"from"}."</td>"."<td>السبت</td></tr>";
                      echo "</tbody></table>";
                      echo "</td><td style='float:right; text-align:right;'>";

                      echo "<b>".$clinic['med_name']."<br></b>";
                      echo "<b>".$clinic['gov_name']."<br></b>";
                      echo "<b>".$clinic['city_name']."<br></b>";
                      echo "<b>".$clinic['area_name']."<br></b>";
                      echo "<b>".$clinic["side_spec"]. "<br></b>";
                      echo "<b>".$clinic["price"]. "<br></b>";

                      echo "</td></tr></tbody></table>";
                    }                  
                  ?>
                </div>

              <div class="tab-pane" id="tab_2-2">
                
                  <!--hospitals as tab-->
                    <?php
                      $hos_query= $db->query("SELECT med_id from medical 
                                where doc_id=$doc_id
                                and med_type='Hospital'
                                and is_active=1");
                      //$li_html='<ul class="nav nav-tabs pull-right">';
                      $content_html='<div class="box-group" id="accordion">';

                      while($hos_db=$hos_query->fetch_assoc())
                      {

                        $hospital=get_hospital($hos_db['med_id']);
                        $total_spec_arr=$hospital["total_spec"];
                        $content_html=$content_html.
                        '<div class="panel box box-primary">'.
                          '<div class="box-header with-border">
                            <h4 class="box-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#hos'.$hos_db['med_id'].'">'.
                              $hospital['med_name'].
                              '</a>
                            </h4>
                          </div>'.
                          '<div id="#hos'.$hos_db['med_id'].'" class="panel-collapse collapse in">
                            <div class="box-body">'.
                              "<b>".$hospital['med_name']."<br></b>".
                              "<b>".$hospital['gov_name']." </b>".
                              "<b>".$hospital['city_name']." </b>".
                              "<b>".$hospital['area_name']." </b>"; 
                          foreach ($total_spec_arr as $spec) {
                            $content_html=$content_html.'<table class="table box box-solid box-primary"><tbody><tr><td style="float:left; text-align:right;">';
                            $days=json_decode($spec["aval_days"],true);
                            $content_html=$content_html."<table class='table bordered-table text-center'>
                                      <thead>
                                        <th>إلي</th>
                                        <th>من</th>
                                        <th>اليوم</th>
                                      </thead>
                                      <tbody>";
                            /*$sat=$days->{"sat"};
                            $sun=$days->{"sun"};
                            $mon=$days->{"mon"};
                            $tues=$days->{"tues"};
                            $wed=$days->{"wed"};
                            $thurs=$days->{"thurs"};
                            $fri=$days->{"fri"};*/

                            if(isset($days['sat'])){
                              $sat=$days['sat'];
                              $content_html=$content_html."<tr><td>".$sat["to"]."</td>"."<td>".$sat["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            if(isset($days['sun'])){
                              $sun=$days['sun'];
                              $content_html=$content_html."<tr><td>".$sun["to"]."</td>"."<td>".$sun["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            if(isset($days['mon'])){
                              $mon=$days['mon'];
                              $content_html=$content_html."<tr><td>".$mon["to"]."</td>"."<td>".$mon["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            if(isset($days['tues'])){
                              $tues=$days['tues'];
                              $content_html=$content_html."<tr><td>".$tues["to"]."</td>"."<td>".$tues["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            if(isset($days['wed'])){
                              $wed=$days['wed'];
                              $content_html=$content_html."<tr><td>".$wed["to"]."</td>"."<td>".$wed["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            if(isset($days['thurs'])){
                              $thurs=$days['thurs'];
                              $content_html=$content_html."<tr><td>".$thurs["to"]."</td>"."<td>".$thurs["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            if(isset($days['fri'])){
                              $fri=$days['fri'];
                              $content_html=$content_html."<tr><td>".$fri["to"]."</td>"."<td>".$fri["from"]."</td>"."<td>السبت</td></tr>";
                            }
                            $content_html=$content_html."</tbody></table>";
                            $content_html=$content_html."</td><td style='float:right; text-align:right;'>";


                            $content_html=$content_html."<b>التخصص : ".$spec['spec_name']."<br></b>";
                            $content_html=$content_html."<b>".$spec["side_spec"]. "<br></b>";
                            $content_html=$content_html."<b>السعر : ".$spec["price"]. "<br></b>";

                            $content_html=$content_html."</td></tr></tbody></table>";
                            
                          }
                        $content_html=$content_html."</div></div></div>";
                      }
                      //$li_html=$li_html.'</ul>';
                      $content_html=$content_html.'</div>';
                      //echo $li_html;
                      echo $content_html;
                    ?>
                  
                  
              </div>
            </div>
          </div>
        </div>
</div>
</div>

<div id="view_full_img" class="modal fade" style="display: none;"> 
  <div class="modal-dialog">
    <div class="modal-content"> 

      <div class="modal-header">  
        <a class="close" data-dismiss="modal" style="color:#fff;">×</a>  
      </div>
      <div class="modal-body">
        <?php
          if(file_exists($file_jpg))
            echo '<img style="display: block; margin-left:auto; margin-right: auto; width:220px; height:auto;"
             src="/ekshefle/images/profile_pics/'.$doc_email.'.jpg">';
          elseif(file_exists($file_png))
            echo '<img style="display: block; margin-left:auto; margin-right: auto; width:220px; height:auto;"
             src="/ekshefle/images/profile_pics/'.$doc_email.'.png">';
          else
            echo '<img style="display: block; margin-left:auto; margin-right: auto; width:220px; height:auto;"
             src="/ekshefle/images/profile_pics/default.png">';
        ?>
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

<link rel="stylesheet" href="/ekshefle/css/profile.css">
</body>

<script>
document.domain = <?php echo '"localhost"'; ?>;
</script>
<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>
<script src="/ekshefle/admin/dist/js/app.min.js"></script>
<script src="/ekshefle/admin/dist/js/demo.js"></script>

</html>