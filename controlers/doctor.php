<?php

function get_doc_id($doc_email)
{
    $result=$db->query("SELECT doc_id from doctor where doc_email='$doc_email'");

    if(mysqli_num_rows($result)==1)
    {
        $row=$result->fetch_assoc();
        return $row['doc_id'];
    }
    else return false;
}


?>