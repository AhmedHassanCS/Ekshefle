<?php

if(!$loggedin)
  header("location: /ekshefle/");

//echo Hospitals square, success if active, danger if expired, warning if not published
if(is_active($doc_email,'Hospital'))
    echo '<div class="alert alert-success alert-dismissible text-center">
            <h3><i class="icon fa fa-check"></i> Hospitals: '.$num_of_hospitals.'</h3>
            Your Hospitals are published 
            <div>
                <br>
                <input type="submit" class="btn btn-primary btn-small" value="Add Hospital" onclick="new_hospital();"/>
            </div>
        </div>';
else if(is_requested($doc_email,'Hospital'))
    echo '<div class="alert alert-info alert-dismissible text-center">
            <h3><i class="icon fa fa-info"></i> Hospitals: '.$num_of_hospitals.'</h3>
            A request has been sent to admin, They will contact you soon.
            <div>
                <br>
                <input type="submit" class="btn btn-success btn-small" value="Add Hospital" onclick="new_hospital();"/>
            </div>
        </div>';

else if(is_expired($doc_email,'Hospital'))
    echo '<div class="alert alert-danger alert-dismissible text-center">
            <h3><i class="icon fa fa-ban"></i> Hospitals: '.$num_of_hospitals.'</h3>
            Your contract to publish hospitals is expired!
            <div>
                <br>
                <input type="submit" class="btn btn-primary btn-small" value="Add Hospital" onclick="new_hospital();"/>
                <input type="submit" class="btn btn-success btn-small" value="Request to Publish" onclick="publish_request(\'Hospital\');"/>
            </div>
        </div>';

else echo '<div class="alert alert-warning alert-dismissible text-center">
                <h3><i class="icon fa fa-warning"></i> Hospitals: '.$num_of_hospitals.'</h3>
                You did not publish your hospitals yet!
                <div>
                    <br>
                    <input type="submit" class="btn btn-primary btn-small" value="Add Hospital" onclick="new_hospital();"/>
                    <input type="submit" class="btn btn-success btn-small" value="Request to Publish" onclick="publish_request(\'Hospital\');"/>
                </div>
            </div>';
?>