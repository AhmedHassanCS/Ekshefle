var org_name="";
var org_spec="";
var org_phones="";
var org_address="";
var org_price="";
var org_side="";

function edit_name()
{
    org_name = document.getElementById('clinic_name').value;
    document.getElementById('clinic_name').disabled= false;
    document.getElementById('name_btns').hidden = false;
    document.getElementById('edit_name').disabled= true;
}
function cancel_name()
{
    document.getElementById('clinic_name').value = org_name;
    document.getElementById('clinic_name').disabled= true;
    document.getElementById('name_btns').hidden = true;
    document.getElementById('edit_name').disabled= false;
}
function edit_spec()
{
    org_spec = $("#specialty").val();
    document.getElementById('specialty').disabled= false;
    document.getElementById('spec_btns').hidden = false;
    document.getElementById('edit_spec').disabled= true;
}
function cancel_spec()
{
    $("#specialty").val(org_spec);
    document.getElementById('specialty').disabled= true;
    document.getElementById('spec_btns').hidden = true;
    document.getElementById('edit_spec').disabled= false;
}
function edit_phones()
{
    org_phones = $("#phones").val();
    document.getElementById('phones').disabled= false;
    document.getElementById('phones_btns').hidden = false;
    document.getElementById('edit_phones').disabled= true;
}
function cancel_phones()
{
    $("#phones").val(org_phones);
    document.getElementById('phones').disabled= true;
    document.getElementById('phones_btns').hidden = true;
    document.getElementById('edit_phones').disabled= false;
}
function edit_address()
{
    org_address = $("#address").val();
    document.getElementById('address').disabled= false;
    document.getElementById('address_btns').hidden = false;
    document.getElementById('edit_address').disabled= true;
}
function cancel_address()
{
    $("#address").val(org_address);
    document.getElementById('address').disabled= true;
    document.getElementById('address_btns').hidden = true;
    document.getElementById('edit_address').disabled= false;
}
function edit_price()
{
    org_price = $("#price").val();
    document.getElementById('price').disabled= false;
    document.getElementById('price_btns').hidden = false;
    document.getElementById('edit_price').disabled= true;
}
function cancel_price()
{
    $("#price").val(org_price);
    document.getElementById('price').disabled= true;
    document.getElementById('price_btns').hidden = true;
    document.getElementById('edit_price').disabled= false;
}
function edit_side()
{
    org_side = $("#side_spec").val();
    document.getElementById('side_spec').disabled= false;
    document.getElementById('side_btns').hidden = false;
    document.getElementById('edit_side').disabled= true;
}
function cancel_side()
{
    $("#side_spec").val(org_side);
    document.getElementById('side_spec').disabled= true;
    document.getElementById('side_btns').hidden = true;
    document.getElementById('edit_side').disabled= false;
}

//save functions
function save_name()
{
    var clinic_name=document.getElementById("clinic_name").value;
    var error=document.getElementById("name_error");
    if(clinic_name==="" || clinic_name==null)
        error.innerHTML="Clinic Name is required, please fill it!";
    else if(!/^[ء-ي1-9٠-٩_ ]+$/.test(clinic_name))
        error.innerHTML="Invalid Clinic name!<br>It must contain only Arabic characters, numbers, spaces and under scores";
    else send_attrib('med_name',clinic_name);
}
function save_spec()
{
    var specialty=document.getElementById("specialty").value;
    var error=document.getElementById("specialty_error");
    if(specialty=="" || specialty==null)
        error.innerHTML="specialty is required, please choose it!";
    else send_attrib('spec_id',specialty);
}
function save_phones()
{
    var phones=document.getElementById("phones").value;
    var error=document.getElementById("phones_error");
    
    if(phones==="" || phones==null)
        error.innerHTML="Add at least one phone for the clinic";

    else if(!/^[0-9٠-٩, ]+$/.test(phones))
        error.innerHTML="Invalid Phone! check your phones again.";
    
    else send_attrib('phones',phones);
}
function save_address()
{
    var address=document.getElementById("address").value;
    var error=document.getElementById("address_error");
    
    if(address==="" || address==null)
        error.innerHTML="Clinic's address is required, please fill it!";

    else if(!/^[ء-ي0-9٠-٩-, ]+$/.test(address))
        error.innerHTML="Address must be in Arabic.";
    
    else send_attrib('detailed_add',address);
}
function save_price()
{
    var price=document.getElementById("price").value;
    var error=document.getElementById("price_error");
    
    if(price==="" || price==null)
        error.innerHTML="Price is required, please fill it!";

    else if(!/^[0-9٠-٩.]+$/.test(price))
        error.innerHTML="Price is only numbers.";
    
    else send_attrib('price',price);
}
function save_side()
{
    var side_spec=document.getElementById("side_spec").value;
    var error=document.getElementById("side_error");
    
    send_attrib('side_spec',side_spec);
}

function save_days()
{
    var days={};
    var error= document.getElementById("days_error");
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

    if(days==={} || JSON.stringify(days)==="{}")
        {error.innerHTML="Please choose at least one day!"; return false;}
    else 
    {
        send_attrib('aval_days',JSON.stringify(days));
        error.innerHTML="";
    }
}

function save_location()
{
    var error=document.getElementById("loc_error");
    var gov_name=document.getElementById("gov").value;
    var city_name="";
    var area_name="";
    if(gov_name=="" || gov_name==null)
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

            send_location(gov_name,city_name,area_name);
    }
}
function send_attrib(attrib_name,attrib_value)
{
    var med_id= document.getElementById("med_id").value;
    var data={};
    data[attrib_name] = attrib_value;
    data['med_id'] = med_id;
    var success=true;
    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/profile/operations/edit_medical.php",
        data:data,
        success: function(data){
            if(data!=1)
                alert(data);
            else 
            {
                alert("Changed successfully.");
                if(attrib_name=="med_name")
                {
                    org_name=attrib_value;
                    cancel_name();
                }
                else if(attrib_name=="spec_id")
                {
                    org_spec=attrib_value;
                    cancel_spec();
                }
                else if(attrib_name=="phones")
                {
                    org_phones=attrib_value;
                    cancel_phones();
                }
                else if(attrib_name=="detailed_add")
                {
                    org_address=attrib_value;
                    cancel_address();
                }
                else if(attrib_name=="price")
                {
                    org_price=attrib_value;
                    cancel_price();
                }
                else if(attrib_name=="side_spec")
                {
                    org_side=attrib_value;
                    cancel_side();
                }
            }
        },
        error: function(error){
            alert(data);
        }
    });
    
}
function send_location(gov_name,city_name,area_name)
{
    var med_id= document.getElementById("med_id").value;
    var data={};

    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/profile/operations/edit_medical.php",
        data:{
            med_id : med_id,
            gov_name : gov_name,
            city_name : city_name,
            area_name : area_name
        },
        success: function(data){
            if(data!=1)
                alert(data);
            else
            {
                alert("Location Changed Successfully.");
                if($("#edit_clinic_div").length!=0)
                    edit_clinic(med_id);
                else if($("#edit_hospital_div").length!=0)
                    edit_hospital(med_id);
                else if($("#edit_lab_div").length!=0)
                    edit_lab(med_id);
            }
        },
        error: function(error){
            alert(data);
        }
    });
    
}
