<?php
include_once('../classes/Database.php');
include_once('../classes/Functions.php');
if(isset($_POST['reset_submit'])){
	global $database;
	extract($_POST);
	$user_email=$_GET['XSRS'];
	$res=$database->query("select user_id,user_password from users where user_email='$user_email'");
	if($row=mysqli_fetch_assoc($res))
		extract($row);
	$flag=0;
	if($act === "reset"){
		if(password_verify($user_password,$old_password))
			$flag=1;
	}
	if($user_new_password === $user_confirm_password){
	
		$hashed_pass=password_hash("$user_new_password",PASSWORD_BCRYPT);
		$flag=1;
	}
		if($flag==1){
		
		$database->query("UPDATE users set user_password='$hashed_pass',updated_at=now(),updated_by=$user_id where user_email='$user_email';");
		Functions::redirect('login.php');
		}
	else {
		echo "false";
	}

	
}
$act="";
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$action=explode('=',$link);
if(count($action)>2){
	$act= $action[2];
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <title>Aptifiers! | Reset Password</title>
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

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="">
          <img src="../assets/img/brand/trans_white.png" />
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
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-light">This is a place where you can test your brains!</p>
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
           
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Reset your password here!</small>
              </div>
              <form role="form" method="post" action="#">
              <?php
              if($act === "reset"){
					echo "<div class='form-group mb-3'>
                  <div class='input-group input-group-alternative'>
                    <div class='input-group-prepend'>
                      <span class='input-group-text'><i class='ni ni-email-83'></i></span>
                    </div>
                    <input class='form-control' placeholder='Old Password' type='password' name='old_password' id='old_password'>
                  </div>
                </div>";
			  }
          		?>
           		
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="New Password" type="password" name="user_new_password" id="user_new_password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirm New Password" type="password" name="user_confirm_password">
                  </div>
                </div>
              
                <div class="text-center">
                  <button type="submit" name="reset_submit" class="btn btn-primary my-4">Reset</button>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
 
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>