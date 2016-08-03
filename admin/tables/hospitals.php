<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Hospitals</h1></br></section>


<!--_________________Hospitals Tab Starts____________________-->
<div class="tab-pane" id="tab_hospitals">
  <!-- search -->
  <div class="input-group margin">
      <div class="input-group-btn">
        <select type="button" id="hospital_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
        <option value="">Search with</option>
        <option value=4>Doctor's Username</option>
        <option value=5>Doctor's Name</option>
        <option value=1>Hospital's Name</option>
        <option value=2>Hospital's Phone</option>
        </span></select>
       </div>
      <!-- /btn-group -->
      <input type="text" id="hospital_sval" class="form-control">
      <span class="input-group-btn">
        <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_hospitals();"/>
      </span>
    </div>
    <!-- search ends-->
    <div class="box">
        <div class="box-body">
          <table id="hospital_tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Hospital's Name</th>
              <th>Hospital's Phone</th>
              <th>Hospital's Address</th>
              <th>Doctor's Username</th>
              <th>Doctor's Name</th>
              <th>Is Active</th>
            </tr>
            </thead>
            <tbody>
              <?php
                  $hospital_query="SELECT m.med_id, m.med_name, m.phones, addr.detailed_add, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname ,m.is_active
                                    from medical as m, doctor as d, address as addr
                                    where m.med_type='Hospital'
                                    and m.med_id=addr.med_id
                                    and d.doc_id=m.doc_id";
                  
                  $hospitals=$db->query($hospital_query);
                    while($row = $hospitals->fetch_assoc()) {
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
   <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="hospital_reset();"/>
</div>

<script>
//get original hospital table
var hospital_tbl = document.getElementById('hospital_tbl');
var cln_hospital = hospital_tbl.cloneNode(true);
var hospital_rows = cln_hospital.rows;
</script>