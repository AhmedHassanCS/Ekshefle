<?php

if(!$loggedin)
  header("location: /ekshefle/");
  
//echo labs square, success if active, danger if expired, warning if not published
if(is_active($doc_email,'Lab'))
    echo '<div class="alert alert-success alert-dismissible text-center">
            <h3><i class="icon fa fa-check"></i> Labs: '.$num_of_labs.'</h3>
            Your Labs are published 
            <div>
                <br>
                <input type="submit" class="btn btn-primary btn-small" value="Add Lab" />
                <input type="submit" class="btn btn-primary btn-small" value="Manage Labs" onclick="get_labs();"/>
            </div>
        </div>';
else if(is_expired($doc_email,'Lab'))
    echo '<div class="alert alert-danger alert-dismissible text-center">
            <h3><i class="icon fa fa-ban"></i> Labs: '.$num_of_labs.'</h3>
            Your contract to publish labs is expired!
            <div>
                <br>
                <input type="submit" class="btn btn-primary btn-small" value="Add Lab" />
                <input type="submit" class="btn btn-primary btn-small" value="Manage Labs" onclick="get_labs();"/>
                <input type="submit" class="btn btn-success btn-small" value="Request to Publish" />
            </div>
        </div>';

else echo '<div class="alert alert-warning alert-dismissible text-center">
                <h3><i class="icon fa fa-warning"></i> Labs: '.$num_of_labs.'</h3>
                You did not publish your labs yet!
                <div>
                    <br>
                    <input type="submit" class="btn btn-primary btn-small" value="Add Lab" />
                    <input type="submit" class="btn btn-primary btn-small" value="Manage Labs" onclick="get_labs();"/>
                    <input type="submit" class="btn btn-success btn-small" value="Request to Publish" />
                </div>
            </div>';
?>