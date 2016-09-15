<?php
require_once("private/session.php");
require_once("controlers/location.php");
if(!$loggedin)
    require_once("private/header.html");
else
    require_once("profile/private/header.php");
?>
<section class="title" style="text-align:right; padding:2%;" >
    <h4>
    عن ماذا تبحث؟
    </h4> 
    <div class="nav-tabs-custom pull-right">
      <ul class="nav nav-tabs">
        <li><a data-toggle="tab" class="btn btn-default btn-flat" href="#labs" >معمل تحاليل</a></li>
        <li><a data-toggle="tab" class="btn btn-default btn-flat" href="#hospitals">مستشفي</a></li>
        <li class="active"><a data-toggle="tab" class="btn btn-default btn-flat" href="#clinics">عيادة</a></li>
      </ul>
  </div>
  <br><br>
</section>
<br><br>
<div class="tab-content" dir="rtl">
    <div class="tab-pane" style="height:166px; background:#fff;"></div>

    <div class="tab-pane box box-solid box-success active" id="clinics" style="width:80%; height:%100; margin:auto;">
        <table class="table">
            <tbody>
                <tr>
                    <td Style="text-align:right;">
                        إختر المحافظة حتي تري المراكز والقري المتاحة،<br>
                        ثم إختر المركز أو القرية حتي تري المناطق المتاحة<br>
                    </td>
                </tr>
                <tr>
                    <td>
                        المحافظة
                        <select id="gov" class="select2" onchange="on_gov_select();">
                            <option></option>
                            <?php
                                $result= $db->query("SELECT DISTINCT g.gov_name 
                                                    from governorate as g, area as a, city as c,address as ad
                                                    where ad.area_id=a.area_id
                                                    and a.city_id=c.city_id
                                                    and c.gov_id=g.gov_id");
                                
                                while($row=$result->fetch_assoc())
                                    echo "<option>".$row['gov_name']."</option>";
                            ?>
                        </select>
                    </td>
                    <td>
                        المركز أو القرية
                        <select id="city" class="select2" onchange="on_city_select();" disabled>
                        </select>
                    </td>
                    <td>
                        المنطقة أو المدينة
                        <select id="area" class="select2" disabled>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        التخصص
                        <select id="spec" class="select2">
                            <option></option>
                            <?php
                              $spec_sql="SELECT spec_name from specialty";
                              $spec_result=$db->query($spec_sql);

                              while($spec = $spec_result->fetch_assoc())
                              {
                                echo "<option value='".$spec["spec_name"]."'>".$spec["spec_name"]."</option>";
                              }
                            ?>                            
                        </select>
                    </td>
                    <td>
                        السعر
                        <select id="price" class="select2">
                            <option value="all">الكل</option>
                            <option value="50">أقل من 50</option>
                            <option value="100">أقل من 100</option>
                            <option value="200">أقل من 200</option>
                            <option value="400">أقل من 400</option>
                        </select>
                    </td>
                    <td>
                        اليوم
                        <select id="day" class="select2">
                            <option value="all">الكل</option>
                            <option value="sat">السبت</option>
                            <option value="sun">الأحد</option>
                            <option value="mon">الأثنين</option>
                            <option value="tues">الثلاثاء</option>
                            <option value="wed">الأربعاء</option>
                            <option value="thurs">الخميس</option>
                            <option value="fri">الجمعة</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        نوع الدكتور 
                        <select id="gender" class="select2">
                            <option value="all">الكل</option>
                            <option value="male">ذكر</option>
                            <option value="female">أنثي</option>
                        </select>
                    </td>
                    <td>
                        الدرجة العلمية
                        <select id="degree" class="select2">
                            <option value="all">الكل</option>
                            <option>دكتور إمتياز</option>
                            <option>دكتور نائب</option>
                            <option>مدرس مساعد</option>
                            <option>مدرس) طبيب)</option>
                            <option>أخصائي</option>
                            <option>أستاذ مساعد</option>
                            <option>أستاذ دكتور</option>
                        </select>
                    </td>
                    <td>
                        يمكنك البحث بالأسم
                        <input placeholder="إسم الطبيب" id="doc_name"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td Style="text-align:right;"><span id="error" style="color:red;"></span></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <h4><a class="btn btn-success btn-block" onclick="search_clinics();">إبحث</a></h4>
    </div>

    <div class="tab-pane box box-solid box-success" id="hospitals" style="width:80%; height:%100; margin:auto;">
        <table class="table">
            <tbody>
                <tr>
                    <td Style="text-align:right;">
                        إختر المحافظة حتي تري المراكز والقري المتاحة،<br>
                        ثم إختر المركز أو القرية حتي تري المناطق المتاحة<br>
                    </td>
                </tr>
                <tr>
                    <td>
                        المحافظة
                        <select id="hgov" class="select2" onchange="on_hgov_select();">
                            <option></option>
                            <?php
                                $result= $db->query("SELECT DISTINCT g.gov_name 
                                                    from governorate as g, area as a, city as c,address as ad
                                                    where ad.area_id=a.area_id
                                                    and a.city_id=c.city_id
                                                    and c.gov_id=g.gov_id");
                                
                                while($row=$result->fetch_assoc())
                                    echo "<option>".$row['gov_name']."</option>";
                            ?>
                        </select>
                    </td>
                    <td>
                        المركز أو القرية
                        <select id="hcity" class="select2" onchange="on_hcity_select();" disabled>
                        </select>
                    </td>
                    <td>
                        المنطقة أو المدينة
                        <select id="harea" class="select2" disabled>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        التخصص
                        <select id="hspec" class="select2">
                            <option></option>
                            <?php
                              $spec_sql="SELECT spec_name from specialty";
                              $spec_result=$db->query($spec_sql);

                              while($spec = $spec_result->fetch_assoc())
                              {
                                echo "<option value='".$spec["spec_name"]."'>".$spec["spec_name"]."</option>";
                              }
                            ?>                            
                        </select>
                    </td>
                    <td>
                        السعر
                        <select id="hprice" class="select2">
                            <option value="all">الكل</option>
                            <option value="50">أقل من 50</option>
                            <option value="100">أقل من 100</option>
                            <option value="200">أقل من 200</option>
                            <option value="400">أقل من 400</option>
                        </select>
                    </td>
                    <td>
                        اليوم
                        <select id="hday" class="select2">
                            <option value="all">الكل</option>
                            <option value="sat">السبت</option>
                            <option value="sun">الأحد</option>
                            <option value="mon">الأثنين</option>
                            <option value="tues">الثلاثاء</option>
                            <option value="wed">الأربعاء</option>
                            <option value="thurs">الخميس</option>
                            <option value="fri">الجمعة</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td Style="text-align:right;"><span id="error" style="color:red;"></span></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <h4><a class="btn btn-success btn-block" onclick="search_hospitals();">إبحث</a></h4>
    </div>

    <div class="tab-pane box box-solid box-success" id="labs" style="width:80%; height:%100; margin:auto;">
        <table class="table">
            <tbody>
                <tr>
                    <td Style="text-align:right;">
                        إختر المحافظة حتي تري المراكز والقري المتاحة،<br>
                        ثم إختر المركز أو القرية حتي تري المناطق المتاحة<br>
                    </td>
                </tr>
                <tr>
                    <td>
                        المحافظة
                        <select id="lgov" class="select2" onchange="on_lgov_select();">
                            <option></option>
                            <?php
                                $result= $db->query("SELECT DISTINCT g.gov_name 
                                                    from governorate as g, area as a, city as c,address as ad
                                                    where ad.area_id=a.area_id
                                                    and a.city_id=c.city_id
                                                    and c.gov_id=g.gov_id");
                                
                                while($row=$result->fetch_assoc())
                                    echo "<option>".$row['gov_name']."</option>";
                            ?>
                        </select>
                    </td>
                    <td>
                        المركز أو القرية
                        <select id="lcity" class="select2" onchange="on_lcity_select();" disabled>
                        </select>
                    </td>
                    <td>
                        المنطقة أو المدينة
                        <select id="larea" class="select2" disabled>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        اليوم
                        <select id="lday" class="select2">
                            <option value="all">الكل</option>
                            <option value="sat">السبت</option>
                            <option value="sun">الأحد</option>
                            <option value="mon">الأثنين</option>
                            <option value="tues">الثلاثاء</option>
                            <option value="wed">الأربعاء</option>
                            <option value="thurs">الخميس</option>
                            <option value="fri">الجمعة</option>
                        </select>
                    </td>
                    <td>
                        يمكنك البحث بإسم المعمل
                        <input placeholder="إسم المعمل" id="lab_name"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td Style="text-align:right;"><span id="error" style="color:red;"></span></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <h4><a class="btn btn-success btn-block" onclick="search_labs();">إبحث</a></h4>
    </div>
</div>
<br><br>

<div class="box box-solid box-success" style="width:80%; height:%100; margin:auto;" id="results" dir="rtl" hidden>
</div>
<br><br>
<?php
require_once("private/footer.html");
?>

<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>

<script src="/ekshefle/admin/dist/js/app.min.js"></script>
<script src="admin/plugins/select2/select2.full.min.js"></script>
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<script src="/ekshefle/admin/plugins/pace/pace.min.js"></script>
<script src="js/main.js"></script>
<script src="js/init.js"></script>
<script src="js/search.js"></script>

<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
  $(document).ajaxError(function(event, request, settings) {alert("Can't reach server! check your connection!\n"); });

    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>


</body>
</html>