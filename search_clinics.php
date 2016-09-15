<?php
require_once("db/config.php");
require_once("controlers/location.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");

elseif(!isset($_POST["gov_name"])||!isset($_POST["spec_name"])||empty($_POST["gov_name"])||empty($_POST["spec_name"]))
    exit("<h3>يجب إختيار المحافظة والتخصص علي الأقل.</h3>");

else
{
    $gov_name=mysqli_real_escape_string($db,$_POST["gov_name"]);
    $city_name=mysqli_real_escape_string($db,$_POST["city_name"]);
    $area_name=mysqli_real_escape_string($db,$_POST["area_name"]);
    $spec_name=mysqli_real_escape_string($db,$_POST["spec_name"]);
    $price=mysqli_real_escape_string($db,$_POST["price"]);
    $day=mysqli_real_escape_string($db,$_POST["day"]);
    $gender=mysqli_real_escape_string($db,$_POST["gender"]);
    $degree=mysqli_real_escape_string($db,$_POST["degree"]);
    $doc_name=mysqli_real_escape_string($db,$_POST["doc_name"]);

    $spec_part="";
    $loc_part="";
    $price_part="";
    $day_part="";
    $gender_part="";
    $degree_part="";
    $doc_part="";
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

    if($price!="all")
        $price_part="SELECT DISTINCT loc.med_id from ($loc_part) as loc,med_spec as ms 
                    where loc.med_id=ms.med_id
                    and ms.price<=$price";
    else $price_part = $loc_part;

    if($day!="all")
        $day_part="SELECT DISTINCT p.med_id from ($price_part) as p,med_spec as ms 
                    where p.med_id=ms.med_id
                    and ms.aval_days like '%$day%'";
    else $day_part = $price_part;

    if($gender!="all")
        $gender_part="SELECT DISTINCT m.med_id from ($day_part) as day,doctor as d ,medical as m
                    where m.med_id=day.med_id
                    and m.doc_id=d.doc_id
                    and d.gender='$gender'";
    else $gender_part=$day_part;

    if($degree!="all")
        $degree_part="SELECT DISTINCT m.med_id from ($gender_part) as g,doctor as d ,medical as m
                    where m.med_id=g.med_id
                    and m.doc_id=d.doc_id
                    and d.degree='$degree'";
    else $degree_part=$gender_part;

    if(!empty($doc_name) && $doc_name!="")
        $doc_part="SELECT DISTINCT m.med_id from ($degree_part) as deg,doctor as d ,medical as m
                    where m.med_id=deg.med_id
                    and m.doc_id=d.doc_id
                    and CONCAT(d.doc_fname,' ',d.doc_sname,' ',d.doc_lname) like '%$doc_name%'";
    else $doc_part=$degree_part;

    $sql_stat="SELECT DISTINCT * from ($doc_part) as d,med_spec as ms ,medical as m, specialty as s,
            address as ad, area as a, city as c, governorate as gov
                where m.med_id=d.med_id
                and m.med_id=ms.med_id
                and ms.spec_id=s.spec_id
                and s.spec_name='$spec_name'
                and m.med_type='Clinic'
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
            exit("<h4 style='text-align:center;'>لا يوجد نتائج</h4>");
        while ($row=$results->fetch_assoc()) 
        {
            $doc_id=$row['doc_id'];
            if(isset($doc_groups[$doc_id]))
                array_push($doc_groups[$doc_id], $row);
            else $doc_groups[$doc_id]=array($row);
        }

        $html=$html."<table class='table-bordered' dir='rtl'><tbody>";
        foreach ($doc_groups as $doc_id=>$doc_meds)
        {
            $docsql=$db->query("SELECT d.doc_email,d.doc_fname,d.doc_sname,d.doc_lname,d.doc_nick,d.pic_path,d.degree 
                                from doctor as d
                                where d.doc_id=$doc_id");
            $doc=$docsql->fetch_assoc();
            $html=$html."<tr>";
            $html=$html."<td style='text-align:center; width:20%; padding:3%; border:1px solid green;'>";

            //set profile pic
            $file_jpg=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$doc["doc_email"].'.jpg';
            $file_png=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$doc["doc_email"].'.png';
            if(file_exists($file_jpg))
              $html=$html.'<img src="/ekshefle/images/profile_pics/'.$doc["doc_email"].'.jpg">';
            elseif(file_exists($file_png))
              $html=$html.'<img src="/ekshefle/images/profile_pics/'.$doc["doc_email"].'.png">';
            else
              $html=$html.'<img src="/ekshefle/images/profile_pics/default.png">';
            //profile pic end 

            $html=$html."<br>".$doc["degree"];
            $html=$html."<br><h4>".$doc["doc_fname"].' '.$doc["doc_sname"].' '.$doc["doc_lname"]."</h4>";
            $html=$html."<br><label><a href='/ekshefle/profile/profile.php?doc_email=".$doc["doc_email"]."'>إعرض ملف الدكتور الشخصي كاملاً</a></label>";
            $html=$html."</td>";
            $html=$html."<td><table class='table table-bordered'><thead>";
            $html=$html."<tr><th>العيادات المتوافقة مع البحث</th><th>المحافظة</th><th>القرية أو المركز</th><th>المنطقة</th><th>السعر</th><th>التخصصات الفرعية</th></tr>";
            $html=$html."</thead><tbody>";
            foreach ($doc_meds as $med) {
                $html=$html."<tr>";
                $html=$html."<td>".$med["med_name"]."</td>";
                $html=$html."<td>".$med["gov_name"]."</td>";
                $html=$html."<td>".$med["city_name"]."</td>";
                $html=$html."<td>".$med["area_name"]."</td>";
                $html=$html."<td>".$med["price"]."</td>";
                $html=$html."<td>".$med["side_spec"]."</td>";
                $html=$html."<td>".'<button class="btn btn-success" onclick="reserve_clinic('.$med["med_id"].','.$med["spec_id"].');">إحجز</button>'."</td>";
                $html=$html."</tr>";
            }
            $html=$html."</tbody></table></td>";
            $html=$html."</tr>";
        }
        $html=$html."</tbody></table>";
        echo $html;
    }
}
?>