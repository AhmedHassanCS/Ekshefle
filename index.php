<?php
require_once("session.php");
if(!$loggedin)
    require_once("header.html");
else
    require_once("profile/header.php");
?>

    <!--Slider-->
    <section id="slide-show">
     <div id="slider" class="sl-slider-wrapper">

        <!--Slider Items-->    
        <div class="sl-slider">
            <!--Slider Item1-->
            <div class="sl-slide item1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner" style="background: #fff;">
                    <div class="container" style="background: #fff;">
                        <img class="pull-right" src="images/sample/slider/img1.png" alt=""/>
                        <h2 style="color:#000;">هنا ستجد ضالتك</h2>
                        <h3 class="gap" style="color:#000;">يمكنك البحث بواسطة المكان والتخصص وإسم الدكتور وسعر الكشف</h3>
                        <button type="button" class="btn btn-large" style="color:#000; border:2px solid black;" href="#">إحجز الأن</button>
                    </div>
                </div>
            </div>
            <!--/Slider Item1-->

            <!--Slider Item2-->
            <div class="sl-slide item2" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                <div class="sl-slide-inner">
                    <div class="container" >
                        <img class="pull-right" src="images/sample/slider/img2.png" alt="" />
                        <h2>لا تنتظر من يدلك ولا تسأل عن الطريق</h2>
                        <h3 class="gap">سنحجز لك أينما كنت</h3>
                        <a class="btn btn-large btn-transparent" href="#">إحجز الأن</a>
                    </div>
                </div>
            </div>
            <!--Slider Item2-->

            <!--Slider Item3-->
            <div class="sl-slide item3" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner" style="background: #fff;">
                   <div class="container" style="background: #fff;">
                    <img class="pull-right" src="images/sample/slider/heart_rate.gif" alt="" />
                    <h2 style="color:#000;">صحتك تهمنا</h2>
                    <h3 class="gap" style="color:#000;">سنصلك للطبيب المناسب</h3>
                    <button type="button" class="btn btn-large" style="color:#000; border:2px solid black;" href="#">إحجز الأن</button>
                </div>
            </div>
        </div>
        <!--Slider Item3-->

    </div>
    <!--/Slider Items-->

    <!--Slider Next Prev button-->
    <nav id="nav-arrows" class="nav-arrows">
        <span class="nav-arrow-prev"><i class="icon-angle-left"></i></span>
        <span class="nav-arrow-next"><i class="icon-angle-right"></i></span> 
    </nav>
    <!--/Slider Next Prev button-->

</div>
<!-- /slider-wrapper -->           
</section>
<!--/Slider-->


<?php
require_once("footer.html");
?>


<script src="js/vendor/jquery-1.9.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- Required javascript files for Slider -->
<script src="js/slider.js"></script>
<script src="js/jquery.ba-cond.min.js"></script>
<script src="js/jquery.slitslider.js"></script>

</body>
</html>