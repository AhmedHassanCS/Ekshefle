<?php
require_once('db/config.php');
require_once('validation.php');
require_once('test_input.php');
require_once('send_email.php');
    //checking that key is set
    if(isset($_POST['doc_email']) && isset($_POST['doc_pw']) && isset($_POST['doc_pw_confirm']) &&  
        isset($_POST['doc_fname']) && isset($_POST['doc_sname']) && isset($_POST['doc_lname']) && 
        isset($_POST['birth_date']) && isset($_POST['doc_phone']) && isset($_POST['gender']) && 
        isset($_POST['doc_address']) && isset($_POST['degree']) && isset($_POST['specialty'])
        )
    {
        //checking that value is not empty
        if (empty($_POST['doc_email']) || empty($_POST['doc_pw']) || empty($_POST['doc_pw_confirm']) ||
            empty($_POST['doc_fname']) || empty($_POST['doc_sname']) || empty($_POST['doc_lname']) || 
            empty($_POST['birth_date']) || empty($_POST['doc_phone']) || empty($_POST['gender']) || 
            empty($_POST['doc_address']) || empty($_POST['degree']) || empty($_POST['specialty'])
            )
        echo "Error: Not all required data is filled";

        else{

                //getting safe data for sql
                $doc_email = mysqli_real_escape_string($db,$_POST['doc_email']);
                $doc_pw = mysqli_real_escape_string($db,$_POST['doc_pw']);
                $doc_pw_confirm = mysqli_real_escape_string($db,$_POST['doc_pw_confirm']);
                $doc_fname = mysqli_real_escape_string($db,$_POST['doc_fname']); 
                $doc_sname = mysqli_real_escape_string($db,$_POST['doc_sname']);
                $doc_lname = mysqli_real_escape_string($db,$_POST['doc_lname']);
                $birth_date = mysqli_real_escape_string($db,$_POST['birth_date']);
                $doc_phone = mysqli_real_escape_string($db,$_POST['doc_phone']);
                $gender = mysqli_real_escape_string($db,$_POST['gender']);
                $doc_address = mysqli_real_escape_string($db,$_POST['doc_address']);
                $degree = mysqli_real_escape_string($db,$_POST['degree']);
                $specialty = mysqli_real_escape_string($db,$_POST['specialty']);

                $doc_email = test_input($doc_email);
                $doc_pw = test_input($doc_pw);
                $doc_pw_confirm = test_input($doc_pw_confirm);
                $doc_fname = test_input($doc_fname); 
                $doc_sname = test_input($doc_sname);
                $doc_lname = test_input($doc_lname);
                $birth_date = test_input($birth_date);
                $doc_phone = test_input($doc_phone);
                $gender = test_input($gender);
                $doc_address = test_input($doc_address);
                $degree = test_input($degree);
                $specialty = test_input($specialty);

                //preparing optional data
                if(isset($_POST['doc_nick']))
                {
                    $doc_nick= mysqli_real_escape_string($db,$_POST['doc_nick']);
                    $doc_nick= test_input($doc_nick);
                }
                else $doc_nick=null;

                if(isset($_POST['side_spec']))
                {
                    $side_spec= mysqli_real_escape_string($db,$_POST['side_spec']);
                    $side_spec= test_input($side_spec);
                }
                else $side_spec=null;

                if(isset($_POST['bio']))
                {
                    $bio= mysqli_real_escape_string($db,$_POST['bio']);
                    $bio= test_input($bio);
                }
                else $bio=null;

                //validations
                if (!validate_name($doc_fname) || !validate_name($doc_sname) || !validate_name($doc_lname)) {
                    echo $error;
                    exit();
                }
                elseif (!validate_email($doc_email)) {
                  echo $error; 
                  exit();
                }
                elseif (!validate_password($doc_pw,$doc_pw_confirm)) {
                  echo $error;
                  exit();
                }
                elseif(!validate_phone($doc_phone))
                {
                  echo $error;
                  exit();
                }
                else //this means validation is ended clean
                {
                    //testing email and phone existing
                    $e_exist="SELECT doc_email from doctor where doc_email= '$doc_email'";
                    $e_result= $db->query($e_exist);

                    $ph_exist="SELECT doc_email from doctor where doc_phone= '$doc_phone'";
                    $ph_result= $db->query($ph_exist);

                    if(mysqli_num_rows($e_result)>0){
                        echo "Error: Email already exists!\nLogin or press forget password.";
                        exit();
                    }
                    elseif(mysqli_num_rows($ph_result)>0)
                    {
                        $ph_owner=$ph_result->fetch_assoc();
                        $ph_owner_email=$ph_owner["doc_email"];
                        echo "Error: Another account ($ph_owner_email) owns this phone number
                        \nIf you facing a problem send it to support with the username of the phone owner
                        \nwhich is displayed above.";
                        exit();
                    }
                    else //this means that that email and phone are unique
                    {   
                        //get specialty id
                        $sepc_query="SELECT spec_id from specialty where spec_name='$specialty'";
                        $get_spec=$db->query($sepc_query);
                        $spec_row= $get_spec->fetch_assoc();
                        $spec_id=$spec_row["spec_id"];
                        
                        //creating hash
                        $hash = md5( rand(0,1000) );
                        //inserting doctor into database
                        $insert_doctor="INSERT into doctor
                                        (doc_email,doc_pw,doc_fname,doc_sname,doc_lname,birth_date,doc_phone,
                                            gender,doc_address,degree,doc_nick,side_spec,bio,spec_id,hash)
                                        values('$doc_email',sha1('$doc_email$doc_pw'),'$doc_fname',
                                                '$doc_sname','$doc_lname',
                                                STR_TO_DATE('$birth_date' ,'%m/%d/%Y'),
                                                '$doc_phone','$gender','$doc_address','$degree','$doc_nick',
                                                '$side_spec','$bio',$spec_id,'$hash')";
                        if(!$db->query($insert_doctor))
                            echo "Database Error: ".$db->error.$birth_date;
                        else {
                                if(send_email($doc_email,$hash))
                                    echo "1";
                                else {
                                    echo "Error sending verification e-mail";
                                    $db->query("DELETE from doctor where doc_email='$doc_email'");
                                }
                        }
                    }//insertion ends
                }//existance and insertion ends
        }
    }//validation and insertion ends
    else echo "Error: You did not fill all required data!";


?>