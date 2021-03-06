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
    $num_of_hospitals= count_doc_med($doc_email,'Hospital');

    //draw square with number of hospitals and if they are published
    require_once("../squares/hospitals_square.php");

    echo '<div class="box" id="hospitals_container">';
    if($num_of_hospitals==0)
    echo "<h5 style='color:red;'>This section is for hospital owners,<br>
        If you work in a clinic in some hospital,<br>
        add it as a clinic and set the address as the hospital's address including hospital's name<br><br></h5>";
    echo get_doc_medicals_tbl($doc_email,'Hospital');
}
?>
<input class="btn btn-success btn-large" type="button" value="Add Hospital" onclick="new_hospital();"/>
</div>