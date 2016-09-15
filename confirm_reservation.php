<?php
require_once("private/session.php");
require_once("controlers/location.php");
require_once("controlers/medical.php");

if(!$loggedin)
    require_once("private/header.html");
else
    require_once("profile/private/header.php");

if(!isset($_GET["med_id"])||!isset($_GET["med_type"])||!isset($_GET["spec_id"]))
    header("location: /ekshefle/");
else 
{
    require_once("db/config.php");
    $med_id=mysqli_real_escape_string($db,$_GET["med_id"]);
    $spec_id=mysqli_real_escape_string($db,$_GET["spec_id"]);
    $med_type=mysqli_real_escape_string($db,$_GET["med_type"]);
    $days_str=get_days($med_id,$spec_id);
    $days=json_decode($days_str);
}
?>
<!--patient info-->
<div id="add_patient" class="modal fade" style="display: none; background:#fff; width:50%;"> 
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <div class="modal-header">  
          <a class="close" data-dismiss="modal">×</a>  
          <h3>إدخل معلوماتك</h3>  
      </div>  

      <div class="modal-body">
        <div class="form-group" id="name_cont">
            <input type="text" placeholder="إسم المريض كاملاً" id="name"/>
        </div>
        <div class="form-group" id="phone_cont">
            <input type="text" placeholder="رقم التيليفون المحمول" id="phone"/>
        </div>
        <div class="form-group" id="address_cont">
            <input type="text" placeholder="العنوان" id="address"/>
        </div>
        <div class="form-group" id="email_cont">
            <input type="text" placeholder="البريد الإلكتروني" id="email"/>
        </div>
        <span id="serror" style="color:red;"></span>
      </div> 

      <div class="modal-footer"> 
        <input type="submit"  class="btn btn-success" value="تأكيد الحجز" onclick="add_patient();"/>  
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>          
  </div>                          
</div>
<!--/patient info-->
<section class="title" style="text-align:right; padding:2%;">
    <h3>
        حدد المعاد المراد وأدخل المعلومات المطلوبة عنك
    </h3> 
    إذا حجزت مسبقاً بنفس رقم البطاقة لن نطلب معلومات عنك ثانية
</section>
<div style="margin:2%;" dir="rtl">
    <div class="form-group" id="id_cont">
        <input type="text" id="pat_id" placeholder="رقم البطاقة (الرقم القومي)" onblur="validate_pat_id();"/>
    </div>
    <div class="form-group" id="date_cont">
        <input type="text" placeholder="إختر يوم الكشف" id="datepicker" onchange="validate_date();"/>
    </div>

    <span id="ferror" style="color:red;"></span><br>
    <button class="btn btn-success" onclick="patient_exist();">إحجز</button><br><br>
    <h3>جدول المواعيد</h3>
    <table class="table-bordered" dir="rtl" style="width:20%;">
        <tbody>
            <tr>
                <td><b>اليوم</b></td>
                <?php
                if(isset($days->{"sat"}))
                {
                    echo "<td>السبت</td>";
                    $sat=$days->{"sat"};
                }
                if(isset($days->{"sun"}))
                {
                    echo "<td>الأحد</td>";
                    $sun=$days->{"sun"};
                }
                if(isset($days->{"mon"}))
                {
                    echo "<td>الأثنين</td>";
                    $mon=$days->{"mon"};
                }
                if(isset($days->{"tues"}))
                {
                    echo "<td>الثلاثاء</td>";
                    $tues=$days->{"tues"};
                }
                if(isset($days->{"wed"}))
                {
                    echo "<td>الأربعاء</td>";
                    $wed=$days->{"wed"};
                }
                if(isset($days->{"thurs"}))
                {
                    echo "<td>الخميس</td>";
                    $thurs=$days->{"thurs"};
                }
                if(isset($days->{"fri"}))
                {
                    echo "<td>الجمعة</td>";
                    $fri=$days->{"fri"};
                }
                ?>
            </tr>
            <tr>
                <td><b>من</b></td>
                <?php
                if(isset($sat))
                    echo "<td>".$sat->{"from"}."</td>";
                if(isset($sun))
                    echo "<td>".$sun->{"from"}."</td>";
                if(isset($mon))
                    echo "<td>".$mon->{"from"}."</td>";
                if(isset($tues))
                    echo "<td>".$tues->{"from"}."</td>";
                if(isset($wed))
                    echo "<td>".$wed->{"from"}."</td>";
                if(isset($thurs))
                    echo "<td>".$thurs->{"from"}."</td>";
                if(isset($fri))
                    echo "<td>".$fri->{"from"}."</td>";
                ?>
            </tr>
            <tr>
                <td><b>إلي</b></td>
                <?php
                if(isset($sat))
                    echo "<td>".$sat->{"to"}."</td>";
                if(isset($sun))
                    echo "<td>".$sun->{"to"}."</td>";
                if(isset($mon))
                    echo "<td>".$mon->{"to"}."</td>";
                if(isset($tues))
                    echo "<td>".$tues->{"to"}."</td>";
                if(isset($wed))
                    echo "<td>".$wed->{"to"}."</td>";
                if(isset($thurs))
                    echo "<td>".$thurs->{"to"}."</td>";
                if(isset($fri))
                    echo "<td>".$fri->{"to"}."</td>";
                ?>
            </tr>
        </tbody>
    </table>
</div>
<?php
require_once("private/footer.html");
?>
<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/reserve.js"></script>
<script src="/ekshefle/admin/dist/js/app.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
var med_id=<?php echo $med_id;?>;
var spec_id=<?php echo $spec_id;?>;
var days= <?php echo "'".get_days($med_id,$spec_id)."'"; ?> ;

var aval=[];
if(days.indexOf("sun")!=-1)
    aval.push(0);
if(days.indexOf("mon")!=-1)
    aval.push(1);
if(days.indexOf("tues")!=-1)
    aval.push(2);
if(days.indexOf("wed")!=-1)
    aval.push(3);
if(days.indexOf("thurs")!=-1)
    aval.push(4);
if(days.indexOf("fri")!=-1)
    aval.push(5);
if(days.indexOf("sat")!=-1)
    aval.push(6);

$('#datepicker').datepicker({
    beforeShowDay: function(date) {
        var day = date.getDay();
        return [(aval.indexOf(day) != -1), ''];
    },
    dateFormat: "mm-dd-yy", 
    minDate: 0
});                    
</script>