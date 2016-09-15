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
$med_info= get_hospital($med_id);
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
<div class="box box-solid box-success" id="edit_hospital_div">

      <div class="box-body">
        <input id="med_id" value=<?php echo '"'.$med_id.'"';?> hidden/>
        
        <!--Clinic Name-->
        <div class="input-group">
          <h4>Hospital Name:</h4>
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
          <h4>Hospital Phones (Separated With Commas)</h4>
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
          <h4>Hospital Detailed Address</h4>
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

        <h4>Available specialties in the Hospital</h4>
        <button class="btn btn-primary btn-xs" data-toggle='modal' data-target='#add_spec_div'>Add specialty</button>
        <br>
        <div id="spec_container">
          <?php
          $total_spec= $med_info["total_spec"];
          $index=0;
          foreach ($total_spec as $spec ) {
            
            $days_view="";
            $days=json_decode($spec["aval_days"]);
            
            if(isset($days->{"sat"})){
              $sat=$days->{"sat"};
              $sat_from= $sat->{"from"};
              $sat_to = $sat->{"to"};
              $days_view = $days_view."Saturday - from:".$sat_from." - To: ".$sat_to;
            }
            if(isset($days->{"sun"})){
              $sun=$days->{"sun"};
              $sun_from= $sun->{"from"};
              $sun_to = $sun->{"to"};
              $days_view = $days_view."Sunday - from:".$sun_from." - To: ".$sun_to;
            }
            if(isset($days->{"mon"})){
              $mon=$days->{"mon"};
              $mon_from= $mon->{"from"};
              $mon_to = $mon->{"to"};
              $days_view = $days_view."Monday - from:".$mon_from." - To: ".$mon_to;
            }
            if(isset($days->{"tues"})){
              $tues=$days->{"tues"};
              $tues_from= $tues->{"from"};
              $tues_to = $tues->{"to"};
              $days_view = $days_view."Tuesday - from:".$tues_from." - To: ".$tues_to;
            }
            if(isset($days->{"wed"})){
              $wed=$days->{"wed"};
              $wed_from= $wed->{"from"};
              $wed_to = $wed->{"to"};
              $days_view = $days_view."Wednesday - from:".$wed_from." - To: ".$wed_to;

            }
            if(isset($days->{"thurs"})){
              $thurs=$days->{"thurs"};
              $thurs_from= $thurs->{"from"};
              $thurs_to = $thurs->{"to"};
              $days_view = $days_view."Thursday - from:".$thurs_from." - To: ".$thurs_to;

            }
            if(isset($days->{"fri"})){
              $fri=$days->{"fri"};
              $fri_from= $fri->{"from"};
              $fri_to = $fri->{"to"};
              $days_view = $days_view."Friday - from:".$fri_from." - To: ".$fri_to;
            }

            echo '<div id="'.$index.'" class="box box-solid box-primary" style="width:20%; margin:5px; float:left;">'.
            '<h5>Specialty Name:</h5>'.$spec['spec_name'].
            '<br><h5>Days:</h5>'.$days_view.
            '<h5>Price:</h5> '.$spec['price'].
            '<h5>Side Specialties:</h5> '.$spec['side_spec'].
            '<br><button class="btn btn-xs btn-primary" onclick="edit_spec('.$index.')" data-toggle="modal" data-target="#add_spec_div">Edit</button>'.
            '<button class="btn btn-xs btn-primary" onclick="del_spec('.$index.');">Delete</button></div>';
            $index++;  
          }
          
          ?>
        </div>

    </div>
    <!-- Button -->
    <div class="box-footer">
      <span id="error" style="color:red;"></span><br>
      <button class="btn btn-danger btn-large" onclick="get_hospitals();">Return To Hospitals</button>
    </div>
</div>

