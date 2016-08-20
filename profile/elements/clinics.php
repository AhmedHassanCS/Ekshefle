<?php
require_once("../../private/session.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");

elseif(!$loggedin)
  header("location: /ekshefle/");

else{
    require_once("../../controlers/medical.php");
    $doc_email= $_SESSION['loggedin_user'];
    $num_of_clinincs= count_doc_med($doc_email,'Clinic');

    //draw square with number of clinics and if they are published
    require_once("../squares/clinics_square.php");
    echo '<div class="box" id="clinics_container">';
    echo get_doc_medicals_tbl($doc_email,'Clinic');
}
?>
<input class="btn btn-success btn-large" type="button" value="Add Clinic" onclick="new_clinic();"/>
</div>
