<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Confirmed Appointments</h1></br></section>

<!--_________________Confirmed Tab Starts____________________-->
<div class="tab-pane" id="tab_confirmed">
  <!-- search -->
  <div class="input-group margin">
      <div class="input-group-btn">
        <select type="button" id="confirmed_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
        <option value="">Search with</option>
        <option value=0>Patient National ID</option>
        <option value=1>Patient's name</option>
        <option value=2>Doctor's username</option>
        <option value=3>Doctor's name</option>
        </span></select>
       </div>
      <!-- /btn-group -->
      <input type="text" id="confirmed_sval" class="form-control">
      <span class="input-group-btn">
        <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_confirmed();"/>
      </span>
    </div>
    <!-- search ends-->
    <div class="box">
        <div class="box-body">
          <table id="confirmed_tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Patient's ID</th>
              <th>Pateint's Name</th>
              <th>Doctor's username</th>
              <th>Doctor's Name</th>
              <th>Medical ID</th>
              <th>Medical Type</th>
              <th>Appointment Date</th>
            </tr>
            </thead>
            <tbody>
              <?php 

                $confirmed_query="SELECT p.nat_id, p.pat_name, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname, m.med_id,m.med_type, app.real_date
                from patient as p, doctor as d, medical as m, appointment as app
                where app.confirmed=1
                and p.nat_id=app.pat_id
                and m.med_id=app.med_id
                and d.doc_id=m.doc_id";

                $confirmed=$db->query($confirmed_query);
                while($row = $confirmed->fetch_assoc()) {
                    echo "<tr>
                          <td>".$row["nat_id"]."</td>
                          <td>".$row["pat_name"]."</td>
                          <td>".$row["doc_email"]."</td>
                          <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                          <td>".$row["med_id"]."</td>
                          <td>".$row["med_type"]."</td>
                          <td>".$row["real_date"]."</td>
                          </tr>";
                }
              ?>
            </tbody>
           </table>
         </div>
       </div>
   <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="confirmed_reset();"/>
</div>

<script>
//get original confirmed table
var confirmed_tbl = document.getElementById('confirmed_tbl');
var cln_confirmed = confirmed_tbl.cloneNode(true);
var confirmed_rows = cln_confirmed.rows;
</script>