<!--from here mutiple specialties with mutiple days, price and side specialities -->
<div id="add_spec_div" class="modal fade" style="display: none; background:#fff; width:50%;"> 
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <div class="modal-body">
        <!--Specialty-->
        <div class="form-group" >
         <h4>Specialty</h4>
           <select class="select2" id="specialty">
           <?php
             $spec_sql="SELECT spec_name, spec_id from specialty";
             $spec_result=$db->query($spec_sql);
             $total_spec =$med_info["total_spec"];
             $all_ids=array();
             foreach ($total_spec as $s) {
               array_push($all_ids,$s["spec_id"]);
             }
             $doc_email=$_SESSION['loggedin_user'];

             while($spec = $spec_result->fetch_assoc())
             {
                if(!in_array($spec["spec_id"], $all_ids))
                  if($spec["spec_id"]!=$doc_spec)
                  echo "<option>".$spec["spec_name"]."</option>";
                  else echo "<option>".$spec["spec_name"]."</option>";
             }
           ?>
         </select>
         <br><br>
       </div>
       <br>

       <!--Days-->
       <div class="form-group" style="width:50%;">
         <h4>Days available for this Specialty</h4>
         
         <table class="table" >
           <!---sat-->
           <tr>
             <td><input type="checkbox" id="sat"/> Saturday</td>
             <td>From: <input type="time" id="sat_from" style="width:75%;"></td> 
             <td>To: <input type="time" id="sat_to" style="width:75%;"></td>
           </tr>
           <!---sun-->
           <tr>
             <td><input type="checkbox" id="sun"/> Sunday</td>
             <td>From: <input type="time" id="sun_from" style="width:75%;"></td>
             <td>To: <input type="time" id="sun_to" style="width:75%;"></td>
           </tr>
           <!--mon-->
           <tr>
             <td><input type="checkbox" id="mon"/> Monday</td>
             <td>From: <input type="time" id="mon_from" style="width:75%;"> </td>
             <td>To: <input type="time" id="mon_to" style="width:75%;"></td>
           </tr>
           <!--tues-->
           <tr>
             <td><input type="checkbox" id="tues"/> Tuesday</td>
             <td>From: <input type="time" id="tues_from" style="width:75%;"> </td>
             <td>To: <input type="time" id="tues_to" style="width:75%;"></td>
           </tr>
           <!--wed-->
           <tr>
             <td><input type="checkbox" id="wed"/> Wednesday</td>
             <td>From: <input type="time" id="wed_from" style="width:75%;"> </td>
             <td>To: <input type="time" id="wed_to" style="width:75%;"></td>
           </tr>
           <!--thurs-->
           <tr>
             <td><input type="checkbox" id="thurs"/> Thursday</td>
             <td>From: <input type="time" id="thurs_from" style="width:75%;"/></td>
             <td>To: <input type="time" id="thurs_to" style="width:75%;"/></td>
           </tr>
           <!--fri-->
           <tr>
             <td><input type="checkbox" id="fri"/> Friday</td>
             <td>From: <input type="time" id="fri_from" style="width:75%;"/></td> 
             <td>To: <input type="time" id="fri_to" style="width:75%;"/></td>
           </tr>
         </table>
       </div>
       <br>

       <!--Price-->
       <div class="form-group">
         <h4> Price</h4>
         <input type="text" id="price" class="form-control" placeholder="سعر الكشف فقط" style="width:20%;" >
       </div><br>

       <!--Side Specialties-->
       <div class="form-group">
         <h4> Side Specialty (Optional)</h4>
         <input type="text" id="side_spec" class="form-control" placeholder="..... فرعي 1 - فرعي 2 - فرعي 3 " style="width:45%;" >
       </div><br>
      </div> 

      <div class="modal-footer" id="add_footer">
        <span id="spec_error" style="color:red;"></span><br>
        <input type="submit" class="btn btn-success" value="Add" onclick="put_spec_box(true);"/>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
      <div class="modal-footer" id="edit_footer" hidden>
        <input type="submit"  class="btn btn-success" value="Save" onclick="send_spec_edit();" hidden/>   
        <a href="#" class="btn" data-dismiss="modal" onclick="cancel_spec_edit();" hidden>Cancel</a>
      </div>
    </div>          
  </div>                          
</div>

<script>
var total_spec_json=<?php echo json_encode($med_info["total_spec"]); ?>;
var spec_dic={};
var index=0;
for( index=0;index<total_spec_json.length;index++)
{
  var spec_temp=total_spec_json[index];
  spec_dic[""+index]=spec_temp;
}
//var spec = total_spec_json[0];
</script>

<script src="/ekshefle/js/init.js"></script>
<script src="/ekshefle/js/edit_med.js"></script>
<script src="/ekshefle/js/edit_spec.js"></script>
<script src="/ekshefle/js/manage_location.js"></script>