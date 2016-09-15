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
  <a  href="choose_pic.php" class="profileimg">
    <?php 
    
    $file_jpg=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$doc_email.'.jpg';
    $file_png=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$doc_email.'.png';

    if(file_exists($file_jpg))
      echo '<img  src="/ekshefle/images/profile_pics/'.$doc_email.'.jpg" 
       data-target="#view_full_img" onmouseover="hover(this);" onmouseout="unhover(this)">';
    elseif(file_exists($file_png))
      echo '<img src="/ekshefle/images/profile_pics/'.$doc_email.'.png"
       data-target="#view_full_img" onmouseover="hover(this);" onmouseout="unhover(this)">';
    else
      echo '<img src="/ekshefle/images/profile_pics/default.png"
       data-target="#view_full_img" onmouseover="hover(this);" onmouseout="unhover(this)">';
 

    //onmouseover="hover(this);" onmouseout="unhover(this)" />"; 
    ?></a>

  <div class="fullname" >
    <p id="name"><?php echo get_doc_fname($doc_email)." ".get_doc_sname($doc_email)." ".get_doc_lname($doc_email); ?></p>
    <button class="btn btn-default" id="edit_name" type="button" onclick="edit_name();">Edit Name</button>
    <div class="input-group" id="name_btns" hidden>
      <span id="name_error" style="color:red;"></span>
      <br>
      <button class="btn btn-warning" id="save_name" type="button" onclick="save_name();" >Save</button>
      <button class="btn btn-danger" id="cancel_name" type="button" onclick="cancel_name();" >Cancel</button>
    </div>
  </div>


  <div class="box box-success info-center" >
    <ul>

      <li>
        <button class="btn btn-default" id="edit_degree" type="button" onclick="edit_degree();">Edit Degree</button>
        <b id="degree"><?php echo get_degree($doc_email);?></b>
        <span id="degree_cont" hidden>
          <select id="degree_lst" class="form-control select2">
              <option></option>
              <option>دكتور إمتياز</option>
              <option>دكتور نائب</option>
              <option>مدرس مساعد</option>
              <option>مدرس) طبيب)</option>
              <option>أخصائي</option>
              <option>أستاذ مساعد</option>
              <option>أستاذ دكتور</option>
          </select>
        </span>
        <i class="fa fa-user-md" aria-hidden="true"></i>
        <div id="degree_btns" hidden>
          <span id="degree_error" style="color:red;"></span>
          <br>
          <button class="btn btn-warning" id="save_degree" type="button" onclick="save_degree();" >Save</button>
          <button class="btn btn-danger" id="cancel_degree" type="button" onclick="cancel_degree();" >Cancel</button>
        </div>
      </li><br>

      <li>
        <button class="btn btn-default" id="edit_spec" type="button" onclick="edit_spec();">Edit Sepcialty</button>
        <b id="spec"><?php echo get_spec($doc_email);?></b>
        <span id="spec_cont" hidden>
          <select class="select2" id="spec_lst">
            <?php
              $spec_sql="SELECT spec_name, spec_id from specialty";
              $spec_result=$db->query($spec_sql);

              $doc_email=$_SESSION['loggedin_user'];
              $get_doc_spec=$db->query("SELECT spec_id from doctor where doc_email='$doc_email'");
              $doc=$get_doc_spec->fetch_assoc();
              $doc_spec=$doc['spec_id'];
              while($spec = $spec_result->fetch_assoc())
              {
                if($spec["spec_id"]!=$doc_spec)
                echo "<option value='".$spec["spec_id"]."'>".$spec["spec_name"]."</option>";
                else echo "<option value='".$spec["spec_id"]."' selected>".$spec["spec_name"]."</option>";
              }
            ?>
          </select>
        </span>
        <i class="fa fa-stethoscope" aria-hidden="true"></i>
        <div id="spec_btns" hidden>
          <span id="spec_error" style="color:red;"></span>
          <br>
          <button class="btn btn-warning" id="save_spec" type="button" onclick="save_spec();" >Save</button>
          <button class="btn btn-danger" id="cancel_spec" type="button" onclick="cancel_spec();" >Cancel</button>
        </div>
      </li><br>
      <li>
        <button class="btn btn-default" id="edit_address" type="button" onclick="edit_address();">Edit Address</button>
        <b id="address"><?php echo get_doc_address($doc_email);?></b><i class="fa fa-home" aria-hidden="true"></i>
        <div id="address_btns" hidden>
          <span id="address_error" style="color:red;"></span>
          <br>
          <button class="btn btn-warning" id="save_address" type="button" onclick="save_address();" >Save</button>
          <button class="btn btn-danger" id="cancel_address" type="button" onclick="cancel_address();" >Cancel</button>
        </div>
      </li><br>
      <li> 
        <button class="btn btn-default" id="edit_phone" type="button" onclick="edit_phone();">Edit Phone</button>
        <b id="phone"><?php echo get_doc_phone($doc_email);?></b><i class="fa fa-phone" aria-hidden="true"></i>
        <div id="phone_btns" hidden>
          <span id="phone_error" style="color:red;"></span>
          <br>
          <button class="btn btn-warning" id="save_phone" type="button" onclick="save_phone();" >Save</button>
          <button class="btn btn-danger" id="cancel_phone" type="button" onclick="cancel_phone();" >Cancel</button>
        </div>
      </li><br>
      <li>
        <button class="btn btn-default" id="edit_email" type="button" onclick="edit_email();">Edit Email</button>
        <b id="email"><?php echo $doc_email;?></b><i class="fa fa-envelope" aria-hidden="true"></i>
        <div id="email_btns" hidden>
          <span id="email_error" style="color:red;"></span>
          <br>
          <button class="btn btn-warning" id="save_email" type="button" onclick="save_email();" >Save</button>
          <button class="btn btn-danger" id="cancel_email" type="button" onclick="cancel_email();" >Cancel</button>
        </div>
      </li><br>
    </ul>
  </div>

</div>

<?php
require_once("../private/footer.html");
?>

<link rel="stylesheet" href="/ekshefle/css/profile.css">
</body>
<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>
<script src="/ekshefle/js/edit_prof.js"></script>

<script src="/ekshefle/admin/dist/js/app.min.js"></script>
<script src="/ekshefle/admin/plugins/select2/select2.full.min.js"></script>
<script src="/ekshefle/js/init.js"></script>

<script>
function hover(element) {
    element.setAttribute('src', '/ekshefle/images/profile_pics/change.png');
};
function unhover(element) {
    element.setAttribute('src', '<?php echo '/ekshefle/images/profile_pics/'.$doc_email.'.jpg'; ?>');
};
</script>

</html>