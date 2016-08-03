<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- Optionally, you can add icons to the links -->
      <!--li class="active"><a href="#"><i class="fa fa-link"></i> <span>Pending Publishing Requests</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Not confirmed patients</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>All Pateints</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>All Doctors</span></a></li>-->
      
      <li class="treeview">
        <a href="#"><i class="fa fa-user-md"></i> <span>Doctors</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" onclick="load_requests();" data-toggle="tab">Pending publishing requests</a></li>
          <li><a href="#" onclick="load_contracts();" data-toggle="tab">Running contracts</a></li>
          <li><a href="#" onclick="load_expired();" data-toggle="tab">Expired contracts</a></li>
          <li><a href="#" onclick="load_doctors();" data-toggle="tab">All doctors</a></li>

        </ul>
      </li>
      
      <li class="treeview">
        <a href="#"><i class="fa fa fa-medkit"></i> <span>Medical</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" onclick="load_clinics();" data-toggle="tab">Clinics</a></li>
          <li><a href="#" onclick="load_hospitals();" data-toggle="tab">Hospitals</a></li>
          <li><a href="#" onclick="load_labs();" data-toggle="tab">labs</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#"><i class="fa fa-odnoklassniki "></i> <span>Patients</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" onclick="load_appointments();" data-toggle="tab">Pending appointments</a></li>
          <li><a href="#" onclick="load_confirmed();" data-toggle="tab">Confirmed appointments</a></li>
          <li><a href="#" onclick="load_patients();" data-toggle="tab">All patients</a></li>
        </ul>
      </li>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>


