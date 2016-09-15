<?php
require_once("../../private/session.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
  header("location: /ekshefle/");


require_once("../../controlers/medical.php");
require_once("../../controlers/location.php");

$med_id=mysqli_real_escape_string($db,$_POST["med_id"]);
$med_info= get_lab($med_id);
?>
<!--edit loc-->
<div id="edit_loc_div" class="modal fade" style="display: none; background:#fff; width:50%;"> 
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <div class="modal-header">  
          <a class="close" data-dismiss="modal">×</a>  
          <h3>Edit Location</h3>  
      </div>  

      <div class="modal-body"> 
        <table class="table">
            <!--governorate-->
            <tr>
              <td>المحافظة</td>
              <td>
                <select list="browsers" class="select2" id="gov" onchange="on_gov_select();">
                  <option value=""></option>
                  <?php
                    $result= $db->query("SELECT gov_name, gov_id from governorate");
                    
                    while($row=$result->fetch_assoc())
                      if($row['gov_id']!=$med_info['gov_id'])
                        echo "<option>".$row['gov_name']."</option>";
                      else echo "<option selected>".$row['gov_name']."</option>";
                  ?>
                </select>
              </td>
            </tr>
            <!--city-->
            <tr>
              <td>المركز أو القرية</td>  
              <td>
                <select list="browsers" class="select2" id="city" onchange="on_city_select();">
                  <?php
                    $result= $db->query("SELECT city_name, city_id from city where gov_id=".$med_info['gov_id']);
                    
                    while($row=$result->fetch_assoc())
                      if($row['city_id']!=$med_info['city_id'])
                        echo "<option>".$row['city_name']."</option>";
                      else echo "<option selected>".$row['city_name']."</option>";
                  ?>
                </select>
              </td> 
              <td>
                <input type="checkbox" for="city" id="other_city_check" onchange="other_city_checked();"> Other  
                <input   placeholder="مركز أو قرية أخري" id="other_city" disabled>
              </td>
            </tr>
            <!--area-->
            <tr>
              <td>المنطقة أو المدينة</td>
              <td>
                <select list="browsers" class="select2" id="area">
                  <?php
                    $result= $db->query("SELECT area_name, area_id from area where city_id=".$med_info['city_id']);
                    
                    while($row=$result->fetch_assoc())
                      if($row['area_id']!=$med_info['area_id'])
                        echo "<option>".$row['area_name']."</option>";
                      else echo "<option selected>".$row['area_name']."</option>";
                  ?>
                </select>
              </td>
              <td>
                <input type="checkbox" for="city" id="other_area_check" onchange="other_area_checked();"> Other 
                <input   placeholder="منطقة أخري" id="other_area" disabled>
              </td>
            </tr>
          </table>
          <span id="loc_error" style="color:red;"></span>
      </div> 

      <div class="modal-footer"> 
        <input type="submit"  class="btn btn-danger" value="Save" onclick="save_location();"/>  
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>          
  </div>                          
</div>
<!--/edit loc-->

<!--edit form-->
<div class="box box-success" id="edit_clinic_div">
      <div class="box-header with-border">
        <h3>Lab's Information<br></h3>
      </div>

      <div class="box-body">
        <input id="med_id" value=<?php echo '"'.$med_id.'"';?> hidden/>
        
        <!--Lab Name-->
        <div class="input-group">
          <h4>Lab's Name:</h4>
            <input id="clinic_name" class="form-control" pattern="[ء-ي1-9٠-٩_ ]+" required="required" value=<?php echo '"'.$med_info["med_name"].'"';?> disabled>
            <button class="btn btn-default" id="edit_name" type="button" onclick="edit_name();">Edit</button>
            <div class="input-group" id="name_btns" hidden>
              <span id="name_error" style="color:red;"></span>
              <br>
              <button class="btn btn-warning" id="save_name" type="button" onclick="save_name();" >Save</button>
              <button class="btn btn-danger" id="cancel_name" type="button" onclick="cancel_name();" >Cancel</button>
            </div>
        </div>
        <br>

        <!--Phones-->
        <div class="form-group">
          <h4>Lab's Phones (Separated With Commas)</h4>
          <input id="phones" class="form-control" value=<?php echo '"'.$med_info["phones"].'"';?> disabled>
          <button class="btn btn-default" id="edit_phones" type="button" onclick="edit_phones();">Edit</button>
          <div class="input-group" id="phones_btns" hidden>
            <span id="phones_error" style="color:red;"></span>
            <br>
            <button class="btn btn-success" id="save_phones" type="button" onclick="save_phones();" >Save</button>
            <button class="btn btn-danger" id="cancel_phones" type="button" onclick="cancel_phones();" >Cancel</button>
          </div>
        </div>
        <br>

        <!--Address-->
        <div class="form-group" id="address_cont">
          <h4>Lab Detailed Address</h4>
          <input id="address" class="form-control" value=<?php echo '"'.$med_info["detailed_add"].'"';?> style="width:37%;" disabled>
          <button class="btn btn-default" id="edit_address" type="button" onclick="edit_address();" >Edit</button>
          <div class="input-group" id="address_btns" hidden>
            <span id="address_error" style="color:red;"></span>
            <br>
            <button class="btn btn-success" id="save_address" type="button" onclick="save_address();" >Save</button>
            <button class="btn btn-danger" id="cancel_address" type="button" onclick="cancel_address();" >Cancel</button>
          </div>
        </div>
        <br>

        <!--Location-->
        <div class="form-group" id="location">
          <h4>Location
          <button class="btn btn-default" type="button" data-toggle='modal' data-target='#edit_loc_div'>Edit</button>
          </h4>
          <table class="table" style="width:70%">
            <!--governorate-->
            <tr>
              <td>المحافظة</td>
              <td>
                <input class="form-control" id="gov_view" value=<?php echo '"'.$med_info["gov_name"].'"';?> disabled>
              </td>
            </tr>
            <!--city-->
            <tr>
              <td>المركز أو القرية</td>  
              <td>
                <input class="form-control" id="city_view" value=<?php echo '"'.$med_info["city_name"].'"';?> disabled>
              </td> 
            </tr>
            <!--area-->
            <tr>
              <td>المنطقة أو المدينة</td>
              <td>
                <input class="form-control" id="area" value=<?php echo '"'.$med_info["area_name"].'"';?> disabled>
              </td>
            </tr>
          </table>
        </div>
        <br>

        <!--Days-->
        <div class="form-group" style="width:30%;">
          <h4>Available Days</h4>
          Edit days then click  &nbsp;&nbsp;<button class="btn btn-success" type="button" onclick="save_lab_days();">Save</button>
          <?php 
            $days=json_decode($med_info["aval_days"]);

            if(isset($days->{"sat"})){
              $sat=$days->{"sat"};
              $sat_from= $sat->{"from"};
              $sat_to = $sat->{"to"};
            }
            if(isset($days->{"sun"})){
              $sun=$days->{"sun"};
              $sun_from= $sun->{"from"};
              $sun_to = $sun->{"to"};
            }
            if(isset($days->{"mon"})){
              $mon=$days->{"mon"};
              $mon_from= $mon->{"from"};
              $mon_to = $mon->{"to"};
            }
            if(isset($days->{"tues"})){
              $tues=$days->{"tues"};
              $tues_from= $tues->{"from"};
              $tues_to = $tues->{"to"};
            }
            if(isset($days->{"wed"})){
              $wed=$days->{"wed"};
              $wed_from= $wed->{"from"};
              $wed_to = $wed->{"to"};
            }
            if(isset($days->{"thurs"})){
              $thurs=$days->{"thurs"};
              $thurs_from= $thurs->{"from"};
              $thurs_to = $thurs->{"to"};
            }
            if(isset($days->{"fri"})){
              $fri=$days->{"fri"};
              $fri_from= $fri->{"from"};
              $fri_to = $fri->{"to"};
            }
          ?><br>
          <span id="days_error" style="color:red;"></span><br>
          <table class="table" >
            <!---sat-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="sat" <?php if(isset($days->{"sat"})) echo 'checked';?>/> Saturday</td>
              <td>From: <input type="time" id="sat_from" style="width:75%;" 
                <?php if(isset($sat_from)) echo 'value="'.$sat_from.'"';?>></td> 
              <td>To: <input type="time" id="sat_to" style="width:75%;"
                <?php if(isset($sat_to)) echo 'value="'.$sat_to.'"';?>></td>
            </tr>
            <!---sun-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="sun" <?php if(isset($days->{"sun"})) echo 'checked'; ?>/> Sunday</td>
              <td>From: <input type="time" id="sun_from" style="width:75%;"
                <?php if(isset($sun_from)) echo 'value="'.$sun_from.'"'; ?>></td>
              <td>To: <input type="time" id="sun_to" style="width:75%;"
                <?php if(isset($sun_to)) echo 'value="'.$sun_to.'"';  ?>></td>
            </tr>
            <!--mon-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="mon" <?php if(isset($days->{"mon"})) echo 'checked'; ?>/> Monday</td>
              <td>From: <input type="time" id="mon_from" style="width:75%;"
                <?php if(isset($mon_from)) echo 'value="'.$mon_from.'"';  ?>> </td>
              <td>To: <input type="time" id="mon_to" style="width:75%;"
                <?php if(isset($mon_to)) echo 'value="'.$mon_to.'"'; ?>></td>
            </tr>
            <!--tues-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="tues" <?php if(isset($days->{"tues"})) echo 'checked'; ?>/> Tuesday</td>
              <td>From: <input type="time" id="tues_from" style="width:75%;"
                <?php if(isset($tues_from)) echo 'value="'.$tues_from.'"'; ?>> </td>
              <td>To: <input type="time" id="tues_to" style="width:75%;"
                <?php if(isset($tues_to)) echo 'value="'.$tues_to.'"'; ?>></td>
            </tr>
            <!--wed-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="wed" <?php if(isset($days->{"wed"})) echo 'checked'; ?>/> Wednesday</td>
              <td>From: <input type="time" id="wed_from" style="width:75%;"
                <?php if(isset($wed_from)) echo 'value="'.$wed_from.'"'; ?>> </td>
              <td>To: <input type="time" id="wed_to" style="width:75%;"
                <?php if(isset($wed_to)) echo 'value="'.$wed_to.'"'; ?>></td>
            </tr>
            <!--thurs-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="thurs" <?php if(isset($days->{"thurs"})) echo 'checked'; ?>/> Thursday</td>
              <td>From: <input type="time" id="thurs_from" style="width:75%;"
                <?php if(isset($thurs_from)) echo 'value="'.$thurs_from.'"'; ?>/></td>
              <td>To: <input type="time" id="thurs_to" style="width:75%;"
                <?php if(isset($thurs_to)) echo 'value="'.$thurs_to.'"'; ?>/></td>
            </tr>
            <!--fri-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="fri" <?php if(isset($days->{"fri"})) echo 'checked';?>/> Friday</td>
              <td>From: <input type="time" id="fri_from" style="width:75%;"
                <?php if(isset($fri_from)) echo 'value="'.$fri_from.'"'; ?>/></td> 
              <td>To: <input type="time" id="fri_to" style="width:75%;"
                <?php if(isset($fri_to)) echo 'value="'.$fri_to.'"'; ?>/></td>
            </tr>
          </table>
        </div>
        <br>


      <!-- Button -->
      <div class="box-footer">
        <span id="error" style="color:red;"></span><br>
        <button class="btn btn-danger btn-large" onclick="get_labs();">Return To Labs</button>
      </div>

    </div>

<script src="/ekshefle/js/init.js"></script>
<script src="/ekshefle/js/edit_med.js"></script>
<script src="/ekshefle/js/manage_location.js"></script>