<?php
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
        <h3>Registration Form</h3>
      </div>

      <div class="box-body">

        <!--Email-->
        <div class="form-group">
          <h4>Email</h4>
          <input type="email" id="email" class="form-control" required="required" placeholder="someone@example.com">
        </div>
        <br>

        <!--Name-->
        <div class="form-group">
          <h4>Name</h4>
          <input type="text" id="fname" class="form-control" pattern="[ء-ي ]*" required="required" placeholder="First Name">
          <input type="text" id="sname" class="form-control" pattern="[ء-ي ]*" required="required" placeholder="Middle Name">
          <input type="text" id="lname"class="form-control" pattern="[ء-ي ]*" required="required" placeholder="Last Name">
        </div>
        <br>

        <!--Nickname-->
        <div class="form-group">
          <h4>Nickname (Optional)</h4>
          <input type="text" id="nickname" class="form-control" pattern="[ء-ي ]*" placeholder="Nickname">
        </div>
        <br>

        <!--Password-->
        <div class="form-group">
          <h4>Choose Password</h4>
          <input type="password" id="pw" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
          <input type="password" id="pw_confirm" class="form-control" placeholder="Repeat Password">
        </div>
        <br>

        <!--Gender-->
        <div class="form-group">
          <h4>Gender</h4>
          <label><input type="radio" id="gender_m" name="gender" class="flat-red" value="male" checked>Male<br></label>
          <label><input type="radio" id="gender_f" name="gender" class="flat-red" value="female">Female</label>
        </div>
        <br>

        <!--Degree-->
        <div class="form-group">
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
        </div>
        <br>

        <!--Specialty This will be edited to bring specialties from db-->
        <div class="form-group">
          <h4>Main Specialty</h4>
          <select id="spec" class="form-control select2">
            <option></option>
            <option>أطفال</option>
            <option>نساء وتوليد</option>
            <option>عظام</option>
            <option>مخ و أعصاب</option>
            <option>أنف وإذن وحنجرة</option>
            <option>رمد</option>
            <option>أسنان</option>
            <option>باطنة</option>
            <option>أورام</option>
            <option>جلدية</option>
            <option>نفسية وعصبية</option>
            <option>قلب</option>
            <option>أوعية دموية</option>
            <option>جراحة عامة</option>
            <option>جراحة أورام</option>
            <option>جراحة عمود فقري</option>
            <option>علاج طبيعي</option>
          </select>
        </div>
        <br>

        <!--Phone-->
        <div class="form-group">
          <h4>Private Phone Number</h4>
          <input type="text" id="phone" class="form-control" placeholder="01.............">
        </div>
        <br>

        <!--Address-->
        <div class="form-group">
          <h4>Home Address (In Arabic)</h4>
          <input type="text" id="address" class="form-control" placeholder="المحافظة - المركز أو القرية - المنطقة - الشارع - رقم المنزل" style="width:37%;">
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
<script>
function submit()
{

    var x= $("#side_spec").val();

    var side="";
    
    if(x!=null){
    side=x[0];
    for(var i=1;i<x.length;i++)
      side+=","+x[i];
    }

    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/check_reg.php",
        data:{doc_email: document.getElementById("email").value,
              doc_fname: document.getElementById("fname").value,
              doc_sname: document.getElementById("sname").value,
              doc_lname: document.getElementById("lname").value,
              doc_nick: document.getElementById("nickname").value,
              doc_pw: document.getElementById("pw").value,
              doc_pw_confirm: document.getElementById("pw_confirm").value,
              gender: gender,
              degree: document.getElementById("degree").value,
              doc_phone: document.getElementById("phone").value,
              birth_date: "1994-10-19",
              doc_address: document.getElementById("address").value,
              bio: document.getElementById("bio").value,
              side_spec:side,
              specialty :document.getElementById("spec").value
              },
        success: function(data){
                  if(data!="1")
                    alert(data);
                  else window.open("http://localhost/ekshefle/profile/","_self");
                }
        });
}
</script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="admin/plugins/select2/select2.full.min.js"></script>
<script src="admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script src="js/main.js"></script>
<script src="js/select-init.js"></script>

</body>
</html>
