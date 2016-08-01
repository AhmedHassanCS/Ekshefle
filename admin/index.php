<?php
  require_once("header.php");
?>
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
                  <option value="lap">Lap</option>
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
                          mysqli_data_seek($requests, 0);
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
                              <input type="text" class="form-control" id="approve_doc" name="doc_email"/> 
                              <h5>Medical Type to publish:</h5>  
                              <input type="text" class="form-control" id="approve_type" name="med_type" />
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
                              <input type="text" class="form-control" id="deny_doc" name="doc_email"/> 
                              <h5>Medical type:</h5>  
                              <input type="text" class="form-control" id="deny_type" name="med_type"/>  
                        </div> 

                        <div class="modal-footer"> 
                        <input type="submit"  class="btn btn-danger" value="Deny"/>  
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
                      </form>
                    </div>          
                   </div>                          
                </div>
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
            <option value="lap">Lap</option>
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
                        <input type="text" class="form-control" id="del_cont_code" name="cont_code"/>
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
                  <option value="lap">Lap</option>
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
                          mysqli_data_seek($expirations, 0);
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
                              <input type="text" class="form-control" id="del_exp_code" name="cont_code"/>
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
                              <input type="text" class="form-control" id="del_doc_email" name="doc_email"/>
                        </div> 
                        <div class="modal-footer"> 
                        <input type="submit"  class="btn btn-danger" value="Delete"/>  
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
                      </form>
                    </div>          
                   </div>                          
                </div>

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

