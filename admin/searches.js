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
var patient_tbl = document.getElementById('patient_tbl');
var cln_patient = patient_tbl.cloneNode(true);
var patient_rows = cln_patient.rows;

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
		else if(val.toString().search(sval)!=-1)
			result+="<tr>"+request_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('request_tbl').innerHTML=result;
}

function search_contracts()
{
//get search value
var sval= document.getElementById('contract_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("contract_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//get search type
var stype = document.getElementById("conts_type_select");
var stype_val = stype.options[stype.selectedIndex].value;


//start creating resulting table with creating thead
result="<thead>"+contract_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<contract_rows.length;i++){
		var val= contract_rows.item(i).cells.item(swith_ix).innerHTML;

		if(stype_val!=""){
		var type= contract_rows.item(i).cells.item(3).innerHTML;
		if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val)
			result+="<tr>"+contract_rows.item(i).innerHTML+"</tr>";
		}
		else if(val.toString().search(sval)!=-1)
			result+="<tr>"+contract_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('contract_tbl').innerHTML=result;

}
function search_doctors()
{
//get search value
var sval= document.getElementById('doctor_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("doctor_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//start creating resulting table with creating thead
result="<thead>"+doctor_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<doctor_rows.length;i++){
		var val= doctor_rows.item(i).cells.item(swith_ix).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+doctor_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('doctor_tbl').innerHTML=result;
}
function search_clinics()
{
	//get search value
var sval= document.getElementById('clinic_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("clinic_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//start creating resulting table with creating thead
result="<thead>"+clinic_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<clinic_rows.length;i++){
		var val= clinic_rows.item(i).cells.item(swith_ix).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+clinic_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('clinic_tbl').innerHTML=result;
}
function search_hospitals()
{
	//get search value
var sval= document.getElementById('hospital_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("hospital_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//start creating resulting table with creating thead
result="<thead>"+hospital_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<hospital_rows.length;i++){
		var val= hospital_rows.item(i).cells.item(swith_ix).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+hospital_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('hospital_tbl').innerHTML=result;
}
function search_laps()
{
	//get search value
var sval= document.getElementById('lap_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("lap_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//start creating resulting table with creating thead
result="<thead>"+lap_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<lap_rows.length;i++){
		var val= lap_rows.item(i).cells.item(swith_ix).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+lap_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('lap_tbl').innerHTML=result;
}
function search_appointments()
{
//get search value
var sval= document.getElementById('appointment_sval').value;

	if(sval==""){
	alert("Input box is empty!");
	return;
	}
//get search with constrain
var swith = document.getElementById("appointment_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

	if(swith_ix==""){
	alert("Select what to search with!");
	return;
	}

//get search type
var stype = document.getElementById("apps_type_select");
var stype_val = stype.options[stype.selectedIndex].value;


//start creating resulting table with creating thead
result="<thead>"+appointment_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<appointment_rows.length;i++){
		var val= appointment_rows.item(i).cells.item(swith_ix).innerHTML;

		if(stype_val!=""){
		var type= appointment_rows.item(i).cells.item(6).innerHTML;
		if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val)
			result+="<tr>"+appointment_rows.item(i).innerHTML+"</tr>";
		}
		else if(val.toString().search(sval)!=-1)
			result+="<tr>"+appointment_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('appointment_tbl').innerHTML=result;

}
function search_confirmed()
{
//get search value
var sval= document.getElementById('confirmed_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("confirmed_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//start creating resulting table with creating thead
result="<thead>"+confirmed_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<confirmed_rows.length;i++){
		var val= confirmed_rows.item(i).cells.item(swith_ix).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+confirmed_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('confirmed_tbl').innerHTML=result;
}
function search_patients()
{
//get search value
var sval= document.getElementById('patient_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("patient_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//start creating resulting table with creating thead
result="<thead>"+patient_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<patient_rows.length;i++){
		var val= patient_rows.item(i).cells.item(swith_ix).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+patient_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('patient_tbl').innerHTML=result;
}

function search_expired()
{

//get search value
var sval= document.getElementById('expired_sval').value;

if(sval==""){
alert("Input box is empty!");
return;
}
//get search with constrain
var swith = document.getElementById("expired_swith");
var swith_ix = swith.options[swith.selectedIndex].value;

if(swith_ix==""){
alert("Select what to search with!");
return;
}

//get search type
var stype = document.getElementById("exp_type_select");
var stype_val = stype.options[stype.selectedIndex].value;


//start creating resulting table with creating thead
result="<thead>"+request_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<request_rows.length;i++){
		var val= request_rows.item(i).cells.item(swith_ix).innerHTML;

		if(stype_val!=""){
		var type= request_rows.item(i).cells.item(3).innerHTML;
		if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val)
			result+="<tr>"+request_rows.item(i).innerHTML+"</tr>";
		}
		else if(val.toString().search(sval)!=-1)
			result+="<tr>"+request_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('request_tbl').innerHTML=result;
}
