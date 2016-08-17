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
<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>

<script src="/ekshefle/js/profile_elements.js"></script>

<script src="/ekshefle/admin/dist/js/app.min.js"></script>
<script src="/ekshefle/admin/plugins/select2/select2.full.min.js"></script>
<script src="/ekshefle/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/ekshefle/admin/plugins/iCheck/icheck.min.js"></script>

<script src="/ekshefle/js/main.js"></script>
<!-- Required javascript files for Slider -->


</body>
</html>