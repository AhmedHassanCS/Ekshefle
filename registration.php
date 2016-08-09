<?php
require_once('db/config.php');
require_once("header.html");
?>

  <!-- /#registration-page -->
<section class="title">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h1>Registration</h1>
        </div>
      </div>
    </div>
</section>

<section id="registration-page" class="container">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3>Registration Form<br><small>This is your personal data, after registeration you'll be abl to add clinics, hospitals or labs and you will be able to publish them.</small></h3>
      </div>

      <div class="box-body">

        <!--Email-->
        <div class="form-group"  id="email_cont">
          <h4>Email</h4>
          <input type="email" id="email" class="form-control" required="required" placeholder="someone@example.com" onblur="check_email();">
          <span class="help-block" id="email_error"></span>
        </div>
        <br>

        <!--Name-->
        <div class="form-group">
          <h4>Name بالعربي</h4>
          <div class="form-group" id="fname_cont">
            <input type="text" id="fname" class="form-control" pattern="[ء-ي ]*" required="required" placeholder="First Name" onblur="check_fname();">
            <span class="help-block" id="fname_error"></span>
          </div>
          <div class="form-group" id="sname_cont">
            <input type="text" id="sname" class="form-control" pattern="[ء-ي ]*" required="required" placeholder="Middle Name" onblur="check_sname();">
            <span class="help-block" id="sname_error"></span>
          </div>
          <div class="form-group" id="lname_cont">
            <input type="text" id="lname"class="form-control" pattern="[ء-ي ]*" required="required" placeholder="Last Name" onblur="check_lname();">
            <span class="help-block" id="lname_error"></span>
          </div>
        </div>
        <br>

        <!--Nickname-->
        <div class="form-group">
          <h4>Nickname (Optional)بالعربي</h4>
          <input type="text" id="nickname" class="form-control" pattern="[ء-ي ]*" placeholder="Nickname">
        </div>
        <br>

        <!--Password-->
        <div class="form-group">
          <h4>Choose Password</h4>
          <div class="form-group"  id="pw_cont">
            <input type="password" id="pw" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  onblur="check_pw(); check_cpw();">
            <span class="help-block" id="pw_error"></span>
          </div>
          <div class="form-group"  id="cpw_cont">
            <input type="password" id="pw_confirm" class="form-control" placeholder="Repeat Password" onblur="check_cpw();">
            <span class="help-block" id="cpw_error"></span>
          </div>
        </div>
        <br>

        <!--Gender-->
        <div class="form-group" id="gender">
          <h4>Gender</h4>
          <label><input type="radio" id="gender_m" name="gender" class="flat-red" value="male" checked>Male<br></label>
          <label><input type="radio" id="gender_f" name="gender" class="flat-red" value="female">Female</label>
          <span class="help-block" id="gender_error"></span>
        </div>
        <br>

        <!--birthdate-->
        <div class="form-group" id="birth_cont">
          <h4>Birth-Date:</h4>
          <div class="input-group date">
            <input type="text" class="form-control" id="datepicker" onblur="check_birthdate()" onchange="check_birthdate()">
            <span class="help-block" id="birth_error"></span>
          </div>
        </div>

        <!--Degree-->
        <div class="form-group"  id="deg">
          <h4>Current Degree</h4>
          <select id="degree" class="form-control select2">
              <option></option>
              <option>دكتور إمتياز</option>
              <option>دكتور نائب</option>
              <option>مدرس مساعد</option>
              <option>مدرس) طبيب)</option>
              <option>أخصائي</option>
              <option>أستاذ مساعد</option>
              <option>أستاذ دكتور</option>
          </select>
          <span class="help-block" id="deg_error"></span>
        </div>
        <br>

        <!--Specialty This will be edited to bring specialties from db-->
        <div class="form-group" id="specialty">
          <h4>Main Specialty</h4>
          <select id="spec" class="form-control select2">
            <option></option>
            <?php
            $spec_sql="SELECT spec_name from specialty";
            $spec_result=$db->query($spec_sql);
            while($spec = $spec_result->fetch_assoc())
            {
              echo "<option>".$spec["spec_name"]."</option>";
            }
            ?>
          </select>
          <span class="help-block" id="spec_error"></span>
        </div>
        <br>

        <!--Phone-->
        <div class="form-group" id="ph_cont">
          <h4>Private Phone Number</h4>
          <input type="text" id="phone" class="form-control" placeholder="01.............">
          <span class="help-block" id="ph_error"></span>
        </div>
        <br>

        <!--Address-->
        <div class="form-group" id="address_cont">
          <h4>Home Address بالعربي</h4>
          <input type="text" id="address" class="form-control" placeholder="المحافظة - المركز أو القرية - المنطقة - الشارع - رقم المنزل" style="width:37%;" onblur("check_address();")>
          <span class="help-block" id="address_error"></span>
        </div>
        <br>


        <!--Side Specialties-->
        <div class="form-group">
            <h4>Side Specialties (Optional)</h4>
            <select class="select2" id="side_spec" multiple="multiple" data-placeholder="Select specialty" style="width: 40%;">
              <option>Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
        </div>
        <br>

        <!--Bio-->
        <div class="form-group">
          <h4>Bio (Optional)</h4>
          <textarea rows="4" id="bio" style="width: 37%;"></textarea>
        </div>
        <br>

        <!-- Button -->
        <div class="form-group">
          <button class="btn btn-success btn-large" onclick="submit();">Register</button>
        </div>
    </div>
  </div>
</section>

<?php
require_once("footer.html");
?>

<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="admin/plugins/select2/select2.full.min.js"></script>
<script src="admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script src="js/main.js"></script>
<script src="js/init.js"></script>
<script src="js/reg_validations.js"></script>

</body>
</html>
