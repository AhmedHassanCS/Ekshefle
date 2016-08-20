<?php

if(!$loggedin)
  header("location: /ekshefle/");
  
if(is_active($doc_email,'Clinic'))
    echo '<div class="alert alert-success alert-dismissible text-center">
            <h3><i class="icon fa fa-check"></i> Clinics: '.$num_of_clinincs.'</h3>
            Your clinics are published
            <div>
            <br>
                <input type="submit" class="btn btn-primary btn-small" value="Add Clinic" onclick="new_clinic();"/>
            </div>
        </div>';
else if(is_requested($doc_email,'Clinic'))
    echo '<div class="alert alert-info alert-dismissible text-center">
            <h3><i class="icon fa fa-info"></i> Clinics: '.$num_of_clinincs.'</h3>
            A request has been sent to admin, They will contact you soon.
            <div>
            <br>
                <input type="submit" class="btn btn-success btn-small" value="Add Clinic" onclick="new_clinic();"/>
            </div>
        </div>';
else if(is_expired($doc_email,'Clinic'))
    echo '<div class="alert alert-danger alert-dismissible text-center">
            <h3><i class="icon fa fa-ban"></i> Clinics: '.$num_of_clinincs.'</h3>
            Your contract to publish clinics is expired!
            <div>
                <br>
                <input type="submit" class="btn btn-primary btn-small" value="Add Clinic" onclick="new_clinic();"/>
                <input type="submit" class="btn btn-success btn-small" value="Request to Publish" onclick="publish_request(\'Clinic\');"/>
            </div>
        </div>';

else echo '<div class="alert alert-warning alert-dismissible text-center">
                <h3><i class="icon fa fa-warning"></i> Clinics: '.$num_of_clinincs.'</h3>
                You did not publish your clinics yet!
                <div>
                    <br>
                    <input type="submit" class="btn btn-primary btn-small" value="Add Clinic" onclick="new_clinic();"/>
                    <input type="submit" class="btn btn-success btn-small" value="Request to Publish" onclick="publish_request(\'Clinic\');"/>
                </div>
            </div>';
?>