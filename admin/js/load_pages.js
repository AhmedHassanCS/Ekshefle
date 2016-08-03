function load_requests(notif_click=false,notif_val=null)
{
    if(!notif_click){
        $("#main_container").load("tables/requests.php");
    }
    else
    {
        $("#main_container").load("tables/requests.php",function () {
        document.getElementById("request_swith").selectedIndex=1;
        document.getElementById("request_sval").value= notif_val;
        search_requests();
        });
    }
}


function load_contracts()
{
    $("#main_container").load("tables/contracts.php");
}

function load_expired(notif_click=false,notif_val=null)
{
    if(!notif_click){
        $("#main_container").load("tables/expired.php");
    }
    else{
        $("#main_container").load("tables/expired.php",function () {
        document.getElementById("expired_swith").selectedIndex=1;
        document.getElementById("expired_sval").value= notif_val;
        search_expired();        
        });
    }
}

function load_doctors()
{
    $("#main_container").load("tables/doctors.php");
}

function load_clinics()
{
    $("#main_container").load("tables/clinics.php");
}

function load_hospitals()
{
    $("#main_container").load("tables/hospitals.php");
}

function load_labs()
{
    $("#main_container").load("tables/labs.php");
}

function load_appointments(notif_click=false,notif_val=null)
{
    if(!notif_click){
        $("#main_container").load("tables/appointments.php");
    }
    else{
        $("#main_container").load("tables/appointments.php",function () {
        document.getElementById("appointment_swith").selectedIndex=1;
        document.getElementById("appointment_sval").value= notif_val;
        search_appointments();
        });    
    }
}

function load_confirmed()
{
    $("#main_container").load("tables/confirmed.php");
}

function load_patients()
{
    $("#main_container").load("tables/patients.php");
}

function load_admins()
{
    $("#main_container").load("tables/admins.php");
}