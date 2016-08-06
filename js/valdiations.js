<script>

function check_email()
{
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	var user= document.getElementById('email').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('email_cont');
		var user_error= document.getElementById('email_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="email is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('email_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('email_error');
		user_error.innerHTML="";
		return true;
	}
	
	else
	{
		var user_cont= document.getElementById('email_cont');
		var user_error= document.getElementById('email_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid email";
		return false;
	}
}








function check_fname()
{
	var re = /^[ء-ي]+$/;
	var user= document.getElementById('fname').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('fname_cont');
		var user_error= document.getElementById('fname_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Name is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('fname_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('fname_error');
		user_error.innerHTML="";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('fname_cont');
		var user_error= document.getElementById('fname_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid name";
		return false;
	}
	
}
	


	
	
	
	
	
	
function check_sname()
{
	var re = /^[ء-ي]+$/;
	var user= document.getElementById('sname').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('sname_cont');
		var user_error= document.getElementById('sname_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Name is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('sname_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('sname_error');
		user_error.innerHTML="";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('sname_cont');
		var user_error= document.getElementById('sname_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid name";
		return false;
	}
	
}
	
	

	
	
	
	


function check_lname()
{
	var re = /^[ء-ي]+$/;
	var user= document.getElementById('lname').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('lname_cont');
		var user_error= document.getElementById('lname_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Name is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('lname_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('lname_error');
		user_error.innerHTML="";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('lname_cont');
		var user_error= document.getElementById('lname_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid name";
		return false;
	}
	
}


	
	
	

	
	
	
function check_pw()
{
	//var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$/;
	var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
	var user= document.getElementById('pw').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('pw_cont');
		var user_error= document.getElementById('pw_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Password is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('pw_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('pw_error');
		user_error.innerHTML="good password";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('pw_cont');
		var user_error= document.getElementById('pw_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="password should be more than 8 characters and have at least one number, one lowercase and one uppercase letter";
		return false;
	}
	
}










function check_cpw()
{
	//var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{9,}$/;
	var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
	var user= document.getElementById('pw_confirm').value;
	var user2= document.getElementById('pw').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('cpw_cont');
		var user_error= document.getElementById('cpw_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Confirming Password is required";
		return false;
	}
	
	else if (re.test(user)  && user == user2)
	{
		var user_cont= document.getElementById('cpw_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('cpw_error');
		user_error.innerHTML="passwords are matched";
		return true;
	}
	else 
	{
		var user_cont= document.getElementById('cpw_cont');
		var user_error= document.getElementById('cpw_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Passwords are not matched ";
		return false;
	}
		
}










function check_gender()
{
	//var user= document.getElementById('gender').value;
	if(document.getElementById("gender_m").checked)
	{
		return "male";	 
	}
	
	else if(document.getElementById("gender_f").checked)
	{
		return "female";
	}
	
	else 
	{
		alert("error");
		var user_cont= document.getElementById('gender');
		var user_error= document.getElementById('gender_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="you should select gender";
		return false;
		
	}	

}	










function check_degree()
{
	var user= document.getElementById('degree');
	if(user.value != "" || user.value != undefined)
	{
		var user_cont= document.getElementById('deg');
		var user_error= document.getElementById('deg_error');
		user_cont.className ='form-group has-success';
		user_error.innerHTML=" ";
		return user.value;
	}
	
	else
	{
		alert("error");
		var user_cont= document.getElementById('deg');
		var user_error= document.getElementById('deg_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="you should select degree";
		return false;
	}
	
}	










function check_spec()
{
	var user= document.getElementById('spec');
	if(user.value != "" || user.value !=undefined)
	{
		var user_cont= document.getElementById('specialty');
		var user_error= document.getElementById('spec_error');
		user_cont.className ='form-group has-success';
		user_error.innerHTML=" ";
		return user.value;
	}
	else
	{
		alert("error");
		var user_cont= document.getElementById('specialty');
		var user_error= document.getElementById('spec_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="you should select specialty";
		return false;
	}
	
}







function check_phone()
{
	var re = /^01[0-9]{9}$/;
	var user= document.getElementById('phone').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('ph_cont');
		var user_error= document.getElementById('ph_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="phone is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('ph_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('ph_error');
		user_error.innerHTML="";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('ph_cont');
		var user_error= document.getElementById('ph_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid phone";
		return false;
	}
	
}	









function check_address()
{
	var re = /[\u0600-\u06FF]/;
	var user= document.getElementById('address').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('address_cont');
		var user_error= document.getElementById('address_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="address is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('address_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('address_error');
		user_error.innerHTML="";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('address_cont');
		var user_error= document.getElementById('address_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid address it should be in arabic";
		return false;
	}
	
}	

</script>

		
		

		
		
		
		
		
		
		
		
		
		
		
