 <?php 
require_once("../session.php");

if(!$loggedin)
    header("location: /ekshefle/");
else 
    require_once("header.php");
?>

<div class="content-wrapper">
<?php
require_once("check_verified.php");
if($verified)
    require_once("default.php");
?>
</div>

<?php
if($verified)
{
    require_once("sidebar.php");
}
require_once("../footer.html");
?>

<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>
<script src="/ekshefle/js/main.js"></script>
<script src="/ekshefle/admin/dist/js/app.min.js"></script>

<!-- Required javascript files for Slider -->


</body>
</html>