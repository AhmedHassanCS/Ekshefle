<?php
require_once("db/config.php");
require_once("controlers/location.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");

elseif(!isset($_POST["gov_name"])||empty($_POST["gov_name"]))
    exit("<h3>يجب إختيار المحافظة والتخصص علي الأقل.</h3>");

else
{
    $gov_name=mysqli_real_escape_string($db,$_POST["gov_name"]);
    $city_name=mysqli_real_escape_string($db,$_POST["city_name"]);
    $area_name=mysqli_real_escape_string($db,$_POST["area_name"]);
    $lab_name=mysqli_real_escape_string($db,$_POST["lab_name"]);
    $day=mysqli_real_escape_string($db,$_POST["day"]);


    $spec_part="";
    $loc_part="";
    $name_part="";
    $day_part="";

    if($area_name!="all" && !empty($area_name))
    {
        $area_id=get_area_id($gov_name,$city_name,$area_name); 
        $loc_part="SELECT med_id from address where area_id=$area_id";
    }
    elseif($city_name!="all")
    {
        $city_id=get_city_id($gov_name,$city_name);
        $loc_part="SELECT DISTINCT addr.med_id from address as addr, city as c, area as a
                    where c.city_id=$city_id
                    and a.city_id=c.city_id
                    and addr.area_id=a.area_id";
    }
    else
        $loc_part="SELECT DISTINCT addr.med_id from address as addr, city as c, area as a,governorate as g
                    where g.gov_name='$gov_name'
                    and g.gov_id=c.gov_id
                    and a.city_id=c.city_id
                    and addr.area_id=a.area_id";

    if($lab_name!="" && !empty($lab_name))
        $name_part="SELECT DISTINCT loc.med_id from ($loc_part) as loc,medical as m 
                    where loc.med_id=m.med_id
                    and m.med_name like '%$lab_name%'";
    else $name_part = $loc_part;

    if($day!="all")
        $day_part="SELECT DISTINCT p.med_id from ($name_part) as p,lab_days as d
                    where p.med_id=d.med_id
                    and d.aval_days like '%$day%'";
    else $day_part = $name_part;


    $sql_stat="SELECT DISTINCT * from ($day_part) as d ,medical as m,
            address as ad, area as a, city as c, governorate as gov ,lab_days as ld
                where m.med_id=d.med_id
                and ld.med_id=d.med_id
                and m.med_type='Lab'
                and ad.med_id=m.med_id
                and a.area_id=ad.area_id
                and c.city_id=a.city_id
                and gov.gov_id=c.gov_id";

    $results=$db->query($sql_stat);
    $doc_groups=array();

    $html="";
    if(!$results)
        echo $sql_stat."<br>".$db->error;
    else{
        if(mysqli_num_rows($results)==0)
            exit("لا يوجد نتائج");

        $html=$html."<table class='table-bordered' dir='rtl'><tbody>";
        while ($med=$results->fetch_assoc()) 
        {
            $docsql=$db->query("SELECT d.doc_email
                                from doctor as d
                                where d.doc_id=".$med["doc_id"]);
            $doc=$docsql->fetch_assoc();
            $html=$html."<tr>";
            $html=$html."<td style='text-align:center; width:25%; padding:3%; border:1px solid green;'>";

            $html=$html."<br><h3>".$med["med_name"]."</h3>";
            $html=$html."<br><b>".$med["gov_name"];
            $html=$html." ".$med["city_name"];
            $html=$html." ".$med["area_name"]."</b>";

            $html=$html."<br><label><a href='/ekshefle/profile/profile.php?doc_email=".$doc["doc_email"]."'>إعرض ملف الدكتور المالك</a></label>";
            $html=$html."</td>";
            
            $html=$html."<td style='padding:3%;'>";
            $html=$html."<br><b>الأيام المتاحة: </b>";
            $days_str=$med["aval_days"];
            $days=json_decode($days_str);
            echo $html;
            $html="";
            ?>
            <table class="table-bordered" dir="rtl">
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
            <?php
        }
        $html=$html."</tbody></table>";
        echo $html;
    }
}
?>