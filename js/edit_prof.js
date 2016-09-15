//doctor's name
var org_name="";
function edit_name()
{
    document.getElementById("name_btns").hidden=false;
    document.getElementById("edit_name").disabled=true;

    org_name=document.getElementById('name').innerHTML;
    document.getElementById('name').outerHTML='<div id="name">'+
    '<input style="width:10%" placeholder="Last Name" id="lname"/>'+
    '<input style="width:10%" placeholder="Middle Name" id="sname"/>'+
    '<input style="width:10%" placeholder="First Name" id="fname"/></div>';
}
function cancel_name()
{
    document.getElementById("name_btns").hidden=true;
    document.getElementById("edit_name").disabled=false;
    document.getElementById('name').outerHTML='<p id="name">'+org_name+'</p>';
}
function save_name()
{
    var fname=document.getElementById("fname").value;
    var sname=document.getElementById("sname").value;
    var lname=document.getElementById("lname").value;
    var error=document.getElementById("name_error");

    if(fname==="" || fname==null)
        error.innerHTML="First Name is required, please fill it!";
    else if(!/^[ء-ي ]+$/.test(fname))
        error.innerHTML="Invalid first name!<br>It must contain only Arabic letters";
    else if(sname==="" || sname==null)
        error.innerHTML="Second Name is required, please fill it!";
    else if(!/^[ء-ي ]+$/.test(sname))
        error.innerHTML="Invalid second name!<br>It must contain only Arabic letters";
    else if(lname==="" || lname==null)
        error.innerHTML="Last Name is required, please fill it!";
    else if(!/^[ء-ي ]+$/.test(lname))
        error.innerHTML="Invalid last name!<br>It must contain only Arabic letters";

    else 
    {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/edit_profile.php",
            data:
            {
                doc_fname:fname,
                doc_sname:sname,
                doc_lname:lname
            },
            success: function(data){
                if(data!=1)
                    error.innerHTML=data;
                else 
                {
                    org_name=fname+' '+sname+' '+lname;
                    cancel_name();
                }
            },
            error: function(error){
                alert(data);
            }
        });
    }
}

//degree
var org_degree="";
function edit_degree()
{
    document.getElementById("degree_btns").hidden=false;
    document.getElementById("edit_degree").disabled=true;

    org_degree=document.getElementById('degree').innerHTML;
    document.getElementById('degree').innerHTML='';
    document.getElementById('degree_cont').hidden=false;
}
function cancel_degree()
{
    document.getElementById("degree_btns").hidden=true;
    document.getElementById("edit_degree").disabled=false;
    document.getElementById('degree').innerHTML=org_degree;
    document.getElementById('degree_cont').hidden=true;
}
function save_degree()
{
    var degree=document.getElementById("degree_lst").value;
    var error=document.getElementById("degree_error");
    if(degree=="" || degree==null)
        error.innerHTML="degree is required, please choose it!";
    else 
        {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/edit_profile.php",
            data:
            {
                degree:degree
            },
            success: function(data){
                if(data!=1)
                    error.innerHTML=data;
                else 
                {
                    org_degree=degree;
                    cancel_degree();
                }
            },
            error: function(error){
                alert(data);
            }
        });
    }
}

//specialty
var org_spec="";
function edit_spec()
{
    document.getElementById("spec_btns").hidden=false;
    document.getElementById("edit_spec").disabled=true;

    org_spec=document.getElementById('spec').innerHTML;
    document.getElementById('spec').innerHTML='';
    document.getElementById('spec_cont').hidden=false;
}
function cancel_spec()
{
    document.getElementById("spec_btns").hidden=true;
    document.getElementById("edit_spec").disabled=false;
    document.getElementById('spec').innerHTML=org_spec;
    document.getElementById('spec_cont').hidden=true;
}
function save_spec()
{
    var specialty=document.getElementById("spec_lst").value;
    var error=document.getElementById("spec_error");
    if(specialty=="" || specialty==null)
        error.innerHTML="specialty is required, please choose it!";
    else 
    {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/edit_profile.php",
            data:
            {
                spec_id:specialty
            },
            success: function(data){
                if(data!=1)
                    error.innerHTML=data;
                else 
                {
                    org_spec=$("#spec_lst option[value='"+specialty+"']").text();
                    cancel_spec();
                }
            },
            error: function(error){
                alert(data);
            }
        });
    }
}

