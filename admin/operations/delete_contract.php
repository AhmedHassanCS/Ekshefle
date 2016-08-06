<?php
require_once('../session.php');


$cont_code= mysqli_real_escape_string($db,$_POST["cont_code"]);

$exist_query= "SELECT doc_id, med_type from contract where cont_code ='$cont_code'";
$exist_result=$db->query($exist_query);
if(mysqli_num_rows($exist_result)==1)
{
    $doc = $exist_result->fetch_assoc();
    $doc_id= $doc["doc_id"];
    $med_type= $doc["med_type"];

	$del_query="DELETE from contract where cont_code='$cont_code'";
	if(!$db->query($del_query))
		echo "<h2>Error:</h2>"."<h3>".$db->error."</h3>";
	else
        {
            $update_active="UPDATE medical SET is_active=0 where doc_id=$doc_id and med_type='$med_type'";
            if(!$db->query($update_active)){
                echo "<h2>Error: ".$db->error."</h2>";
            }
            else header("location: /ekshefle/admin/");
        }

}
else echo "<h2>Error:</h2>"."<h3>There's no contract with this code</h3>";
?>