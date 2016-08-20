function on_gov_select()
{
    var gov=document.getElementById("gov").value;
    if(gov!=""){
        document.getElementById("city").disabled=false;
        document.getElementById("other_city_check").disabled=false;
        document.getElementById("other_city_check").checked=false;
        document.getElementById("other_area_check").checked=false;
        document.getElementById("other_city").disabled=true;
        document.getElementById("other_area").disabled=true;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_cities.php",
            data:{gov_name:gov},
            success: function(data){
                document.getElementById("city").innerHTML="<option value=''></option>";
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
        document.getElementById("other_city_check").disabled=true;
    }
}

function on_city_select()
{
    var gov=document.getElementById("gov").value;
    var city=document.getElementById("city").value;
    if(city!=""){
        document.getElementById("area").disabled=false;
        document.getElementById("other_area_check").disabled=false;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_areas.php",
            data:{gov_name:gov, city_name:city},
            success: function(data){
                document.getElementById("area").innerHTML="<option value=''></option>";
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
        document.getElementById("other_area_check").disabled=true;
    }
}

function other_city_checked()
{
    if(document.getElementById("other_city_check").checked)
    {
        document.getElementById("city").disabled=true;
        document.getElementById("area").disabled=true;

        document.getElementById("other_area_check").checked=true;
        document.getElementById("other_area_check").disabled=true;
        document.getElementById("other_area").disabled=false;
        document.getElementById("other_city").disabled=false;

    }
    else 
    {
        on_gov_select();
        document.getElementById("other_city").disabled=true;
        document.getElementById("area").disabled=true;
        document.getElementById("other_area_check").checked=false;
        document.getElementById("other_area_check").disabled=true;
        document.getElementById("other_area").disabled=true; 
    }
}

function other_area_checked()
{
    if(document.getElementById("other_area_check").checked)
    {
        document.getElementById("area").value="";
        document.getElementById("area").disabled=true;
        document.getElementById("other_area").disabled=false; 
    }
    else
    {
        document.getElementById("area").disabled=false;
        document.getElementById("other_area").disabled=true;   
    }
}
