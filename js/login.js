function login()
{
    var email= document.getElementById("login_email").value;
    var pw= document.getElementById("login_pw").value;
    var error= document.getElementById("login_error");
    if(email!=="" && pw!==""){

        $.ajax({
                type: "POST",
                url:"http://localhost/ekshefle/login.php",
                data:{
                    email:email, 
                    pw:pw
                    },
                success: function(data){
                          if(data!="1")
                           error.innerHTML=data;
                          else {window.open("http://localhost/ekshefle/profile/","_self");}
                        }
                });
    }
    else error.innerHTML="Fill login information!";
}