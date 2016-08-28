<?php

function get_doc_id($doc_email)
{
    global $db;
    $result=$db->query("SELECT doc_id from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_id'];
    }
    else return false;
}
//simone profile functions
function get_doc_address($doc_email)
{
    global $db;
    $result=$db->query("SELECT doc_address from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_address'];
    }
    else return false;
}
function get_doc_phone($doc_email)
{
    global $db;
    $result=$db->query("SELECT doc_phone from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_phone'];
    }
    else return false;
}

function get_doc_fname($doc_email)
{
    global $db;
    $result=$db->query("SELECT doc_fname from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_fname'];
    }
    else return false;
}

function get_doc_lname($doc_email)
{
    global $db;
    $result=$db->query("SELECT doc_lname from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_lname'];
    }
    else return false;
}
function get_doc_sname($doc_email)
{
    global $db;
    $result=$db->query("SELECT doc_sname from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_sname'];
    }
    else return false;
}

function get_spec($doc_email)
{
    global $db;
    $result=$db->query("SELECT spec_name from specialty where spec_id in(SELECT spec_id from doctor where doc_email='$doc_email')");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['spec_name'];
    }
    else return false;
}

function get_degree($doc_email)
{
    global $db;
    $result=$db->query("SELECT degree from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['degree'];
    }
    else return false;
}



function get_clinics($doc_email)
{ $doc_id=get_doc_id($doc_email);
    global $db;
    $result=$db->query("SELECT med_id from medical where doc_id='$doc_id' and med_type='Clinic'");

    if(mysqli_num_rows($result)==1)
    {$row=$result->fetch_assoc();
        return $row['med_id'];
    }
    else if(mysqli_num_rows($result)>1){
        $arr=array();
        while($row = $result->fetch_assoc()) 
            array_push($arr,$row["med_id"]);
                return $arr;}
    
    else return false;
}
function get_Hospitals($doc_email)
{ $doc_id=get_doc_id($doc_email);
    global $db;
    $result=$db->query("SELECT med_id from medical where doc_id='$doc_id' and med_type='Hospital'");

    if(mysqli_num_rows($result)==1)
    {$row=$result->fetch_assoc();
        return $row['med_id'];
    }
    else if(mysqli_num_rows($result)>1){
        $arr=array();
        while($row = $result->fetch_assoc()) 
            array_push($arr,$row["med_id"]);
                return $arr;}
    
    else return false;
}

function get_Laps($doc_email)
{ $doc_id=get_doc_id($doc_email);
    global $db;
    $result=$db->query("SELECT med_id from medical where doc_id='$doc_id' and med_type='Lap'");

    if(mysqli_num_rows($result)==1)
    {$row=$result->fetch_assoc();
        return $row['med_id'];
    }
    else if(mysqli_num_rows($result)>1){
        $arr=array();
        while($row = $result->fetch_assoc()) 
            array_push($arr,$row["med_id"]);
                return $arr;}
    
    else return false;
}

function update_doc_attrib($attrib_name,$attrib_val,$doc_email)
{
    global $db;
    return $db->query("UPDATE doctor set $attrib_name='$attrib_val' where doc_email='$doc_email'");
}
?>