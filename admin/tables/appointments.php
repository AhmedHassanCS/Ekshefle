<?php
require_once("../session.php");
?>

<section class="content-header"><h1 style="text-align:center;">Appointments</h1></br></section>
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
                  <option value="lab">lab</option>
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
                          $apps_query= "SELECT app.app_id, p.nat_id, p.pat_name ,m.med_id ,m.med_name, m.med_type, app.date,
                          m.phones, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname ,s.spec_name
                          FROM patient as p, medical as m, appointment as app, doctor as d, med_spec as ms, specialty as s
                          WHERE app.confirmed=0
                          AND app.pat_id = p.nat_id
                          AND app.med_id = m.med_id
                          AND m.doc_id = d.doc_id
                          AND m.med_id=ms.med_id
                          AND ms.spec_id=s.spec_id";

                          $appointments = $db->query($apps_query);
                          $appointments_num = $appointments->num_rows;

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
                                    <td>".$row["date"]."</td>
                                    <td>".$row["spec_name"]."</td>
                                    <td><input class='btn btn-success btn-xs' type='button' data-toggle='modal' data-target='#confirm_div' value='Confirm' 
                                          onclick='confirm(\"".$row["app_id"]."\",\"".$row["nat_id"]."\",\"".$row["med_id"]."\",\"".$row["date"]."\")'/>
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
              <input type="text" class="form-control" id="conf_app_id" name="app_id" readonly/> 
              <h5>Patient ID:</h5>
              <label id="conf_pat_id"></label> 
              <h5>Medical ID:</h5>  
              <label id="conf_med_id"></label> 
              <h5>Date & Time:</h5>  
              <input type="date" id="conf_date_time" name="real_date"/> 
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
            <input type="text" class="form-control" id="cancel_app_id" name="app_id" readonly/> 
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

<script>
//get original appoitment table
var appointment_tbl = document.getElementById('appointment_tbl');
var cln_appointment = appointment_tbl.cloneNode(true);
var appointment_rows = cln_appointment.rows;
</script>