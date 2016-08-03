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
		var swith_val = swith.options[swith.selectedIndex].value;

		if(swith_val==""){
			alert("Select what to search with!");
			return;
		}

		//get search type
		var stype = document.getElementById("reqs_type_select");
		var stype_val = stype.options[stype.selectedIndex].value;

	//start creating resulting table with creating thead
	result="<thead>"+request_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<request_rows.length;i++){
		var val= request_rows.item(i).cells.item(swith_val).innerHTML;

		if(stype_val!=""){
			var type= request_rows.item(i).cells.item(2).innerHTML;
			if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val.toLowerCase())
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//get search type
	var stype = document.getElementById("conts_type_select");
	var stype_val = stype.options[stype.selectedIndex].value;


	//start creating resulting table with creating thead
	result="<thead>"+contract_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<contract_rows.length;i++){
		var val= contract_rows.item(i).cells.item(swith_val).innerHTML;

		if(stype_val!=""){
			var type= contract_rows.item(i).cells.item(3).innerHTML;
			if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val.toLowerCase())
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//start creating resulting table with creating thead
	result="<thead>"+doctor_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<doctor_rows.length;i++){
		var val= doctor_rows.item(i).cells.item(swith_val).innerHTML;
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//start creating resulting table with creating thead
	result="<thead>"+clinic_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<clinic_rows.length;i++){
		var val= clinic_rows.item(i).cells.item(swith_val).innerHTML;
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//start creating resulting table with creating thead
	result="<thead>"+hospital_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<hospital_rows.length;i++){
		var val= hospital_rows.item(i).cells.item(swith_val).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+hospital_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('hospital_tbl').innerHTML=result;
}
function search_labs()
{
	//get search value
	var sval= document.getElementById('lab_sval').value;

	if(sval==""){
		alert("Input box is empty!");
		return;
	}
	//get search with constrain
	var swith = document.getElementById("lab_swith");
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//start creating resulting table with creating thead
	result="<thead>"+lab_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<lab_rows.length;i++){
		var val= lab_rows.item(i).cells.item(swith_val).innerHTML;
		 if(val.toString().search(sval)!=-1)
			result+="<tr>"+lab_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('lab_tbl').innerHTML=result;
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
	var swith_val = swith.options[swith.selectedIndex].value;

		if(swith_val==""){
			alert("Select what to search with!");
			return;
		}

	//get search type
	var stype = document.getElementById("apps_type_select");
	var stype_val = stype.options[stype.selectedIndex].value;


	//start creating resulting table with creating thead
	result="<thead>"+appointment_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<appointment_rows.length;i++){
		var val= appointment_rows.item(i).cells.item(swith_val).innerHTML;

		if(stype_val!=""){
		var type= appointment_rows.item(i).cells.item(6).innerHTML;
		if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val.toLowerCase())
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//start creating resulting table with creating thead
	result="<thead>"+confirmed_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<confirmed_rows.length;i++){
		var val= confirmed_rows.item(i).cells.item(swith_val).innerHTML;
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//start creating resulting table with creating thead
	result="<thead>"+patient_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<patient_rows.length;i++){
		var val= patient_rows.item(i).cells.item(swith_val).innerHTML;
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
	var swith_val = swith.options[swith.selectedIndex].value;

	if(swith_val==""){
		alert("Select what to search with!");
		return;
	}

	//get search type
	var stype = document.getElementById("exp_type_select");
	var stype_val = stype.options[stype.selectedIndex].value;


	//start creating resulting table with creating thead
	result="<thead>"+expired_rows.item(0).innerHTML+"</thead><tbody>";

	for(var i=1;i<expired_rows.length;i++){
		var val= expired_rows.item(i).cells.item(swith_val).innerHTML;

		if(stype_val!=""){
			var type= expired_rows.item(i).cells.item(3).innerHTML;
			if(val.toString().toLowerCase().search(sval.toLowerCase())!=-1 && type.toLowerCase()==stype_val.toLowerCase())
				result+="<tr>"+expired_rows.item(i).innerHTML+"</tr>";
			}
			else if(val.toString().search(sval)!=-1)
				result+="<tr>"+expired_rows.item(i).innerHTML+"</tr>";
	}
	result+="</tbody>";
	document.getElementById('expired_tbl').innerHTML=result;
}
