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
		user_error.innerHTML="Invalid name: it must be arabic";
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
		user_error.innerHTML="Invalid name: it must be arabic";
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
		user_error.innerHTML="Invalid name: it must be arabic";
		return false;
	}
	
}

function check_pw()
{
	//var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$/;
	var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
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
		user_error.innerHTML="Accepted Password";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('pw_cont');
		var user_error= document.getElementById('pw_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="password should be more than 8 characters\nMust contain at least one number, one lowercase and one uppercase letter";
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
		user_error.innerHTML="Password Confirmation is required";
		return false;
	}
	
	else if (re.test(user)  && user == user2)
	{
		var user_cont= document.getElementById('cpw_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('cpw_error');
		user_error.innerHTML="Passwords matching";
		return true;
	}
	else 
	{
		var user_cont= document.getElementById('cpw_cont');
		var user_error= document.getElementById('cpw_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="Passwords are not matching ";
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
		return true;
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
		return true;
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
	var re = /^[ء-ي0-9٠-٩-, ]+$/;
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
function check_birthdate()
{
	var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
	var user= document.getElementById('datepicker').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('birth_cont');
		var user_error= document.getElementById('birth_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="birth-date is required";
		return false;
	}
	
	else if (re.test(user))
	{
		var user_cont= document.getElementById('birth_cont');
		user_cont.className ='form-group has-success';
		var user_error= document.getElementById('birth_error');
		user_error.innerHTML="";
		return true;
	}

	else
	{
		var user_cont= document.getElementById('birth_cont');
		var user_error= document.getElementById('birth_error');
		user_cont.className ='form-group has-error';
		user_error.innerHTML="invalid date";
		return false;
	}
	
}	

function submit()
{
  if( check_email() && check_fname() && check_sname() && check_lname() && check_pw() && check_cpw() && check_degree() &&
      check_spec() && check_phone() && check_address() && check_gender() && check_birthdate() )
    {

	    var gender= check_gender();

	    $.ajax({
	        type: "POST",
	        url:"http://localhost/ekshefle/check_reg.php",
	        data:{doc_email: document.getElementById("email").value,
	              doc_fname: document.getElementById("fname").value,
	              doc_sname: document.getElementById("sname").value,
	              doc_lname: document.getElementById("lname").value,
	              doc_nick: document.getElementById("nickname").value,
	              doc_pw: document.getElementById("pw").value,
	              doc_pw_confirm: document.getElementById("pw_confirm").value,
	              gender: gender,
	              degree: document.getElementById("degree").value,
	              doc_phone: document.getElementById("phone").value,
	              birth_date: document.getElementById('datepicker').value,
	              doc_address: document.getElementById("address").value,
	              bio: document.getElementById("bio").value,
	              side_spec: document.getElementById("side_spec").value,
	              specialty :document.getElementById("spec").value
	              },
	        success: function(data){
	                  if(data!="1")
	                    alert(data);
	                  else { alert("You registered successfully. Now login please!"); window.open("http://localhost/ekshefle/","_self");}
	                }
	        });
  }
}
