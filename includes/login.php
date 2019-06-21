 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <?php
include_once('../classes/Database.php');
include_once('../classes/User.php');
define('UPLOAD_DIR', 'images/');

if(isset($_POST['login_submit'])){
	extract($_POST);
	$obj = new User();
	$signed_in=($_POST['signed_in']==='Remember me') ? 1 : 0;
	
    if( $obj->processLogin( $user_email, $user_password,$signed_in) ) {
        Functions::redirect("dashboard.php");
    } else{
     ?>
     <script> Swal.fire({
  title: 'Account Login!',
  text: 'Invalid User Credentials! Please Try Again',
  type: 'warning'
})</script>
     <?php
	}
}

if(isset($_POST['check-photos'])){
	extract($_POST);
	$obj=new User();
 
	$image_parts = explode(";base64,", $image);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = UPLOAD_DIR . $user_email_faceID. '.png';
    file_put_contents($file, $image_base64);
	
	
	if($obj->loginUserWithFaceID($user_email_faceID,$image_parts[1],realpath($file))){
		unlink($file);
		 Functions::redirect("dashboard.php");
	}else{
   
    	?>
    
    	<?php	
	}
	unlink($file);
}

if(isset($_GET['p'])){

	?>
	<script>
		console.log("hi");
		document.getElementById('user_email').value=<?php echo $_GET['p']; ?>
	</script>
	<?php
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 <title>Aptifiers!</title>
  <!-- Favicon -->
  <link href="../assets/data2/images/faviconb.png" rel="icon" type="image/png">
  <!-- Fonts -->
<!--  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">-->
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
   
</head>

<body class="bg-default" >
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="">
          
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
<!--
           Collapse header 
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../../assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
-->
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">

          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
          
              <img src="../assets/img/brand/trans_white.png" />
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Or sign in with credentials</small>
              </div>
              <form role="form" method="post" action="#">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="user_email" id="user_email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="user_password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="signed_in" value="Remember me">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="login_submit" class="btn btn-primary my-4" data-toggle="modal" data-target="#myModal">Sign in</button>
                </div>
              </form>
            </div>
            <hr>
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>or Sign in using FaceID</small></div>
              <form method="POST" action="">
              <div class="btn-wrapper text-center">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="user_email_faceID" id="user_email_faceID">
                    
                  </div>
                </div>
                
              </div>
              <div class="container">
            <div class="row">
           
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
             <div class="col-md-6">
                <div id="my_camera" style="display:none"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success" name="check-photos" >Submit</button>
            </div>
        </div>
    
			</div>
           </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="changePassword.php" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="register.php" class="text-light"><small>New Here ?  Register Now!</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
<!--  Webcam Script-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
  <script src="../assets/js/web.js"></script>

</body>

</html>