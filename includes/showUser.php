

<?php
include_once("../classes/Session.php");
include_once("../classes/Database.php");
include_once("../classes/User.php");
Session::startSession();
$obj=new User();
$page="User Profile";
//$res=$obj->getUserWithCondition("user_id",$_SESSION['user_id']);
//$row=mysqli_fetch_assoc($res);
$res=$obj->getUserWithCondition("user_id",$_SESSION['user_id']);
if($row=mysqli_fetch_assoc($res))
	extract($row); 
if($user_role_id==5){
$res=$obj->getUserWithJoinCondition("INNER JOIN student on users.user_id = student.user_id INNER JOIN student_class on student.student_class_id=student_class.student_class_id INNER JOIN branch on student.student_branch=branch.branch_id","users.user_id",$_SESSION['user_id']);
$row=mysqli_fetch_assoc($res);
extract($row);
}
else if($user_role_id==3){
$res=$obj->getUserWithJoinCondition("INNER JOIN teacher on users.user_id = teacher.user_id INNER JOIN branch on teacher.teacher_branch_id=branch.branch_id INNER JOIN designation on teacher.teacher_designation_id=designation.designation_id","users.user_id",$_SESSION['user_id']);
$row=mysqli_fetch_assoc($res);
extract($row);
}
if(isset($_POST["edit_profile_submit"])){
	extract($_POST);
	$obj->updateUser($user_first_name,$user_last_name,$user_pincode);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Quiz Handlers</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
  <!-- Sidenav -->
  <?php include_once("templates/sidebar.php"); ?>
  <!-- Sidenav Ends here-->
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include_once("templates/topbar.php"); ?>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php echo $user_first_name." ".$user_last_name; ?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            <button name="edit_profile" id="edit_profile" onclick="enableComponents()">Edit Profile</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="data:image/jpg;base64,<?php echo $user_profile_pic; ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    
                    
                      
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $user_first_name." ".$user_last_name;; ?><span class="font-weight-light">, 27</span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $user_city; ?>, <?php echo $user_state; ?>
                </div>
                <?php
                if($user_role_id==5){
					?>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $student_class; ?><?php echo $student_division; ?>
                </div>
                 <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $branch_name; ?>
                </div>
               <?php
				}else{
					?>
					<div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $designation_name; ?>
                </div>
                 <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $branch_name; ?>
                </div>
					<?php
				}
						?>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="#" method="post">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                   
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" disabled value="<?php echo $user_email; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" name="user_first_name" disabled value="<?php echo $user_first_name; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" name="user_last_name"  disabled value="<?php echo $user_last_name; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" name="user_address"  disabled value="<?php echo $user_flat." ".$user_building." ".$user_street; ?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" name="user_city"  disabled value="<?php echo $user_city; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" disabled value="India" name="user_country" >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code" disabled  name="user_pincode"  value="<?php echo $user_pincode; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                  </div>
                </div>
                <input type="submit" name="edit_profile_submit" id="edit_profile_submit" value="Edit Profile!" style="display:none">
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
<script src="../assets/js/showUser.js"></script>
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>