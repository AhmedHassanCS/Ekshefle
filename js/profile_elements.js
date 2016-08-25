function get_clinics()
{
    //$("html, body").animate({ scrollTop: 0 }, "slow");
    $("#main_container").load("elements/clinics.php");
    window.scrollTo(0, 0);
}
function get_hospitals()
{
    $("#main_container").load("elements/hospitals.php");
    window.scrollTo(0, 0);

}
function get_labs()
{
    $("#main_container").load("elements/labs.php");
    window.scrollTo(0, 0);
}
function new_clinic()
{
    $("#main_container").load("elements/new_clinic.php");
    window.scrollTo(0, 0);
}
function new_hospital()
{
    $("#main_container").load("elements/new_hospital.php");
    window.scrollTo(0, 0);
}
function new_lab()
{
    $("#main_container").load("elements/new_lab.php");
    window.scrollTo(0, 0);
}
function edit_clinic(clinic_id)
{
    $("#main_container").load("elements/edit_clinic.php" ,{med_id:clinic_id});
}
function edit_hospital(hos_id)
{
    $("#main_container").load("elements/edit_hospital.php" ,{med_id:hos_id});
}
function delete_medical(med_id,med_name)
{
    document.getElementById("del_med_id").value=med_id;
    document.getElementById("del_med_name").value=med_name;
    $("#del_med_div").modal('toggle');
}

function confirm_del_med()
{
    var med_id=document.getElementById("del_med_id").value;

    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/profile/operations/delete_medical.php",
        data:{
            med_id : med_id
        },
        success: function(data){
            if(data!=1)
                alert(data);
            else
            {
                alert("Medical Deleted Successfully.");
                
                if($("#clinics_container").length!=0)
                    get_clinics();
                else if($("#hospitals_container").length!=0)
                    get_hospitals();
                else if($("#labs_container").length!=0)
                    get_labs();

                $("#del_med_div").modal('toggle');

            }
        },
        error: function(error){
            alert(data);
        }
    });

}
function publish_request(med_type)
{
        $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/profile/operations/make_request.php",
        data:{
            med_type : med_type
        },
        success: function(data){
            if(data!=1)
                alert(data);
            else
            {
                alert("Publish request sent successfully to admin.");
                
                if(med_type=="Clinic")
                    get_clinics();
                else if(med_type=="Hospital")
                    get_hospitals();
                else if(med_type=="Lab")
                    get_labs();

            }
        },
        error: function(error){
            alert(data);
        }
    });
}