//get original request table
var request_tbl = document.getElementById('request_tbl');
var cln_request = request_tbl.cloneNode(true);
var request_rows = cln_request.rows;

//get original contract table
var contract_tbl = document.getElementById('contract_tbl');
var cln_contract = contract_tbl.cloneNode(true);
var contract_rows = cln_contract.rows;

//get original doctor table
var doctor_tbl = document.getElementById('doctor_tbl');
var cln_doctor = doctor_tbl.cloneNode(true);
var doctor_rows = cln_doctor.rows;

//get original clinic table
var clinic_tbl = document.getElementById('clinic_tbl');
var cln_clinic = clinic_tbl.cloneNode(true);
var clinic_rows = cln_clinic.rows;

//get original hospital table
var hospital_tbl = document.getElementById('hospital_tbl');
var cln_hospital = hospital_tbl.cloneNode(true);
var hospital_rows = cln_hospital.rows;

//get original lap table
var lap_tbl = document.getElementById('lap_tbl');
var cln_lap = lap_tbl.cloneNode(true);
var lap_rows = cln_lap.rows;

//get original appoitment table
var appointment_tbl = document.getElementById('appointment_tbl');
var cln_appointment = appointment_tbl.cloneNode(true);
var appointment_rows = cln_appointment.rows;

//get original confirmed table
var confirmed_tbl = document.getElementById('confirmed_tbl');
var cln_confirmed = confirmed_tbl.cloneNode(true);
var confirmed_rows = cln_confirmed.rows;

//get original patient table
var confirmed_tbl = document.getElementById('patient_tbl');
var cln_confirmed = confirmed_tbl.cloneNode(true);
var confirmed_rows = cln_confirmed.rows;

function search_requests()
{
//get search value
var sval= document.getElementById('request_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("request_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//get search type
var stype = document.getElementById("reqs_type_select");
var stype_val = stype.options[stype.selectedIndex].value;


//start creating resulting table with creating thead
result="<thead>"+request_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<request_rows.length;i++){
		var val= request_rows.item(i).cells.item(swith_ix).innerHTML;

		if(stype_val!=""){
		var type= request_rows.item(i).cells.item(2).innerHTML;
		if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val)
			result+="<tr>"+request_rows.item(i).innerHTML+"</tr>";
		}
		else if(val.search(sval)!=-1)
			result+="<tr>"+request_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('request_tbl').innerHTML=result;
}

function search_contracts()
{

}
function search_doctors()
{

}
function search_clinics()
{

}
function search_hospitals()
{

}
function search_laps()
{

}
function search_appointments()
{

}
function search_confirmed()
{

}
function search_patients()
{

}