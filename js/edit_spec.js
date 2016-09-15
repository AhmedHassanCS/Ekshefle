var num_of_spec=0;
//array.splice(index, 1);
function put_spec_box(new_med)
{
    
    var cont=document.getElementById("spec_container");

    var spec_name= document.getElementById("specialty").value;
    var price =document.getElementById("price").value;
    var side_spec=document.getElementById("side_spec").value;
    var days;

    if( !(days= get_days()) )
        return 
    else if(price==="" || price==null)
        spec_error.innerHTML="Please Enter price.";
    else{
        index++;

        //remove this specialty from list
        $("#specialty option:selected").remove();
        spec_error.innerHTML="";
        spec_dic[""+index]={specialty:spec_name , price:price , days:days ,side_spec:side_spec};
        if(new_med)
            send_new_spec();

        $("#add_spec_div").modal('toggle');
        if(document.getElementById("error").innerHTML=="Add at least one Specialty!")
            document.getElementById("error").innerHTM="";

        var days_view="";
        if(document.getElementById("sat").checked)
            days_view+="Saturday - From: "+$("#sat_from").val()+" To: "+$("#sat_to").val()+"<br>";
        if(document.getElementById("sun").checked)
            days_view+="Sunday - From: "+$("#sun_from").val()+" To: "+$("#sun_to").val()+"<br>";
        if(document.getElementById("mon").checked)
            days_view+="Monday - From: "+$("#mon_from").val()+" To: "+$("#mon_to").val()+"<br>";
        if(document.getElementById("tues").checked)
            days_view+="Tuesday - From: "+$("#tues_from").val()+" To: "+$("#tues_to").val()+"<br>";
        if(document.getElementById("wed").checked)
            days_view+="Wednesday - From: "+$("#wed_from").val()+" To: "+$("#wed_to").val()+"<br>";
        if(document.getElementById("thurs").checked)
            days_view+="Thursday - From: "+$("#thurs_from").val()+" To: "+$("#thurs_to").val()+"<br>";
        if(document.getElementById("fri").checked)
            days_view+="Friday - From: "+$("#fri_from").val()+" To: "+$("#fri_to").val()+"<br>";

        var html='<div id="spec'+index+'" class="box box-solid box-primary" style="width:20%; margin:5px; float:left;">'+
        '<h5>Specialty Name:</h5>'+spec_name+
        '<br><h5>Days:</h5>'+days_view+
        '<h5>Price:</h5> '+price+
        '<h5>Side Specialties:</h5> '+side_spec+
        '<br><button class="btn btn-xs btn-primary" onclick="edit_spec('+index+')" data-toggle="modal" data-target="#add_spec_div">Edit</button>'+
        '<button class="btn btn-xs btn-primary" onclick="del_spec('+index+');">Delete</button></div>';
        cont.innerHTML+= html;

        num_of_spec++;
    }
}
function del_spec(index)
{  
    //remove spec div
    document.getElementById(""+index).outerHTML="";
    //add specialty again into list
    var spec_obj=spec_dic[""+index];
    $("#specialty").append("<option>"+spec_obj["specialty"]+"</option>");
    //remove specialty from spec_dic
    delete spec_dic[""+index];
    //reduce the number of spec
    num_of_spec--;
}

var edit_index=-1;
function edit_spec(id)
{
    if(edit_index!=-1)
        return;

    edit_index=id;
    document.getElementById("specialty").disabled=true;
    document.getElementById("edit_footer").hidden=false;
    document.getElementById("add_footer").hidden=true;

    var spec_obj= spec_dic[""+id];
    $("#specialty").append("<option>"+spec_obj["spec_name"]+"</option>");
    $("#specialty").val(spec_obj["spec_name"]);
    $("#price").val(spec_obj["price"]);
    $("#side_spec").val(spec_obj["side_spec"]);

    var days=spec_obj["aval_days"];
    var days=JSON.parse(days);
    set_day("sat",days);
    set_day("sun",days);
    set_day("mon",days);
    set_day("tues",days);
    set_day("wed",days);
    set_day("thurs",days);
    set_day("fri",days);

}
function set_day(day_id,days)
{
    if(days[day_id]!=undefined)
    {
        document.getElementById(day_id).checked=true;
        var details= days[day_id];
        document.getElementById(day_id+"_from").value=details["from"];
        document.getElementById(day_id+"_to").value=details["to"];
    }
    else
    {
        document.getElementById(day_id).checked=false;
        document.getElementById(day_id+"_from").value="";
        document.getElementById(day_id+"_to").value="";   
    }
}
function edit_spec_box()
{
    if(edit_index!=-1){
        //remove spec div
        document.getElementById(""+edit_index).outerHTML="";
        //remove specialty from spec_dic
        delete spec_dic[""+edit_index];
        //reduce the number of spec
        num_of_spec--;    
        put_spec_box(false);

        document.getElementById("edit_footer").hidden=true;

        document.getElementById("add_footer").hidden=false;
        document.getElementById("specialty").disabled=false;
        edit_index=-1;
    }
}

function cancel_spec_edit()
{
    if(edit_index!=-1){
        $("#add_spec_div").modal('toggle');
        document.getElementById("edit_footer").hidden=true;
        document.getElementById("add_footer").hidden=false;
        $("#specialty option:selected").remove();
        document.getElementById("specialty").disabled=false;
        edit_index=-1;
    }
}
$('#add_spec_div').on('hidden.bs.modal', function (e) {
  if(edit_index!=-1){
        document.getElementById("edit_footer").hidden=true;
        document.getElementById("add_footer").hidden=false;
        $("#specialty option:selected").remove();
        document.getElementById("specialty").disabled=false;
        edit_index=-1;
    }
})
function get_days()
{
    var spec_error= document.getElementById("spec_error");
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

    if(days==={} || JSON.stringify(days)=="{}")
        {error.innerHTML="Please choose at least one day!"; return false;}
    else return JSON.stringify(days);

}

function send_spec_edit()
{
    if(edit_index!=-1){
        var spec = spec_dic[""+edit_index];
        var spec_id=spec["spec_id"];
        var med_id= document.getElementById("med_id").value;
        var days=get_days();

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/edit_spec.php",
            data:{
                med_id:med_id,
                spec_id:spec_id,
                aval_days:days,
                price:document.getElementById("price").value,
                side_spec:document.getElementById("side_spec").value
            },
            success: function(data){
                if(data!=1)
                    alert(data);
                else 
                {
                    alert("Changed successfully.");
                    edit_spec_box();
                }
            },
            error: function(error){
                alert(data);
            }
        });
    }
}

function send_new_spec()
{
        var spec = spec_dic[""+index];
        var spec_name=spec["specialty"];
        var med_id= document.getElementById("med_id").value;
        var days=get_days();

        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/add_spec.php",
            data:{
                med_id:med_id,
                spec_name:spec_name,
                aval_days:days,
                price:document.getElementById("price").value,
                side_spec:document.getElementById("side_spec").value
            },
            success: function(data){
                if(data!=1)
                    alert(data);
                else 
                {
                    alert("Specialty Added successfully.");
                }
            },
            error: function(error){
                alert(data);
            }
        });
}

$('#add_spec_div').on('hidden.bs.modal', function (e) {
  if(edit_index!=-1){
        document.getElementById("edit_footer").hidden=true;
        document.getElementById("add_footer").hidden=false;
        $("#specialty option:selected").remove();
        document.getElementById("specialty").disabled=false;
        edit_index=-1;
    }
});