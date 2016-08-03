<?php
require_once("../session.php");
?>
<section class="content-header"><h1 style="text-align:center;">Expired Contracts</h1></br></section>

<!--_________________Expired Tab Starts____________________-->
<div class="tab-pane" id="tab_expired">
        <!-- search -->
        <div class="input-group margin">
            <div class="input-group-btn">
              <select type="button" id="expired_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
              <option value="">Search with</option>
              <option value=1>Username</option>
              <option value=0>Contract Code</option>
              <option value=2>Name</option>
              <option value=4>Phone</option>
              </span></select>
             </div>

             <!-- type select-->
                  <div class="input-group-btn">
                  <select type="button" id="exp_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="fa fa-caret-down">
                  <option value="">All Types</option>
                  <option value="clinic">Clinic</option>
                  <option value="hospital">Hospital</option>
                  <option value="lab">Lab</option>
                  </span></select>
                 </div>

            <!-- /btn-group -->
            <input type="text" id="expired_sval" class="form-control">
            <span class="input-group-btn">
              <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_expired();"/>
            </span>
          </div>
          <!-- search ends-->
          <div class="box">
              <div class="box-body">
                <table id="expired_tbl" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Contract Code</th>
                    <th>Username</th>
                    <th>Doctor's name</th>
                    <th>Type</th>
                    <th>Phone</th>
                    <th>Expiration Date</th>
                    <th>Operations<th/>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                          $exp_query= "SELECT d.doc_fname, d.doc_sname ,d.doc_lname, d.doc_email, d.doc_phone, d.doc_address, c.cont_code, c.exp_date, c.med_type
                                        FROM doctor as d, contract as c
                                              where d.doc_id=c.doc_id
                                              and c.is_expired=1";

                          $expirations= $db->query($exp_query);
                          $expirations_num=  $expirations->num_rows;
                          while($row = $expirations->fetch_assoc()) {
                              echo "<tr>
                                    <td>".$row["cont_code"]."</td>
                                    <td>".$row["doc_email"]."</td>
                                    <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                    <td>".$row["med_type"]."</td>
                                    <td>".$row["doc_phone"]."</td>
                                    <td>".$row["exp_date"]."</td>
                                    <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_expired_div' value='Delete' 
                                          onclick='delete_expired(\"".$row["cont_code"]."\",\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/></td>
                                    </tr>";
                          }
                      
                    ?>
                  </tbody>
                 </table>
               </div>
             </div>
             <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="expired_reset();"/>
             <a href="operations/del_all_exp.php" class="btn btn-danger btn-flat pull-right">Delete all expired</a>
        </div>

<!-- delete expired handling-->
<div id="del_expired_div" class="modal fade" style="display: none; "> 
    <div class="modal-dialog">
    <div class="modal-content"> 

        <div class="modal-header">  
            <a class="close" data-dismiss="modal">×</a>  
            <h3>Are you sure? deleting this contract can't be undone!</h3>  
        </div>  

      <form action="operations/delete_contract.php" method="post">
        <div class="modal-body"> 
              <h5>Contract Code:</h5>  
              <input type="text" class="form-control" id="del_exp_code" name="cont_code" readonly/>
              <h5>Email/Username of owner doctor:</h5>
              <label id="del_exp_doc"></label> 
              <h5>Medical Type:</h5>  
              <label id="del_exp_type"></label>
          </div> 
        <div class="modal-footer"> 
        <input type="submit"  class="btn btn-danger" value="Submit"/>  
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
      </form>
    </div>          
   </div>                          
</div>

<script>
//get original expired table
var expired_tbl = document.getElementById('expired_tbl');
var cln_expired = expired_tbl.cloneNode(true);
var expired_rows = cln_expired.rows;
</script>