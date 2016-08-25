 <?php 
require_once("../private/session.php");

if(!$loggedin)
    header("location: /ekshefle/");
else{ 
    require_once("/private/header.php");
}

require_once("/private/check_verified.php");
?>

<div class="box">
<?php
if($verified){
    require_once("/private/default.php");
    require_once("/private/sidebar.php");
}
?>
</div>

<div id="del_med_div" class="modal fade" style="display: none; background:#fff; width:50%;"> 
  <div class="modal-dialog">
    <div class="modal-content"> 
      
      <div class="modal-header">  
          <a class="close" data-dismiss="modal">×</a>  
          <h3>Are you sure you want to delete this Medical Institution?</h3>  
      </div>  

      <div class="modal-body"> 
        ID:
        <input type="text" id="del_med_id" disabled>
        Name:
        <input type="text" id="del_med_name" disabled>
      </div> 

      <div class="modal-footer"> 
        <input type="submit"  class="btn btn-danger" value="Delete" onclick="confirm_del_med();"/>  
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>          
  </div>                          
</div>

<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>

<script src="/ekshefle/js/profile_elements.js"></script>

<script src="/ekshefle/admin/dist/js/app.min.js"></script>
<script src="/ekshefle/admin/plugins/select2/select2.full.min.js"></script>
<script src="/ekshefle/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/ekshefle/admin/plugins/iCheck/icheck.min.js"></script>
<script src="/ekshefle/admin/plugins/pace/pace.min.js"></script>

<script src="/ekshefle/js/main.js"></script>
<!-- Required javascript files for Slider -->

<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
  $(document).ajaxError(function(event, request, settings) {alert("Can't reach server! check your connection!\n"); });

    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>
</body>
</html>