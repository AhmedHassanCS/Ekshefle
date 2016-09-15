function patient_exist()
{
    if(first_validate()){
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/patient_exist.php",
            data:
            {
                pat_id:document.getElementById("pat_id").value
            },
            success: function(data){
                if(data=="1")
                    reserve(true);
                else if(data=="0")
                {
                    $("#add_patient").modal('toggle');
                }
                else alert(data);

            },
            error: function(error){
                alert(error);
            }
        });
    }
}
function add_patient()
{
    if(last_validate())
    {
        $.ajax({
            type: "POST",
            url:"http://localhost/ekshefle/add_patient.php",
            data:
            {
                pat_id:document.getElementById("pat_id").value,
                pat_name:document.getElementById("name").value,
                pat_phone:document.getElementById("phone").value,
                pat_address:document.getElementById("address").value,
                pat_email:document.getElementById("email").value
            },
            success: function(data){
                if(data=="1")
                    reserve(false);
                else alert(data);

            },
            error: function(error){
                alert(error);
            }
        });
    }
}
function reserve(old)
{
    
    $.ajax({
        type: "POST",
        url:"http://localhost/ekshefle/reserve.php",
        data:
        {
            pat_id:document.getElementById("pat_id").value,
            med_id:med_id,
            spec_id:spec_id,
            date:document.getElementById("datepicker").value
        },
        success: function(data){
            if(data=="1")
            {
                alert("تم طلب الحجز بنجاح وستصلك رسالة تأكيد إذا كان الحجز متوفراً");
                window.open("http://localhost/ekshefle/","_self");
            }
            else alert(data);

        },
        error: function(error){
            alert(error);
        }
    });

}
function first_validate()
{

    if(validate_pat_id() && validate_date() )
        return true;
    else return false;
}
function last_validate()
{
    if(validate_name() && validate_phone() && validate_address() &&validate_email )
        return true;
    else return false;
}
function validate_pat_id()
{
    var pat_id=document.getElementById("pat_id").value;
    if(pat_id=="" || pat_id==null)
    {
        document.getElementById("pat_id").style="border:solid red;";
        document.getElementById("ferror").innerHTML="يجب إدخال رقم البطاقة";
        return false;
    }
    else if(!/^[0-9]{14}$/.test(pat_id))
    {
        document.getElementById("pat_id").style="border:solid red;";
        document.getElementById("ferror").innerHTML="تأكد من رقم البطاقة";
        return false;
    }
    else
    {
        document.getElementById("pat_id").style="border:solid green;";
        document.getElementById("ferror").innerHTML="";
        return true;
    }
}
function validate_date()
{
    var date=document.getElementById("datepicker").value;
    if(date=="" || date==null)
    {
        document.getElementById("datepicker").style="border:solid red;";
        document.getElementById("ferror").innerHTML="يجب إدخال تاريخ الحجز المرغوب فيه";
        return false;
    }
    else if(!/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/.test(date))
    {
        document.getElementById("datepicker").style="border:solid red;";
        document.getElementById("ferror").innerHTML="تأكد من تاريخ الحجز";
        return false;
    }
    else
    {
        document.getElementById("datepicker").style="border:solid green;";
        document.getElementById("ferror").innerHTML="";
        return true;
    }
}
function validate_name()
{
    var name=document.getElementById("name").value;
    if(name=="" || name==null)
    {
        document.getElementById("name").style="border:solid red;";
        document.getElementById("serror").innerHTML="يجب إدخال إسم المريض";
        return false;
    }
    else if(!/^[ء-ي ]+$/.test(name))
    {
        document.getElementById("name").style="border:solid red;";
        document.getElementById("serror").innerHTML="تأكد من إسم المريض، يجب ان يكون بالعربية";
        return false;
    }
    else
    {
        document.getElementById("name").style="border:solid green;";
        document.getElementById("serror").innerHTML="";
        return true;
    }
}
function validate_phone()
{
    var phone=document.getElementById("phone").value;
    if(phone=="" || phone==null)
    {
        document.getElementById("phone").style="border:solid red;";
        document.getElementById("serror").innerHTML="يجب إدخال رقم الهاتف";
        return false;
    }
    else if(!/^[0-9]{11}$/.test(phone))
    {
        document.getElementById("phone").style="border:solid red;";
        document.getElementById("serror").innerHTML="تأكد من رقم الهاتف";
        return false;
    }
    else
    {
        document.getElementById("phone").style="border:solid green;";
        document.getElementById("serror").innerHTML="";
        return true;
    }
}
function validate_address()
{
    var address=document.getElementById("address").value;
    if(address=="" || address==null)
    {
        document.getElementById("address").style="border:solid red;";
        document.getElementById("serror").innerHTML="يجب إدخال العنوان";
        return false;
    }
    else if(!/^[ء-ي ,-_]+$/.test(address))
    {
        document.getElementById("address").style="border:solid red;";
        document.getElementById("serror").innerHTML="تأكد من العنوان، يجب ان يكون بالعربية";
        return false;
    }
    else
    {
        document.getElementById("address").style="border:solid green;";
        document.getElementById("serror").innerHTML="";
        return true;
    }
}

function validate_email()
{
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email=document.getElementById("email").value;
    if(!re.test(email))
    {
        document.getElementById("email").style="border:solid red;";
        document.getElementById("serror").innerHTML="تأكد من البريد الإلكتروني";
        return false;
    }
    else
    {
        document.getElementById("email").style="border:solid green;";
        document.getElementById("serror").innerHTML="";
        return true;
    }
}