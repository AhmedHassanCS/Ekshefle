<?php
if(!$loggedin)
  header("location: /ekshefle/");
?>

<div class="content-wrapper" >
    <div id="main_container" style="width:80%; margin: 0 auto;">
<?php
require_once('../controlers/medical.php');

$doc_email= $_SESSION['loggedin_user'];

$num_of_clinincs= count_doc_med($doc_email,'Clinic');
$num_of_hospitals= count_doc_med($doc_email, 'Hospital');
$num_of_labs= count_doc_med($doc_email, 'Lab');

//echo clinics square, success if active, danger if expired, warning if not published
require_once("squares/clinics_square.php");
require_once("squares/hospitals_square.php");
require_once("squares/labs_square.php");

?>
    </div>
</div>