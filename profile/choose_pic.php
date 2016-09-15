 <?php 
require_once("../private/session.php");

if(!$loggedin)
    header("location: /ekshefle/");
else{ 
    require_once("/private/header.php");
}

?>
<div class="containerall" >
      <?php 
        $file_jpg=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$_SESSION["loggedin_user"].'.jpg';
        $file_png=$_SERVER['DOCUMENT_ROOT'] .'/ekshefle/images/profile_pics/'.$_SESSION["loggedin_user"].'.png';

        if(file_exists($file_jpg))
          echo '<img id="img_view" class="profileimg" src="/ekshefle/images/profile_pics/'.$_SESSION["loggedin_user"].'.jpg" 
      data-toggle="modal" data-target="#view_full_img">';
        elseif(file_exists($file_png))
          echo '<img id="img_view" class="profileimg" src="/ekshefle/images/profile_pics/'.$_SESSION["loggedin_user"].'.png" 
      data-toggle="modal" data-target="#view_full_img">';
        else
          echo '<img id="img_view" class="profileimg" src="/ekshefle/images/profile_pics/default.png" data-toggle="modal" 
      data-target="#view_full_img">';

      ?>
    <form id="uploadimage" action="" method="post" enctype="multipart/form-data"  style="text-align:center;">
      <input type="file" accept=".jpg,.png"class="btn btn-primary" id="sortpicture" name="file" style="margin:auto;">
      <br><br>
      <input type="submit" class="btn btn-success btn-block" id="upload" value="Save" name="upload" style="margin:auto; width:20%"/>
    </form>
</div>
<?php
require_once("../private/footer.html");
?>
<link rel="stylesheet" href="/ekshefle/css/profile.css">

<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>
<script src="/ekshefle/admin/plugins/pace/pace.min.js"></script>

<div id="loading_div" class="modal" style="display: none; text-align:center;"> 
  <div class="modal-dialog">
    <div class="modal-content" style="margin:auto; width:50%; height:50%;"> 
            <img src="/ekshefle/images/loading.gif"/>
    </div>          
  </div>                          
</div>
<div id="view_full_img" class="modal fade" style="display: none;"> 
  <div class="modal-dialog">
    <div class="modal-content"> 

      <div class="modal-header">  
        <a class="close" data-dismiss="modal" style="color:#fff;">×</a>  
      </div>
      <div class="modal-body">
        <?php
          if(file_exists($file_jpg))
            echo '<img id="img_full_view" style="display: block; margin-left:auto; margin-right: auto; width:220px; height:auto;" 
                src="/ekshefle/images/profile_pics/'.$_SESSION["loggedin_user"].'.jpg">';
          elseif(file_exists($file_png))
            echo '<img id="img_full_view" style="display: block; margin-left:auto; margin-right: auto; width:220px; height:auto;"
                src="/ekshefle/images/profile_pics/'.$_SESSION["loggedin_user"].'.png">';
          else
            echo '<img id="img_full_view" style="display: block; margin-left:auto; margin-right: auto; width:220px; height:auto;" 
                src="/ekshefle/images/profile_pics/default.png">';
        ?>
      </div> 
    </div>
  </div>                          
</div>
<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart();});
  $(document).ajaxStop(function() { Pace.restart();});
  $(document).ajaxError(function(event, request, settings) {alert("Can't reach server! check your connection!\n"); });

    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>

<script>

$("#uploadimage").on('submit',(function(e) {
    
    $("#loading_div").modal('show');
    e.preventDefault();
    $.ajax({
            url: "operations/upload.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
                {
                    $("#loading_div").modal('hide');
                    window.open("http://localhost/ekshefle/profile/profile.php","_self");
                },
            error: function(data)   // A function to be called if request succeeds
                {
                    $("#loading_div").modal('hide');
                    alert(data);
                }
            });
}));
function showImage(src,target) {

    var fr=new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function(e) { target.src = this.result; };
    src.addEventListener("change",function() {
    // fill fr with image data    
    fr.readAsDataURL(src.files[0]);
    });
}

var src=document.getElementById("sortpicture");
var target=document.getElementById("img_view");
showImage(src,target);
target=document.getElementById("img_full_view");
showImage(src,target);

</script>
</body>
</html>