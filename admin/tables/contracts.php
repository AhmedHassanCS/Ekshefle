<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Running Contracts</h1></br></section>

<!--_________________Contracts Tab Starts____________________-->
<div class="tab-pane" id="tab_contracts">
  <!-- search -->
  <div class="input-group margin">
      <div class="input-group-btn">
        <select type="button" id="contract_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
        <option value="">Search with</option>
        <option value=1>Username</option>
        <option value=0>Contract Code</option>
        <option value=2>Name</option>
        </span></select>
       </div>

       <!-- type select-->
            <div class="input-group-btn">
            <select type="button" id="conts_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="fa fa-caret-down">
            <option value="">All Types</option>
            <option value="clinic">Clinic</option>
            <option value="hospital">Hospital</option>
            <option value="lab">Lab</option>
            </span></select>
           </div>

      <!-- /btn-group -->
      <input type="text" id="contract_sval" class="form-control">
      <span class="input-group-btn">
        <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_contracts();"/>
      </span>
    </div>
    <!-- search ends-->
    <div class="box">
        <div class="box-body">
          <table id="contract_tbl" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Contract Code</th>
              <th>Username</th>
              <th>Doctor's name</th>
              <th>Type</th>
              <th>Start date</th>
              <th>Expiration Date</th>
              <th>Operations</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                  $contracts_query="SELECT d.doc_fname, d.doc_sname ,d.doc_lname, d.doc_email, c.cont_code, c.exp_date, c.start_date, c.med_type
                                    FROM doctor as d, contract as c
                                          where d.doc_id=c.doc_id
                                          and c.is_expired=0";

                   $contracts=$db->query($contracts_query);
                    while($row = $contracts->fetch_assoc()) {
                        echo "<tr>
                              <td>".$row["cont_code"]."</td>
                              <td>".$row["doc_email"]."</td>
                              <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                              <td>".$row["med_type"]."</td>
                              <td>".$row["start_date"]."</td>
                              <td>".$row["exp_date"]."</td>
                              <td><input class='btn btn-danger btn-xs' type='button' data-toggle='modal' data-target='#del_contract_div' value='Delete' 
                                    onclick='delete_contract(\"".$row["cont_code"]."\",\"".$row["doc_email"]."\",\"".$row["med_type"]."\")'/></td>
                              </tr>";
                    }
                
              ?>
            </tbody>
           </table>
         </div>
       </div>
       <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="contract_reset();"/>
       <div class="pull-right">
        <input type="button" class="btn btn-success btn-flat" value="New Contract" data-toggle="modal" data-target="#new_contract_div"/>
       </div>
  </div>

<!-- new contract handling-->
<div id="new_contract_div" class="modal fade" style="display: none; "> 
    <div class="modal-dialog">
    <div class="modal-content"> 

        <div class="modal-header">  
            <a class="close" data-dismiss="modal">×</a>  
            <h3>Add new contract</h3>  
        </div>  

      <form action="operations/add_contract.php" method="post">
        <div class="modal-body"> 
              <h5>Email/Username of owner doctor:</h5>
              <input type="text" class="form-control" id="approve_doc" name="doc_email"/> 
              <h5>Medical Type to publish:</h5>  
              <input type="text" id="approve_type" name="med_type" />
              <h5>Contract Code:</h5>  
              <input type="text" name="cont_code" />
              <h5>Start Date:</h5>  
              <input type="date" name="start_date" />
              <h5>Expiration Date:</h5>  
              <input type="date" name="exp_date" /> 
          </div> 
        <div class="modal-footer"> 
        <input type="submit"  class="btn btn-danger" value="Submit"/>  
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
      </form>
    </div>          
   </div>                          
</div>

<!-- delete contract handling-->
<div id="del_contract_div" class="modal fade" style="display: none; "> 
    <div class="modal-dialog">
    <div class="modal-content"> 

        <div class="modal-header">  
            <a class="close" data-dismiss="modal">×</a>  
            <h3>Are you sure? deleting this contract can't be undone!</h3>  
        </div>  

      <form action="operations/delete_contract.php" method="post">
        <div class="modal-body"> 
              <h5>Contract Code:</h5>  
              <input type="text" class="form-control" id="del_cont_code" name="cont_code" readonly/>
              <h5>Email/Username of owner doctor:</h5>
              <label id="del_cont_doc"></label> 
              <h5>Medical Type to publish:</h5>  
              <label id="del_cont_type"></label>
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
//get original contract table
var contract_tbl = document.getElementById('contract_tbl');
var cln_contract = contract_tbl.cloneNode(true);
var contract_rows = cln_contract.rows;
</script>