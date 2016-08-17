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
        
        $tbl='<table class="table table-bordered table-hover">
                <thead><td>Id</td><td>Name</td><td>Address</td><td>Phones</td><td>Operations</td></thead>';
        while($row = $meds_result->fetch_assoc()){
            $tbl=$tbl.'<tr>
                    <td>'.$row['med_id'].'</td>
                    <td>'.$row['med_name'].'</td>
                    <td>'.$row['detailed_add'].'</td>
                    <td>'.$row['phones'].'</td>
                    <td>
                    <input class="btn btn-warning btn-xs" type="button" value="Edit"/>
                    <input class="btn btn-danger btn-xs" type="button" value="Delete"/>
                    </td>
                    </tr>';
        }
        $tbl=$tbl.'</table>';
        return $tbl;
    }
}
function add_medical($doc_email,$med_type,$med_name,$phones,$detailed_add,$area_id,$specialty)
{
    $doc_id= get_doc_id($doc_email);
    $insert_med_result = $db->query("INSERT into medical (doc_id,med_name,med_type,phones) 
                                    values($doc_id,'$med_name','$med_type','$phones')");
    if($insert_med_result){
        $med_id=$db->insert_id;
        $insert_address = $db->query("INSERT into address (area_id,detailed_add,med_id) 
                                        values($area_id,'$detailed_add',$med_id)");
        if(!$insert_address)
            return false;
        else return true;
    }
    else return false;
}
function delete_medical($med_id)
{
    return $db->query("DELETE from medical where med_id=$med_id");
}
?>