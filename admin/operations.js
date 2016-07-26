function confirm(app_id,pat_id,med_id,date)
{	
	document.getElementById('conf_app_id').value =app_id;
	document.getElementById('conf_pat_id').innerHTML =pat_id;
	document.getElementById('conf_med_id').innerHTML=med_id;
	document.getElementById('conf_date_time').value=date;
}

function cancel(app_id,pat_id,med_id)
{
	document.getElementById('cancel_app_id').value =app_id;	
	document.getElementById('cancel_pat_id').innerHTML=pat_id;
	document.getElementById('cancel_med_id').innerHTML=med_id;
}

function approve(doc_email,med_type)
{
	document.getElementById('approve_doc').value=doc_email;
	document.getElementById('approve_type').value=med_type;
}

function deny(doc_email,med_type)
{
	document.getElementById('deny_doc').value=doc_email;
	document.getElementById('deny_type').value=med_type;
}

function delete_contract(cont_code,doc_email,med_type)
{
	document.getElementById('del_cont_code').value=cont_code;
	document.getElementById('del_cont_doc').innerHTML=doc_email;
	document.getElementById('del_cont_type').innerHTML=med_type;

}

function delete_expired(cont_code,doc_email,med_type)
{
	document.getElementById('del_exp_code').value=cont_code;
	document.getElementById('del_exp_doc').innerHTML=doc_email;
	document.getElementById('del_exp_type').innerHTML=med_type;

}

function delete_doctor(doc_email)
{
	document.getElementById('del_doc_email').value=doc_email;
}

function delete_patient(pat_id)
{
		document.getElementById('del_pat_id').value=pat_id;

}