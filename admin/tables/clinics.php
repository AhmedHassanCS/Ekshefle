<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Clinics</h1></br></section>

<!--_________________Clinics Tab Starts____________________-->
<div class="tab-pane" id="tab_clinics">
  <!-- search -->
  <div class="input-group margin">
    <div class="input-group-btn">
      <select type="button" id="clinic_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
      <option value="">Search with</option>
      <option value=4>Doctor's Username</option>
      <option value=5>Doctor's Name</option>
      <option value=1>Clinic's Name</option>
      <option value=2>Clinic's Phone</option>

      </span></select>
     </div>
    <!-- /btn-group -->
    <input type="text" id="clinic_sval" class="form-control">
    <span class="input-group-btn">
      <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_clinics();"/>
    </span>
  </div>
  <!-- search ends-->
  <div class="box">
      <div class="box-body">
        <table id="clinic_tbl" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>Clinic's Name</th>
            <th>Clinic's Phone</th>
            <th>Clinic's Address</th>
            <th>Doctor's Username</th>
            <th>Doctor's Name</th>
            <th>Is Active</th>
          </tr>
          </thead>
          <tbody>
            <?php 

              $clinics_query="SELECT m.med_id, m.med_name, m.phones, addr.detailed_add, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname ,m.is_active
              from medical as m, doctor as d, address as addr
              where m.med_type='Clinic'
              and m.med_id=addr.med_id
              and d.doc_id=m.doc_id";

              $clinics=$db->query($clinics_query);
              while($row = $clinics->fetch_assoc()) {
                  echo "<tr>
                        <td>".$row["med_id"]."</td>
                        <td>".$row["med_name"]."</td>
                        <td>".$row["phones"]."</td>
                        <td>".$row["detailed_add"]."</td>
                        <td>".$row["doc_email"]."</td>
                        <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                        <td>".$row["is_active"]."</td>
                        </tr>";
              }
              
            ?>
          </tbody>
         </table>
       </div>
     </div>
   <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="clinic_reset();"/>
</div>

<script>
//get original clinic table
var clinic_tbl = document.getElementById('clinic_tbl');
var cln_clinic = clinic_tbl.cloneNode(true);
var clinic_rows = cln_clinic.rows;
</script>