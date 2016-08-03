<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Publishing Requests</h1></br></section>


<!--_________________Requests Tab Starts____________________-->
<div class="tab-pane" id="tab_requests">
    <!-- search -->
    <div class="input-group margin">
        <div class="input-group-btn">
          <select id="request_swith" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
          <option value="">Search with</option>
          <option value=0>Username</option>
          <option value=1>Name</option>
          <option value=3>Phone</option>
          </span></select>
         </div>

         <!-- type select-->
              <div class="input-group-btn">
              <select type="button" id="reqs_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="fa fa-caret-down">
              <option value="">All Types</option>
              <option value="clinic">Clinic</option>
              <option value="hospital">Hospital</option>
              <option value="lab">Lab</option>
              </span></select>
             </div>

        <!-- /btn-group -->
        <input type="text" id="request_sval" class="form-control">
        <span class="input-group-btn">
          <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_requests();"/>
        </span>
      </div>
      <!-- search ends-->
      <div class="box">
          <div class="box-body">
            <table id="request_tbl" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Type</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Operations</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                $reqs_query = "SELECT d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname , r.med_type, d.doc_phone,
                                      d.doc_address
                                FROM doctor as d, request as r 
                                WHERE r.doc_id=d.doc_id";

                $requests = $db->query($reqs_query);
                $requests_num = $requests->num_rows;
                while($row = $requests->fetch_assoc()) {
                  echo "<tr>
                        <td>".$row["doc_email"]."</td>
                        <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                        <td>".$row["med_type"]."</td>
                        <td>".$row["doc_phone"]."</td>
                        <td>".$row["doc_address"]."</td>
                        <td><input class='btn btn-success btn-xs' type='button' data-toggle='modal' data-target='#approve_div' value='Approve' 
                              onclick='approve(\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/>
                            <input class='btn btn-danger btn-xs' type='button' value='Deny' data-toggle='modal' data-target='#deny_div' 
                              onclick='deny(\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/></td>
                        </tr>";
                }
                  
                ?>
              </tbody>
             </table>
           </div>
         </div>
    <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="request_reset();"/>
</div>

<!-- approve handling-->
<div id="approve_div" class="modal fade" style="display: none; "> 
      <div class="modal-dialog">
      <div class="modal-content"> 

          <div class="modal-header">  
              <a class="close" data-dismiss="modal">×</a>  
              <h3>Approve publishing request</h3>  
          </div>  

          <form action="operations/approve.php" method="post">
            <div class="modal-body"> 
                <h5>Owner doctor:</h5>
                <input type="text" class="form-control" id="approve_doc" name="doc_email" readonly/> 
                <h5>Medical Type to publish:</h5>  
                <input type="text" class="form-control" id="approve_type" name="med_type" readonly/>
                <h5>Contract Code:</h5>  
                <input type="text" class="form-control" name="cont_code" />
                <h5>Start Date:</h5>  
                <input type="date" name="start_date" />
                <h5>Expiration Date:</h5>  
                <input type="date" name="exp_date" />
            </div> 
                
            <div class="modal-footer">  
            <input type="submit" class="btn btn-success" value="Submit"/>  
            <a href="#" class="btn" data-dismiss="modal">Close</a>  
            </div>
          </form>     

      </div>          
    </div>
</div>

<!-- Deny handling-->
<div id="deny_div" class="modal fade" style="display: none; "> 
      <div class="modal-dialog">
      <div class="modal-content"> 

          <div class="modal-header">  
              <a class="close" data-dismiss="modal">×</a>  
              <h3>Are you sure you want to deny this request?</h3>  
          </div>  

        <form action="operations/deny.php" method="post">
          <div class="modal-body"> 
                <h5>Owner doctor:</h5>
                <input type="text" class="form-control" id="deny_doc" name="doc_email" readonly/> 
                <h5>Medical type:</h5>  
                <input type="text" class="form-control" id="deny_type" name="med_type" readonly/>  
          </div> 

          <div class="modal-footer"> 
          <input type="submit"  class="btn btn-danger" value="Deny"/>  
          <a href="#" class="btn" data-dismiss="modal">Close</a>
          </div>
        </form>
      </div>          
   </div>                          
</div>

<script>
//get original request table
var request_tbl = document.getElementById('request_tbl');
var cln_request = request_tbl.cloneNode(true);
var request_rows = cln_request.rows;
</script>