<!--_________________Laps Tab Starts____________________-->
<div class="tab-pane" id="tab_laps">
        <!-- search -->
        <div class="input-group margin">
            <div class="input-group-btn">
              <select type="button" id="lap_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">            <span class="fa fa-caret-down">
              <option value="">Search with</option>
              <option value=4>Doctor's Username</option>
              <option value=5>Doctor's Name</option>
              <option value=1>Lap's Name</option>
              <option value=2>Lap's Phone</option>
              </span></select>
             </div>
            <!-- /btn-group -->
            <input type="text" id="lap_sval" class="form-control">
            <span class="input-group-btn">
              <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_laps();"/>
            </span>
          </div>
          <!-- search ends-->
          <div class="box">
              <div class="box-body">
                <table id="lap_tbl" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Lap's Name</th>
                    <th>Lap's Phone</th>
                    <th>Lap's Address</th>
                    <th>Doctor's Username</th>
                    <th>Doctor's Name</th>
                    <th>Is Active</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                          while($row = $laps->fetch_assoc()) {
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
             <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="lap_reset();"/>
          </div>

<!--_________________Appointments Tab Starts____________________-->
<div class="tab-pane" id="tab_appointments">
        <!-- search -->
        <div class="input-group margin">
            <div class="input-group-btn">
              <select type="button" id="appointment_swith" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="fa fa-caret-down">
              <option value="">Search with</option>
              <option value=1>Patient National ID</option>
              <option value=2>Patient's name</option>
              <option value=3>Doctor's name</option>
              <option value=5>Medical Name</option>
              <option value=6>Medical Phone</option>
              </span></select>
             </div>

                <!-- type select-->
                  <div class="input-group-btn">
                  <select type="button" id="apps_type_select" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="fa fa-caret-down">
                  <option value="">All Types</option>
                  <option value="clinic">Clinic</option>
                  <option value="hospital">Hospital</option>
                  <option value="lap">Lap</option>
                  </span></select>
                 </div>

            <!-- /btn-group -->
            <input type="text" id="appointment_sval" class="form-control">
            <span class="input-group-btn">
              <input type="button" class="btn btn-info btn-flat" value="Search" onclick="search_appointments();"/>
            </span>

            </div>
          <!-- search ends-->
          <div class="box">
              <div class="box-body">
                <table id="appointment_tbl" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Patient's ID</th>
                    <th>Pateint's Name</th>
                    <th>Doctor's Name</th>
                    <th>Medical ID</th>
                    <th>Medical Name</th>
                    <th>Medical Type</th>
                    <th>Medical Phone</th>
                    <th>Date & Time</th>
                    <th>Specialty</th>
                    <th>Operations</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                          mysqli_data_seek($appointments, 0);
                          while($row = $appointments->fetch_assoc()) {
                              echo "<tr>
                                    <td>".$row["app_id"]."</td>
                                    <td>".$row["nat_id"]."</td>
                                    <td>".$row["pat_name"]."</td>
                                    <td>".$row["doc_fname"].' '.$row["doc_sname"].' '.$row["doc_lname"]."</td>
                                    <td>".$row["med_id"]."</td>
                                    <td>".$row["med_name"]."</td>
                                    <td>".$row["med_type"]."</td>
                                    <td>".$row["phones"]."</td>
                                    <td>".$row["time_date"]."</td>
                                    <td>".$row["spec_name"]."</td>
                                    <td><input class='btn btn-success btn-xs' type='button' data-toggle='modal' data-target='#confirm_div' value='Confirm' 
                                          onclick='confirm(\"".$row["app_id"]."\",\"".$row["nat_id"]."\",\"".$row["med_id"]."\",\"".$row["time_date"]."\")'/>
                                        <input class='btn btn-danger btn-xs' type='button' value='Cancel' data-toggle='modal' data-target='#cancel_div' 
                                          onclick='cancel(\"".$row["app_id"]."\",\"".$row["nat_id"]."\",\"".$row["med_id"]."\")'/></td>
                                    </tr>";
                          }
                      
                    ?>
                  </tbody>
                 </table>
               </div>
             </div>
             <input type="button" class="btn btn-info btn-flat" value="Reset" onclick="appointment_reset();"/>
            </div>
                <!-- confirmation handling-->
                <div id="confirm_div" class="modal fade" style="display: none; "> 
                    <div class="modal-dialog">
                    <div class="modal-content"> 

                        <div class="modal-header">  
                            <a class="close" data-dismiss="modal">×</a>  
                            <h3>Confirm this patient</h3>  
                        </div>  

                        <form action="operations/confirm.php" method="post">
                          <div class="modal-body"> 
                              <h5>Appointment ID:</h5>
                              <input type="text" class="form-control" id="conf_app_id" name="app_id"/> 
                              <h5>Patient ID:</h5>
                              <label id="conf_pat_id"></label> 
                              <h5>Medical ID:</h5>  
                              <label id="conf_med_id"></label> 
                              <h5>Date & Time:</h5>  
                              <input type="text" id="conf_date_time" name="real_date"/> 
                          </div> 
                              
                          <div class="modal-footer">  
                          <input type="submit" class="btn btn-success" value="Confirm"/>  
                          <a href="#" class="btn" data-dismiss="modal">Close</a>  
                          </div>
                        </form>     

                    </div>          
                   </div>
                 </div>
                 <!-- Cancelation handling-->
                <div id="cancel_div" class="modal fade" style="display: none; "> 
                    <div class="modal-dialog">
                    <div class="modal-content"> 

                        <div class="modal-header">  
                            <a class="close" data-dismiss="modal">×</a>  
                            <h3>Are you sure you want to cancel this appointment?</h3>  
                        </div>  

                      <form action="operations/cancel.php" method="post">
                        <div class="modal-body"> 
                              <h5>Appointment ID:</h5>
                              <input type="text" class="form-control" id="cancel_app_id" name="app_id"/> 
                              <h5>Patient ID:</h5>
                              <label id="cancel_pat_id"></label> 
                              <h5>Medical ID:</h5>  
                              <label id="cancel_med_id"></label>  
                        </div> 

                        <div class="modal-footer"> 
                        <input type="submit"  class="btn btn-danger" value="Yes"/>  
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>

                      </form>
                    </div>          
                   </div>                          
                </div>               
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
                              <input type="text" class="form-control" id="del_pat_id" name="nat_id"/>
                        </div> 
                        <div class="modal-footer"> 
                          <input type="submit"  class="btn btn-danger" value="Delete"/>  
                          <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
                      </form>
                    </div>          
                   </div>                          
                </div>
<?php
    require_once("footer.php");
?>