<?php
if(!$loggedin)
  header("location: /ekshefle/");
?>
<aside class="main-sidebar" style="background:#232323;">
    <section class="sidebar">
        <ul class="sidebar-menu">
          <li><a href="#" data-toggle="tab" style="border:1px solid #8080ff; margin:2px;" onclick="get_clinics();">
            <h5><i class="fa fa-user-md"></i>  Clinics</h5>
          </a></li>

          <li><a href="#" data-toggle="tab" style="border:1px solid #8080ff; margin:2px;" onclick="get_hospitals();">
            <h5><i class="fa fa-hospital-o"></i>  Hospitals</h5>
          </a></li>

          <li><a href="#" data-toggle="tab" style="border:1px solid #8080ff; margin:2px;" onclick="get_labs();">
            <h5><i class="fa fa-hourglass-end"></i>  Analytics Labs</h5>
          </a></li>
          <br>

          <li><a href="profile.php" style="border:1px solid green; margin:2px;">
            <h5 style="color:#12ac12;"><i class="fa fa-user"></i>  View Profile as Patient</h5>
          </a></li>

          <li><a href="#" data-toggle="tab" style="border:1px solid green; margin:2px;">
            <h5 style="color:#12ac12"><i class="fa fa-cogs"></i>  Edit Profile</h5>
          </a></li>
          <br>

          <li><a href="logout.php" style="border:1px solid red; margin:2px;">
            <h5 style="color:#dd4b39"><i class="fa fa-arrow-left"></i>  Logout</h5>
          </a></li>
        </ul>
    </section>
</aside>