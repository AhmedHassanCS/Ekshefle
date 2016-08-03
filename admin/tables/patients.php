<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Patients</h1></br></section>

<!--_________________Patients Tab Starts____________________-->
<div class="tab-pane" id="tab_patients">
  <!-- search -->
  <div class="input-group margin">
      <div class="input-group-btn">
        <select type="button" id="patient_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
        <option value="">Search with</option>
        <option value=0>National ID</option>
        <option value=1>Name</option>
        <option value=2>Phone</option>
        <option value=3>Email</option>
        </span></select>
       </div>
      <!-- /btn-group -->
      <input type="text" id="patient_sval" class="form-control">
      <span class="input-group-btn">
        <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_patients();"/>
      </span>
  </div>
    <!-- search ends-->
    <div class="box">
        <div class="box-body">
          <table id="patient_tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>National ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>E-mail</th>
              <th>Address</th>
              <th>Operations</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                  $pateints_query="SELECT * from patient";
                  $patients=$db->query($pateints_query);
                  
                    while($row = $patients->fetch_assoc()) {
                        echo "<tr>
                              <td>".$row["nat_id"]."</td>
                              <td>".$row["pat_name"]."</td>
                              <td>".$row["pat_phone"]."</td>
                              <td>".$row["pat_email"]."</td>
                              <td>".$row["pat_address"]."</td>
                              <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_patient_div' value='Delete' 
                                    onclick='delete_patient(\"".$row["nat_id"]."\")'/></td>
                              </tr>";
                    }
              ?>
            </tbody>
           </table>
         </div>
       </div>
   <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="patient_reset();"/>
</div>

<!-- delete Patient handling-->
<div id="del_patient_div" class="modal fade" style="display: none; "> 
    <div class="modal-dialog">
      <div class="modal-content"> 

          <div class="modal-header">  
              <a class="close" data-dismiss="modal">×</a>  
              <h3>Are you sure? deleting this Patient can't be undone!</h3>  
          </div>  

        <form action="operations/delete_patient.php" method="post">
          <div class="modal-body"> 
                <h5>Patient National ID:</h5>  
                <input type="text" class="form-control" id="del_pat_id" name="nat_id" readonly/>
          </div> 
          <div class="modal-footer"> 
            <input type="submit"  class="btn btn-danger" value="Delete"/>  
            <a href="#" class="btn" data-dismiss="modal">Close</a>
          </div>
        </form>
      </div>          
    </div>                          
</div>

<script>
//get original patient table
var patient_tbl = document.getElementById('patient_tbl');
var cln_patient = patient_tbl.cloneNode(true);
var patient_rows = cln_patient.rows;
</script>

