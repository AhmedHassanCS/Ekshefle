//clinic location
function on_gov_select()
{
    var gov=document.getElementById("gov").value;
    if(gov!=""){
        document.getElementById("city").disabled=false;
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_aval_cities.php",
            data:{gov_name:gov},
            success: function(data){
                document.getElementById("city").innerHTML="<option value='all'>الكل</option>";
                document.getElementById("city").innerHTML+=data;
                document.getElementById("area").innerHTML="<option value=''></option>";
                document.getElementById("area").disabled=true;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("city").disabled=true;
    }
}

function on_city_select()
{
    var gov=document.getElementById("gov").value;
    var city=document.getElementById("city").value;
    if(city!=""&&city!="all"){
        document.getElementById("area").disabled=false;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_aval_areas.php",
            data:{gov_name:gov, city_name:city},
            success: function(data){
                document.getElementById("area").innerHTML="<option value='all'>الكل</option>";
                document.getElementById("area").innerHTML+=data;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("area").innerHTML="";
        document.getElementById("area").disabled=true;
    }
}
//hospital location
function on_hgov_select()
{
    var gov=document.getElementById("hgov").value;
    if(gov!=""){
        document.getElementById("hcity").disabled=false;
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_aval_cities.php",
            data:{gov_name:gov},
            success: function(data){
                document.getElementById("hcity").innerHTML="<option value='all'>الكل</option>";
                document.getElementById("hcity").innerHTML+=data;
                document.getElementById("harea").innerHTML="<option value=''></option>";
                document.getElementById("harea").disabled=true;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("hcity").disabled=true;
    }
}

function on_hcity_select()
{
    var gov=document.getElementById("hgov").value;
    var city=document.getElementById("hcity").value;
    if(city!=""&&city!="all"){
        document.getElementById("harea").disabled=false;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_aval_areas.php",
            data:{gov_name:gov, city_name:city},
            success: function(data){
                document.getElementById("harea").innerHTML="<option value='all'>الكل</option>";
                document.getElementById("harea").innerHTML+=data;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("harea").innerHTML="";
        document.getElementById("harea").disabled=true;
    }
}
//lab location
function on_lgov_select()
{
    var gov=document.getElementById("lgov").value;
    if(gov!=""){
        document.getElementById("lcity").disabled=false;
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_aval_cities.php",
            data:{gov_name:gov},
            success: function(data){
                document.getElementById("lcity").innerHTML="<option value='all'>الكل</option>";
                document.getElementById("lcity").innerHTML+=data;
                document.getElementById("larea").innerHTML="<option value=''></option>";
                document.getElementById("larea").disabled=true;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("lcity").disabled=true;
    }
}

function on_lcity_select()
{
    var gov=document.getElementById("lgov").value;
    var city=document.getElementById("lcity").value;
    if(city!=""&&city!="all"){
        document.getElementById("larea").disabled=false;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_aval_areas.php",
            data:{gov_name:gov, city_name:city},
            success: function(data){
                document.getElementById("larea").innerHTML="<option value='all'>الكل</option>";
                document.getElementById("larea").innerHTML+=data;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("larea").innerHTML="";
        document.getElementById("larea").disabled=true;
    }
}

function search_clinics()
{
    $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/search_clinics.php",
            data:
            {
                gov_name:document.getElementById("gov").value, 
                city_name:document.getElementById("city").value,
                area_name:document.getElementById("area").value,
                spec_name:document.getElementById("spec").value,
                price:document.getElementById("price").value,
                day:document.getElementById("day").value,
                gender:document.getElementById("gender").value,
                degree:document.getElementById("degree").value,
                doc_name:document.getElementById("doc_name").value
            },
            success: function(data){
                document.getElementById("results").hidden=false;
                document.getElementById("results").innerHTML=data;

            },
            error: function(error){
                alert(error);
            }
        });
}

function reserve_clinic(med_id,spec_id)
{
    window.open("http://localhost/ekshefle/confirm_reservation.php?med_id="+med_id+
        "&spec_id="+spec_id+
        "&med_type=Clinic","_self");
}

function search_hospitals()
{
    $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/search_hospitals.php",
            data:
            {
                gov_name:document.getElementById("hgov").value, 
                city_name:document.getElementById("hcity").value,
                area_name:document.getElementById("harea").value,
                spec_name:document.getElementById("hspec").value,
                price:document.getElementById("hprice").value,
                day:document.getElementById("hday").value,
            },
            success: function(data){
                document.getElementById("results").hidden=false;
                document.getElementById("results").innerHTML=data;

            },
            error: function(error){
                alert(error);
            }
        });
}

function reserve_hospital(med_id,spec_id)
{
    window.open("http://localhost/ekshefle/confirm_reservation.php?med_id="+med_id+
        "&spec_id="+spec_id+
        "&med_type=Hospital","_self");
}

function search_labs()
{
    $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/search_labs.php",
            data:
            {
                gov_name:document.getElementById("lgov").value, 
                city_name:document.getElementById("lcity").value,
                area_name:document.getElementById("larea").value,
                lab_name:document.getElementById("lab_name").value,
                day:document.getElementById("lday").value
            },
            success: function(data){
                document.getElementById("results").hidden=false;
                document.getElementById("results").innerHTML=data;

            },
            error: function(error){
                alert(error);
            }
        });
}