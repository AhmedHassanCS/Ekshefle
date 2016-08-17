<?php

function get_area_id($gov_name,$city_name,$area_name)
{
    global $db;

    $city_id=get_city_id($gov_name,$city_name);
    $search_result=$db->query("SELECT area_id from area 
                                where area_name='$area_name' and city_id=$city_id");

    if($search_result && mysqli_num_rows($search_result)>0)
    {
     $row = $search_result->fetch_assoc();
     return $row['area_id'];
    }
    else return false;
}

function get_city_id($gov_name,$city_name)
{
    global $db;

    $gov_id = get_gov_id($gov_name);
    $search_result=$db->query("SELECT city_id from city 
                                where city_name='$city_name' and gov_id=$gov_id");

    if($search_result && mysqli_num_rows($search_result)>0)
    {
     $row = $search_result->fetch_assoc();
     return $row['city_id'];
    }
    else return false;
}

function get_gov_id($gov_name)
{
    global $db;

    $search_result=$db->query("SELECT gov_id from governorate where gov_name='$gov_name'");
    if($search_result && mysqli_num_rows($search_result)>0)
    {
     $row = $search_result->fetch_assoc();
     return $row['gov_id'];
    }
    else return false;
}

function add_area($gov_name,$city_name, $area_name)
{
    global $db;

    $city_id= get_city_id($gov_name,$city_name);
    $insert_query=$db->query("INSERT into area (area_name, city_id) values('$area_name',$city_id)");
    return $insert_query;
}

function add_city($gov_name, $city_name)
{
    global $db;

    $gov_id= get_gov_id($gov_name);
    $insert_query=$db->query("INSERT into city (city_name, gov_id) values('$city_name',$gov_id)");
    return $insert_query;
}

function add_address($gov_name,$city_name,$area_name, $detailed_add, $med_id)
{
    global $db;

    $area_id=get_area_id($gov_name,$city_name,$area_name);
    $insert_query=$db->query("INSERT into address (area_id,detailed_add,med_id) values($area_id,$detailed_add,$med_id)");
    return $insert_query;
}

function get_city_areas($gov_name,$city_name)
{
    global $db;

    $city_id=get_city_id($gov_name,$city_name);
    $select_result = $db->query("SELECT area_name from area where city_id=$city_id ");
    $html="";

    while($row = $select_result->fetch_assoc())
        $html=$html."<option>".$row['area_name']."</option>";

    return $html;
}

function get_gov_cities($gov_name)
{
    global $db;

    $gov_id=get_gov_id($gov_name);
    $select_result = $db->query("SELECT city_name from city where gov_id=$gov_id ");
    
    $html="";
    while($row = $select_result->fetch_assoc())
        $html=$html."<option>".$row['city_name']."</option>";

    return $html;
}

function get_govs()
{
    global $db;

    $result= $db->query("SELECT gov_name from governorate");
    $html="";
    while($row=$result->fetch_assoc())
        $html=$html."<option>".$row['gov_name']."</option>";

    return $html;
}

function area_exist_else_add($gov_name,$city_name,$area_name)
{
    global $db;

    $city_id=get_city_id($gov_name,$city_name);
    $select= $db->query("SELECT area_name from area where city_id='$city_id'");
    if(mysqli_num_rows($select)>0)
    {
        return true;
    }
    else {add_area($gov_name,$city_name, $area_name); return false;}
}

function city_exist_else_add($gov_id,$city_name)
{
    global $db;

    $gov_id=get_city_id($gov_name);
    $select= $db->query("SELECT city_name from city where gov_id='$gov_id'");
    if(mysqli_num_rows($select)>0)
    {
        return true;
    }
    else {add_city($gov_name,$city_name); return false;}
}

function area_exist($gov_name,$city_name,$area_name)
{
    global $db;

    $city_id=get_city_id($gov_name,$city_name);
    $select= $db->query("SELECT area_name from area where city_id='$city_id'");
    if(mysqli_num_rows($select)>0)
    {
        return true;
    }
    else return false;
}

function city_exist($gov_id,$city_name)
{
    global $db;

    $gov_id=get_city_id($gov_name);
    $select= $db->query("SELECT city_name from city where gov_id='$gov_id'");
    if(mysqli_num_rows($select)>0)
    {
        return true;
    }
    else return false;
}

?>