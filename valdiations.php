<script>
function check_user()
{
	var user= document.getElementById('username').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('user_cont');
		var user_error= document.getElementById('user_error');
		user_cont.className +=' has-error';
		user_error.innerHTML="short username";
	
	}
	
	

}

function check_user2()
{
	var user= document.getElementById('username2').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('user_cont2');
		var user_error= document.getElementById('user_error2');
		user_cont.className +=' has-error';
		user_error.innerHTML="short username2";
	}

}



function check_fname()
{
	var user= document.getElementById('fname').value;
	if(user == null || user == "")
	{
		var user_cont= document.getElementById('name_cont');
		var user_error= document.getElementById('fname_error');
		user_cont.className +=' has-error';
		user_error.innerHTML="short fname";
	}
}















</script>





function validateForm() 
{
    var x = document.forms["myForm"]["fname"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}


http://www.javascript-coder.com/html-form/javascript-form-validation.phtml