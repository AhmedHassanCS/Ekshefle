<?php
require_once("../../private/session.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
  header("location: /ekshefle/");

require_once("../../controlers/location.php");
?>

<div class="box box-success" id="new_Lab_div">
      <div class="box-header with-border">
        <h3>Enter Lab's Information<br></h3>
      </div>

      <div class="box-body">

        <!--Lab Name-->
        <div class="form-group">
          <h4>Lab Name</h4>
            <input type="text" id="lab_name" class="form-control" pattern="[ء-ي1-9٠-٩_ ]+" required="required" placeholder="إسم المعمل">
        </div>
        <br>

        <!--Phones-->
        <div class="form-group" id="ph_cont">
          <h4>Lab Phones (Separated With Commas)</h4>
          <input type="text" id="phones" class="form-control" placeholder="01.........., 01..........">
        </div>
        <br>

        <!--Address-->
        <div class="form-group" id="address_cont">
          <h4>Lab Detailed Address</h4>
          <input type="text" id="address" class="form-control" placeholder="المحافظة - المركز أو القرية - المنطقة - الشارع - رقم العمارة" style="width:37%;">
        </div>
        <br>

        <!--Location-->
        <div class="form-group" id="location">
          <h4>Choose Location's Basic Infromation (To help people in search)</h4>
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

        <!--Days-->
        <div class="form-group" style="width:25%;">
          <h4>Availabe days</h4>
          
          <table class="table" >
            <!---sat-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="sat"/> Saturday</td>
              <td>From: <input type="time" id="sat_from" style="width:75%;"></td> 
              <td>To: <input type="time" id="sat_to" style="width:75%;"></td>
            </tr>
            <!---sun-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="sun"/> Sunday</td>
              <td>From: <input type="time" id="sun_from" style="width:75%;"></td>
              <td>To: <input type="time" id="sun_to" style="width:75%;"></td>
            </tr>
            <!--mon-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="mon"/> Monday</td>
              <td>From: <input type="time" id="mon_from" style="width:75%;"> </td>
              <td>To: <input type="time" id="mon_to" style="width:75%;"></td>
            </tr>
            <!--tues-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="tues"/> Tuesday</td>
              <td>From: <input type="time" id="tues_from" style="width:75%;"> </td>
              <td>To: <input type="time" id="tues_to" style="width:75%;"></td>
            </tr>
            <!--wed-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="wed"/> Wednesday</td>
              <td>From: <input type="time" id="wed_from" style="width:75%;"> </td>
              <td>To: <input type="time" id="wed_to" style="width:75%;"></td>
            </tr>
            <!--thurs-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="thurs"/> Thursday</td>
              <td>From: <input type="time" id="thurs_from" style="width:75%;"/></td>
              <td>To: <input type="time" id="thurs_to" style="width:75%;"/></td>
            </tr>
            <!--fri-->
            <tr>
              <td><input type="checkbox" class="flat-red" id="fri"/> Friday</td>
              <td>From: <input type="time" id="fri_from" style="width:75%;"/></td> 
              <td>To: <input type="time" id="fri_to" style="width:75%;"/></td>
            </tr>
          </table>
        </div>
        <br>

      <!-- Button -->
      <div class="box-footer">
        <span id="error" style="color:red;"></span><br>
        <button class="btn btn-success btn-large" onclick="lab_submit();">Submit</button>
      </div>

    </div>

<script src="/ekshefle/js/init.js"></script>
<script src="/ekshefle/js/add_lab.js"></script>
<script src="/ekshefle/js/manage_location.js"></script>
