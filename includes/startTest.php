<?php
include_once('../classes/Detection.php');
include_once('../classes/Database.php');
include_once('../classes/Session.php');
include_once('../classes/Functions.php');
include_once('../classes/Test.php');
define('UPLOAD_DIR', 'images/');
Session::startSession();
$_SESSION['test_id']=$_GET['q'];
$test=new Test();
if($test->isTestGiven($_SESSION['user_id'],$_SESSION['test_id'])){
echo "already given test get a modal here bros";
echo "<a href='dashboard.php'>Go to dashboard</a>";
	
}
else{
	Functions::redirect("student_test.php");
//if(isset($_POST['check-photos'])){
////global $database;
////	$user_id=$_SESSION['user_id'];
////	$res=$database->query("select user_profile_pic,user_first_name from users where user_id=$user_id");
////	if($row=mysqli_fetch_assoc($res))
////		extract($row);
////   $obj=new Detection();
////    $image = $_POST['image'];
////   // $image_parts = explode(";base64,", $img);
////	$image_parts = explode(";base64,", $image);
////    $image_type_aux = explode("image/", $image_parts[0]);
////    $image_type = $image_type_aux[1];
////    $image_base64 = base64_decode($image_parts[1]);
////    $file = UPLOAD_DIR . $user_first_name. '.png';
////    file_put_contents($file, $image_base64);
////	
////	if($obj->countFaces(realpath($file))){
////		unlink($file);
////    $res=$obj->performDetection($image_parts[1],$user_profile_pic);
////	if($res['confidence']>0.4){
////
////		Functions::redirect("student_test.php");
//	}else{
//		?>
<!--   <script>window.alert("faces did not match!!");</script>-->
<?php
//	}
//	}
//	else{
//		?>
<!--		<script>window.alert("multiple faces detected!!!");</script>-->
<?php
//	}
//	echo $data->{'confidence'};


		
//}
}
?>
<!--<!DOCTYPE html>-->
<!--
<html>
<head>
    <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<style>
body {
padding-top: 1em;
}	
</style>
<body>
  
<div class="container">
    
   
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera" style="display:none"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success" name="check-photos">Submit</button>
            </div>
        </div>
    </form>
</div>
  

<script language="JavaScript" src="../assets/js/web.js">
</script>
 
</body>
</html>
-->



<!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>

<style>
body {
padding-top: 1em;
}	
</style> <div class="container-fluid">
		
<!--
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#flipFlop">
Click Me
</button>
-->

<!-- The modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="modalLabel">Capture webcam image with php and jquery - ItSolutionStuff.com</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
 <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera" style="display:none"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success" name="check-photos">Submit</button>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

</div>
		
<script language="JavaScript" src="../assets/js/web.js">
</script>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>

<!-- Initialize Bootstrap functionality -->
<script>
// Initialize tooltip component
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Initialize popover component
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>