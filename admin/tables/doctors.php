<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Doctors</h1></br></section>

<!--_________________Doctors Tab Starts____________________-->
<div class="tab-pane" id="tab_doctors">
    <!-- search -->
    <div class="input-group margin">
        <div class="input-group-btn">
          <select type="button" id="doctor_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
          <option value="">Search with</option>
          <option value=0>Username</option>
          <option value=1>Name</option>
          <option value=2>Phone</option>
          <option value=4>Specialty</option>
          </span></select>
         </div>
        <!-- /btn-group -->
        <input type="text" id="doctor_sval" class="form-control">
        <span class="input-group-btn">
          <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_doctors();"/>
        </span>
      </div>
      <!-- search ends-->
      <div class="box">
          <div class="box-body">
            <table id="doctor_tbl" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Specialty</th>
                <th>Operations</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                    $doctors_query= "SELECT d.doc_fname, d.doc_sname ,d.doc_lname, d.doc_email, d.doc_phone ,d.doc_address ,s.spec_name
                                      FROM doctor as d, specialty as s 
                                      where d.spec_id=s.spec_id";

                    $doctors=$db->query($doctors_query);
                      while($row = $doctors->fetch_assoc()) {
                          echo "<tr>
                                <td>".$row["doc_email"]."</td>
                                <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                <td>".$row["doc_phone"]."</td>
                                <td>".$row["doc_address"]."</td>
                                <td>".$row["spec_name"]."</td>
                                <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_doctor_div' value='Delete' 
                                      onclick='delete_doctor(\"".$row["doc_email"]."\")'/></td>
                                </tr>";
                      }
                  
                ?>
              </tbody>
             </table>
          </div>
      </div>
   <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="doctor_reset();"/>
</div>

<!-- delete doctor handling-->
<div id="del_doctor_div" class="modal fade" style="display: none; "> 
    <div class="modal-dialog">
    <div class="modal-content"> 

        <div class="modal-header">  
            <a class="close" data-dismiss="modal">×</a>  
            <h3>Are you sure? deleting this doctor can't be undone!</h3>  
        </div>  

      <form action="operations/delete_doctor.php" method="post">
        <div class="modal-body"> 
              <h5>Email/Username of owner doctor:</h5>  
              <input type="text" class="form-control" id="del_doc_email" name="doc_email" readonly/>
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
//get original doctor table
var doctor_tbl = document.getElementById('doctor_tbl');
var cln_doctor = doctor_tbl.cloneNode(true);
var doctor_rows = cln_doctor.rows;
</script>