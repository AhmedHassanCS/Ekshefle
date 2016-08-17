function on_gov_select()
{
    var gov=document.getElementById("gov").value;
    if(gov!=""){
        document.getElementById("city").disabled=false;
        document.getElementById("other_city_check").disabled=false;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_cities.php",
            data:{gov_name:gov},
            success: function(data){
                document.getElementById("city").innerHTML="<option></option>";
                document.getElementById("city").innerHTML+=data;
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
    if(gov!=""){
        document.getElementById("area").disabled=false;
        document.getElementById("other_area_check").disabled=false;

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/get_areas.php",
            data:{gov_name:gov, city_name:city},
            success: function(data){
                document.getElementById("area").innerHTML="<option></option>";
                document.getElementById("area").innerHTML+=data;
            },
            error: function(error){
                alert(error);
            }
        });
    }
    else
    {
        document.getElementById("area").disabled=true;
        document.getElementById("other_area_check").disabled=true;
    }
}

function other_city_check()
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

function other_area_check()
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

function clinic_submit()
{
    var clinic_name = document.getElementById("clinic_name").value;
    var specialty = document.getElementById("specialty").value;
    var phones = document.getElementById("phones").value;
    var address = document.getElementById("address").value;
    var error = document.getElementById("error");
    var gov_name= document.getElementById("gov");
    var city_name="";
    var area_name="";
    var days={};
    var side_spec="";

    if(clinic_name==="" || clinic_name==null)
        error.innerHTML="Clinic Name is required, please fill it!";

    else if(!/^[ء-ي1-9٠-٩_ ]+$/.test(clinic_name))
        error.innerHTML="Invalid Clinic name!<br>It must contain only Arabic characters, numbers, spaces and under scores";

    else if(specialty==="" || specialty==null)
        error.innerHTML="Specialty is required please choose it!";

    else if(phones==="" || phones==null)
        error.innerHTML="Add at least one phone for the clinic";

    else if(!/^[0-9٠-٩, ]+$/.test(phones))
        error.innerHTML="Please! check you phones again.";

    else if(address==="" || address==null)
        error.innerHTML="Clinic's address is required, please fill it!";

    else if(!/^[ء-ي0-9٠-٩-, ]+$/.test(address))
        error.innerHTML="Address must be in Arabic.";

    //location check
    else if(gov_name==="" || gov_name==null)
        error.innerHTML="Please choose governorate!";
    else{
            //get city
            if(document.getElementById("other_city_check").checked)
            {
                var other_city= document.getElementById("other_city").value;
                if(other_city==="" || other_city == null)
                    {error.innerHTML="You choose to enter other city but you didn't!"; return;}
                else city_name=other_city;
            }
            else 
            {
                city_name =document.getElementById("city").value;
                if(city_name==="" || city_name == null)
                {error.innerHTML= "Please choose city or insert new city!"; return;}         
            }
            //get area
            if(document.getElementById("other_area_check").checked)
            {
                var other_area= document.getElementById("other_area").value;
                if(other_area==="" || other_area == null)
                    {error.innerHTML="You choose to enter other area but you didn't!"; return;}
                else area_name=other_area;
            }
            else 
            {
                area_name =document.getElementById("area").value;
                if(area_name==="" || area_name == null)
                {error.innerHTML= "Please choose area or insert new area!"; return;}         
            }

    }

    //get days
    days= get_days();

    if(days!==false)
    {
        days= JSON.stringify(days);
        side_spec=document.getElementById("side_spec").value;
        //send_clinic_data(clinic_name,specialty,phones,address,gov_name,city_name,area_name,days,side_spec);
    }
}

function get_days()
{
    var days={};
    if(document.getElementById("sat").checked)
    {
        var sat_from=document.getElementById("sat_from").value;
        var sat_to=document.getElementById("sat_to").value;
        if(sat_from==="")
            {error.innerHTML="You did't specify the start time on saturdays!"; return false;}
        else if(sat_to==="")
            {error.innerHTML="You did't specify the finish time on saturdays!"; return false;}
        else
            days.sat={from:sat_from,to:sat_to};
    }
    
    if(document.getElementById("sun").checked)
    {
        var sun_from=document.getElementById("sun_from").value;
        var sun_to=document.getElementById("sun_to").value;
        if(sun_from==="")
            {error.innerHTML="You did't specify the start time on sundays!"; return false;}
        else if(sun_to==="")
            {error.innerHTML="You did't specify the finish time on sundays!"; return false;}
        else
            days.sun={from:sun_from,to:sun_to};
    }

    if(document.getElementById("mon").checked)
    {
        var mon_from=document.getElementById("mon_from").value;
        var mon_to=document.getElementById("mon_to").value;
        if(mon_from==="")
            {error.innerHTML="You did't specify the start time on mondays!"; return false;}
        else if(mon_to==="")
            {error.innerHTML="You did't specify the finish time on mondays!"; return false;}
        else
            days.mon={from:mon_from,to:mon_to};
    }

    if(document.getElementById("tues").checked)
    {
        var tues_from=document.getElementById("tues_from").value;
        var tues_to=document.getElementById("tues_to").value;
        if(tues_from==="")
            {error.innerHTML="You did't specify the start time on tuesdays!"; return false;}
        else if(tues_to==="")
            {error.innerHTML="You did't specify the finish time on tuesdays!"; return false;}
        else
            days.tues={from:tues_from,to:tues_to};
    }

    if(document.getElementById("wed").checked)
    {
        var wed_from=document.getElementById("wed_from").value;
        var wed_to=document.getElementById("wed_to").value;
        if(wed_from==="")
            {error.innerHTML="You did't specify the start time on wednesdays!"; return false;}
        else if(wed_to==="")
            {error.innerHTML="You did't specify the finish time on wednesdays!"; return false;}
        else
            days.wed={from:wed_from,to:wed_to};
    }

    if(document.getElementById("thurs").checked)
    {
        var thurs_from=document.getElementById("thurs_from").value;
        var thurs_to=document.getElementById("thurs_to").value;
        if(thurs_from==="")
            {error.innerHTML="You did't specify the start time on thursdays!"; return false;}
        else if(thurs_to==="")
            {error.innerHTML="You did't specify the finish time on thursdays!"; return false;}
        else
            days.thurs={from:thurs_from,to:thurs_to};
    }

    if(document.getElementById("fri").checked)
    {
        var fri_from=document.getElementById("fri_from").value;
        var fri_to=document.getElementById("fri_to").value;
        if(fri_from==="")
            {error.innerHTML="You did't specify the start time on fridays!"; return false;}
        else if(fri_to==="")
            {error.innerHTML="You did't specify the finish time on fridays!"; return false;}
        else
            days.fri={from:fri_from,to:fri_to};
    }

    if(days==={})
        {error.innerHTML="Please choose at least one day!"; return false;}
    else return days;

}
/*
function send_clinic_data(clinic_name,specialty,phones,address,gov_name,city_name,area_name,days,side_spec)
{
    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/profile/operations/add_medical.php",
        data:{
            med_type:'Clinic'
            med_name:clinic_name,
            specialty:specialty,
            med_phones:phones,
            detailed_add:address,
            gov_name:gov_name,
            city_name:city_name,
            area_name:area_name,
            avail_days:days,
            side_spec:side_spec
        },
        success: function(data){

        },
        error: function(error){
            alert(error);
        }
    });
}
*/