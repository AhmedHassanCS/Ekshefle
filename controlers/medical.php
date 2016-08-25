<?php

if(!$loggedin)
  header("location: /ekshefle/");

require_once("doctor.php");
function count_doc_med($doc_email,$med_type)
{
    global $db;
    $hos_num_query="SELECT count(*) as total from doctor as d,medical as m 
                    where d.doc_email='$doc_email' 
                    and d.doc_id=m.doc_id 
                    and m.med_type='$med_type'";
    $result= $db->query($hos_num_query);
    $row=$result->fetch_assoc();
    return $row['total'];
}

function is_active($doc_email,$med_type)
{
    global $db;
    $conts= $db->query("SELECT cont_code from contract as c, doctor as d 
                where d.doc_email='$doc_email'
                and d.doc_id=c.doc_id
                and c.med_type='$med_type'
                and c.is_expired=0");

    if(mysqli_num_rows($conts)==1)
    {
        return true;
    }
    else return false;
}
function is_expired($doc_email,$med_type)
{
    global $db;
    $conts= $db->query("SELECT cont_code from contract as c, doctor as d 
                where d.doc_email='$doc_email'
                and d.doc_id=c.doc_id
                and c.med_type='$med_type'
                and c.is_expired=1");

    if(mysqli_num_rows($conts)==1)
    {
        return true;
    }
    else return false;
}
function is_requested($doc_email,$med_type)
{
    global $db;
    $conts= $db->query("SELECT * from request as r, doctor as d 
                where d.doc_email='$doc_email'
                and d.doc_id=r.doc_id
                and r.med_type='$med_type'
                ");

    if(mysqli_num_rows($conts)==1)
    {
        return true;
    }
    else return false;
}
function get_doc_medicals_tbl($doc_email,$med_type)
{
    global $db;
    $meds_result= $db->query("SELECT m.med_id , m.med_name , m.phones , addr.detailed_add 
                    from medical as m, doctor as d, address as addr
                    where d.doc_email='$doc_email'
                    and m.med_type='$med_type'
                    and d.doc_id=m.doc_id
                    and addr.med_id=m.med_id");
    if(!$meds_result)
        return "<h2>Error: ".$db->error."</h2>";
    elseif(mysqli_num_rows($meds_result)==0)
        return "<h3>Empty: 0 medical elements in this type<h3>";
    else{
        $med_type=strtolower($med_type);
        $tbl='<table class="table table-bordered table-hover">
                <thead><td>Id</td><td>Name</td><td>Address</td><td>Phones</td><td>Operations</td></thead>';
        while($row = $meds_result->fetch_assoc()){
            $tbl=$tbl.'<tr>
                    <td>'.$row['med_id'].'</td>
                    <td>'.$row['med_name'].'</td>
                    <td>'.$row['detailed_add'].'</td>
                    <td>'.$row['phones'].'</td>
                    <td>
                    <input class="btn btn-warning btn-xs" type="button" 
                    value="View & Edit" onclick="edit_'.$med_type.'('.$row['med_id'].');"/>
                    <input class="btn btn-danger btn-xs" type="button" 
                    value="Delete" onclick="delete_medical('.$row['med_id'].',\''.$row['med_name'].'\');"/>
                    </td>
                    </tr>';
        }
        $tbl=$tbl.'</table>';
        return $tbl;
    }
}
function add_medical($doc_email,$med_type,$med_name,$phones,$detailed_add,$area_id,$total_spec)
{
    //insert into medical
    //get medical id
    //with for loop through total_spec add sepcialities
    global $db;
    $doc_id= get_doc_id($doc_email);
    $insert_med_result = $db->query("INSERT into medical (doc_id,med_name,med_type,phones) 
                                    values($doc_id,'$med_name','$med_type','$phones')");
    if($insert_med_result){
        $med_id=$db->insert_id;
        $insert_address = $db->query("INSERT into address (area_id,detailed_add,med_id) 
                                        values($area_id,'$detailed_add',$med_id)");
        if(!$insert_address)
            return $db->error;
        else return add_specialties($med_id,$total_spec);

    }
    else return $db->error;
}

function add_specialties($med_id,$spec)
{
    global $db;
    foreach($spec as $s)
    {
        $spec_name=$s["specialty"];
        $spec_id = get_spec_id($spec_name);
        $price= $s["price"];
        $days= $s["days"];
        $side_spec= $s["side_spec"];
        $insert_result= $db->query("INSERT into med_spec(med_id,spec_id,price,aval_days,side_spec)
                                    values($med_id,$spec_id,$price,'$days','$side_spec')");
        if(!$insert_result)
            return $db->error;
    }
    return "SUCCESS";

}

function get_spec_id($spec_name)
{
    global $db;
    $query_result = $db->query("SELECT spec_id from specialty where spec_name= '$spec_name'");
    $spec_row = $query_result->fetch_assoc();
    if(!$spec_row)
        return $db->error;
    else return $spec_row["spec_id"];
}

function delete_medical($med_id)
{
    global $db;
    return $db->query("DELETE from medical where med_id=$med_id");
}
function get_clinic($med_id)
{
    global $db;
    $med_result =$db->query("SELECT med_name,phones from medical where med_id=$med_id");
    $med_info = $med_result->fetch_assoc();
    
    $spec_result =$db->query("SELECT spec_id, aval_days,price,side_spec from med_spec where med_id=$med_id");
    $spec_info = $spec_result->fetch_assoc();
    
    $address_result= $db->query("SELECT area_id,detailed_add from address where med_id=$med_id");
    $add_info = $address_result->fetch_assoc();

    $area_id=$add_info["area_id"];

    $location_result= $db->query("SELECT a.area_name, a.area_id,c.city_name, c.city_id,g.gov_name,g.gov_id
                                from area as a, city as c, governorate as g
                                where a.area_id=$area_id
                                and a.city_id=c.city_id
                                and c.gov_id=g.gov_id");
    $location_info=$location_result->fetch_assoc();

    $total_info=array_merge($med_info,$spec_info,$add_info,$location_info);
    //med_name , phones , spec_id , aval_days , price , side_spec , area_name , city_name , gov_name
    //, area_id , city_id , gov_id
    return $total_info;
}

function get_hospital($med_id)
{
    global $db;
    $med_result =$db->query("SELECT med_name,phones from medical where med_id=$med_id");
    $med_info = $med_result->fetch_assoc();
    
    $spec_result =$db->query("SELECT m.spec_id,s.spec_name ,m.aval_days,m.price,m.side_spec 
                            from med_spec as m, specialty as s
                            where m.med_id=$med_id
                            and m.spec_id=s.spec_id");
    $total_spec=array();
    while($spec_info = $spec_result->fetch_assoc())
        array_push($total_spec , $spec_info);
    
    $address_result= $db->query("SELECT area_id,detailed_add from address where med_id=$med_id");
    $add_info = $address_result->fetch_assoc();

    $area_id=$add_info["area_id"];

    $location_result= $db->query("SELECT a.area_name, a.area_id,c.city_name, c.city_id,g.gov_name,g.gov_id
                                from area as a, city as c, governorate as g
                                where a.area_id=$area_id
                                and a.city_id=c.city_id
                                and c.gov_id=g.gov_id");
    $location_info=$location_result->fetch_assoc();

    $total_info=array_merge($med_info,$add_info,$location_info);
    $total_info["total_spec"]=$total_spec;
    //med_name , phones , spec_id , aval_days , price , side_spec , area_name , city_name , gov_name
    //, area_id , city_id , gov_id
    return $total_info;
}

function update_attrib($med_id,$table,$attrib_name,$new_value)
{
    global $db;
    return $db->query("UPDATE $table set $attrib_name='$new_value' where med_id='$med_id'");
}
function update_spec_attrib($med_id,$spec_id,$attrib_name,$new_value)
{
    global $db;
    return $db->query("UPDATE med_spec set $attrib_name='$new_value' 
                        where med_id=$med_id
                        and spec_id=$spec_id");
}
//simone profile functions 

function get_med_name($med_id)
{
    global $db;
    $result=$db->query("SELECT med_name from medical where med_id='$med_id'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['med_name'];
    }
    else return false;
}


function get_med_phones($med_id)
{
    global $db;
    $result=$db->query("SELECT phones from medical where med_id='$med_id'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['phones'];
    }
    else return false;
}
//array_push($arr,$row["med_id"]);
function get_med_location($med_id)
{ $area_id; $city_id; $gov_id; $arr=array();
    global $db;
    $result=$db->query("SELECT area_id from address where med_id='$med_id'");

    if(mysqli_num_rows($result)>0)
    {
        $row=$result->fetch_assoc();
       $area_id=$row['area_id'];
    }
    else return false;
     $result=$db->query("SELECT area_name ,city_id from area where area_id='$area_id'");
    
    if(mysqli_num_rows($result)>0)
    {
        $row=$result->fetch_assoc();
       array_push($arr,$row['area_name']);
       $city_id=$row['city_id'];
    }
    else return false;

     $result=$db->query("SELECT city_name,gov_id from city where city_id='$city_id'");
            if(mysqli_num_rows($result)>0)
    {
        $row=$result->fetch_assoc();
        array_push($arr,$row['city_name']);
        $gov_id=$row['gov_id'];
    }
    else return false;
        
     $result=$db->query("SELECT gov_name from governorate where gov_id='$gov_id'");
            if(mysqli_num_rows($result)>0)
    {
        $row=$result->fetch_assoc();
        array_push($arr,$row['gov_name']);
    }
    else return false;
    
    return $arr;
    
}

function get_med_side_spec_price($med_id){
        global $db; $arr=array();
    $result=$db->query("SELECT side_spec,price from med_spec where med_id='$med_id'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
       $arr["side_spec"]=$row['side_spec'];
       $arr["price"]=$row['price'];
    }
    else return false;
    return $arr;
    
}
?>