//address
var org_address="";
function edit_address()
{
    document.getElementById("address_btns").hidden=false;
    document.getElementById("edit_address").disabled=true;

    org_address=document.getElementById('address').innerHTML;
    document.getElementById('address').outerHTML='<input id="address"/>';
}
function cancel_address()
{
    document.getElementById("address_btns").hidden=true;
    document.getElementById("edit_address").disabled=false;
    document.getElementById('address').outerHTML='<b id="address">'+org_address+'</b>';
}
function save_address()
{
    var address=document.getElementById("address").value;
    var error=document.getElementById("address_error");
    if(address==="" || address==null)
        error.innerHTML="address is required, please fill it!";
    else if(!/^[ء-ي1-9٠-٩-, ]+$/.test(address))
        error.innerHTML="Invalid address!<br>It must contain only Arabic letters";
    else
    {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/edit_profile.php",
            data:
            {
                doc_address:address   
            },
            success: function(data){
                if(data!=1)
                    error.innerHTML=data;
                else 
                {
                    org_address=address;
                    cancel_address();
                } 

            },
            error: function(error){
                alert(data);
            }
        });
    }
}

//phone
var org_phone="";
function edit_phone()
{
    document.getElementById("phone_btns").hidden=false;
    document.getElementById("edit_phone").disabled=true;

    org_phone=document.getElementById('phone').innerHTML;
    document.getElementById('phone').outerHTML='<input id="phone"/>';
}
function cancel_phone()
{
    document.getElementById("phone_btns").hidden=true;
    document.getElementById("edit_phone").disabled=false;
    document.getElementById('phone').outerHTML='<b id="phone">'+org_phone+'</b>';
}
function save_phone()
{
    var phone=document.getElementById("phone").value;
    var error=document.getElementById("phone_error");
    if(phone==="" || phone==null)
        phone.innerHTML="phone is required, please fill it!";
    else if(!/^01[0-9]{9}$/.test(phone))
        phone.innerHTML="Invalid phone!<br>";
    else 
    {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/operations/edit_profile.php",
            data:
            {
                doc_phone:phone
            },
            success: function(data){
                if(data!=1)
                    error.innerHTML=data;
                else 
                {
                    org_phone=phone;
                    cancel_phone();
                } 
            },
            error: function(error){
                alert(data);
            }
        });
    }
}

//email
var org_email="";
function edit_email()
{
    document.getElementById("email_btns").hidden=false;
    document.getElementById("edit_email").disabled=true;

    org_email=document.getElementById('email').innerHTML;
    document.getElementById('email').outerHTML='<input id="email"/>';
}
function cancel_email()
{
    document.getElementById("email_btns").hidden=true;
    document.getElementById("edit_email").disabled=false;
    document.getElementById('email').outerHTML='<b id="email">'+org_email+'</b>';
}
function save_email()
{
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email=document.getElementById("email").value;
    var error=document.getElementById("email_error");
    if(email==="" || email==null)
        email.innerHTML="email is required, please fill it!";
    else if(!re.test(email))
        email.innerHTML="Invalid email!<br>";
    else 
    {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/profile/edits/edit_email.php",
            data:
            {
                new_email:email
            },
            success: function(data){

                alert(data);
            },
            error: function(error){
                alert(data);
            }
        });
    }
}
function send_attrib(attrib_name,attrib_value)
{
    var data={};
    data[attrib_name] = attrib_value;
    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/profile/operations/edit_profile.php",
        data:data,
        success: function(data){
            if(data!=1)
                alert(data);
            else error.innerHTML=data;
        },
        error: function(error){
            alert(data);
        }
    });
}