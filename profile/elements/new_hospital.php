<?php
require_once("../../private/session.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
  header("location: /ekshefle/");

require_once("../../controlers/location.php");
?>

<div class="box box-success" id="new_hospital_div">
  
      <div class="box-header with-border">
        <h3>Enter Hospital's Information<br></h3>
      </div>

      <div class="box-body" >

        <!--Hospital Name-->
        <div class="form-group">
          <h4>Hospital Name</h4>
          اسم المستشفي يجب أن يكون اسم توضيحي لك بحيث تستطيع التمييز بين عياداتك<br>
            <input type="text" id="hospital_name" class="form-control" pattern="[ء-ي1-9٠-٩_ ]+" required="required" placeholder="إسم المستشفي">
        </div>
        <br>

        <!--Phones-->
        <div class="form-group" id="ph_cont">
          <h4>Hospital Phones (Separated With Commas)</h4>
          <input type="text" id="phones" class="form-control" placeholder="01.........., 01..........">
        </div>
        <br>

        <!--Address-->
        <div class="form-group" id="address_cont">
          <h4>Hospital Detailed Address</h4>
          <input type="text" id="address" class="form-control" placeholder="المحافظة - المركز أو القرية - المنطقة - الشارع - رقم العمارة" style="width:37%;">
        </div>
        <br>

        <!--Location-->
        <div class="form-group" id="location">
          <h4>Choose Location's Basic Infromation (To help patient in search)</h4>
          If you didn't find your city or area choose other and insert it.
          <table class="table" style="width:70%">
            <!--governorate-->
            <tr>
              <td>المحافظة</td>
              <td>
                <select list="browsers" class="select2" id="gov" onchange="on_gov_select();">
                  <option value=""></option>
                  <?php
                    echo get_govs();
                  ?>
                </select>
              </td>
            </tr>
            <!--city-->
            <tr>
              <td>المركز أو القرية</td>  
              <td>
                <select list="browsers" class="select2" id="city" onchange="on_city_select();" disabled>
                  <option value=""></option> 
                </select>
              </td> 
              <td>
                <input type="checkbox" for="city" id="other_city_check" onchange="other_city_checked();" disabled> Other  
                <input   placeholder="مركز أو قرية أخري" id="other_city" disabled>
              </td>
            </tr>
            <!--area-->
            <tr>
              <td>المنطقة أو المدينة</td>
              <td>
                <select list="browsers" class="select2" id="area" disabled>
                  <option value=""></option>
                </select>
              </td>
              <td>
                <input type="checkbox" for="city" id="other_area_check" onchange="other_area_checked();" disabled> Other 
                <input   placeholder="منطقة أخري" id="other_area" disabled>
              </td>
            </tr>
          </table>
        </div>
        <br>
        <h4>Add available specialties in the hpospital</h4>
      <button class="btn btn-primary btn-xs" data-toggle='modal' data-target='#add_spec_div'>Add specialty</button>
      <br>
      <div id="spec_container"></div>
    </div>
    <br>
    <span id="error" style="color:red;"></span><br>
    <!-- Button -->
    <div class="box-footer">
      <button class="btn btn-success btn-large" onclick="submit_hospital();">Submit</button>
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

             $doc_email=$_SESSION['loggedin_user'];
             $get_doc_spec=$db->query("SELECT spec_id from doctor where doc_email='$doc_email'");
             $doc=$get_doc_spec->fetch_assoc();
             $doc_spec=$doc['spec_id'];
             while($spec = $spec_result->fetch_assoc())
             {
               if($spec["spec_id"]!=$doc_spec)
               echo "<option>".$spec["spec_name"]."</option>";
               else echo "<option selected>".$spec["spec_name"]."</option>";
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
        <input type="submit" class="btn btn-success" value="Add" onclick="put_spec_box();"/>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
      </div>
      <div class="modal-footer" id="edit_footer" hidden>
        <input type="submit"  class="btn btn-success" value="Done" onclick="edit_spec_box();" hidden/>   
        <a href="#" class="btn" data-dismiss="modal" onclick="cancel_spec_edit();" hidden>Cancel</a>
      </div>
    </div>          
  </div>                          
</div>

<!--scripts-->

<script src="/ekshefle/js/init.js"></script>
<script src="/ekshefle/js/add_med_validation.js"></script>
<script src="/ekshefle/js/manage_location.js"></script>
