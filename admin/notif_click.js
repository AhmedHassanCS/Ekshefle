
function req_click(username)
{
document.getElementById("request_swith").selectedIndex=1;
document.getElementById("request_sval").value= username;
search_requests();
}

function app_click(nat_id)
{
document.getElementById("appointment_swith").selectedIndex=1;
document.getElementById("appointment_sval").value= nat_id;
search_appointments();
}

function exp_click(username)
{
document.getElementById("expired_swith").selectedIndex=1;
document.getElementById("expired_sval").value= username;
search_expired();
}