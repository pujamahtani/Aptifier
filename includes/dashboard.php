<?php
include_once("bootstrap.php");
Session::startSession();
$page="Dashboard";
$test_set=0;
$obj=new User();
$test=new Test();
$user_id=$_SESSION['user_id'];
$res=$obj->getUserWithCondition("user_id",$user_id);
if($row=mysqli_fetch_assoc($res))
	extract($row);

if($user_role_id==5){
	$res=$obj->getUserWithJoinCondition("INNER JOIN student on users.user_id = student.user_id INNER JOIN student_class on student.student_class_id=student_class.student_class_id INNER JOIN branch on student.student_branch=branch.branch_id","users.user_id",$_SESSION['user_id']);
$row=mysqli_fetch_assoc($res);
extract($row);
	$res=$test->getAllTestForStudent($student_class_id,"=");		
	}


else if($user_role_id==3){
	$res=$test->getAllTestForTeacher($user_id,"=");
	if($row=mysqli_fetch_assoc($res)){
		extract($row);
	$_SESSION['test_id']=$test_id;
		$test_set=1;
	}
}
//Functions::redirect('includes/login.php');
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 
  <!-- Argon CSS -->
<!--  <link type="text/css" href="../assets/css/argon.min.css" rel="stylesheet">-->
  <link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
</head>

<body>
   <!-- Sidenav -->
  <?php include_once("templates/sidebar.php"); ?>
  
   
  
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
     <?php  include_once("templates/topbar.php"); ?>
      <!-- Top navbar here -->
    <!-- Header -->
    <?php 
	  if($user_role_id==5){
		    $cnt=$test->getTestAndScoreCount($_SESSION['user_id']);
	  if($row=mysqli_fetch_assoc($cnt))
		  extract($row);
	  $src=$test->getLastScoreAndTest($_SESSION['user_id']);{
		  if($row=mysqli_fetch_assoc($src))
			  extract($row);
	$prevsrc=$test->getPrevHighScore($_SESSION['user_id']);
		  if($row=mysqli_fetch_assoc($prevsrc))
			  extract($row);
	  }
		 ?>
    <div class="header bg-gradient-primary  pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Score</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $final_score;  ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow" style="background:green">
                        <i class="fas fa-clipboard-list"></i>
                      </div>
                    </div>
                  </div>
                 <p class="mt-3 mb-0 text-muted text-sm">
                    
                    <span class="text-nowrap">Last Score</span>
                    <span class="text-success mr-2 font-weight-bold "><b style="color:#066FAC"><?php echo $last_score; ?></b></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Tests</h5>
                      <span class="h2 font-weight-bold mb-0 "><?php  echo $testCount; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow" style="background:red">
                        <i class="fas fa-file-alt"></i>
                      </div>
                    </div>
                  </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    
                    <span class="text-nowrap">Last Test:</span>
                    <span class="text-success mr-2 font-weight-bold "><b style="color:#066FAC"><?php echo $last_test_name; ?></b></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Max Score</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $max_score; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow" style="background:yellow;">
                      <i class="fas fa-chalkboard-teacher"></i>
                      </div>
                    </div>
                  </div>
                 <p class="mt-3 mb-0 text-muted text-sm">
                    
                    <span class="text-nowrap">Last Max Score:</span>
                    <span class="text-success mr-2 font-weight-bold "><b style="color:#066FAC"><?php echo $prevscore;  ?></b></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    
                    <span class="text-nowrap">Last Test given on:</span>
     <span class="text-success mr-2 font-weight-bold "><b style="color:#066FAC"><?php  echo substr($last_test_date,0,10); ?></b></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   
    </div>
    <?php 
	  
	  }else if($user_role_id==3){
	    $cnt=$test->getTotalQuestions($_SESSION['user_id']);
	  if($row=mysqli_fetch_assoc($cnt))
		  extract($row);
	  $cTest=$test->getTotalTests($_SESSION['user_id']);{
		  if($row=mysqli_fetch_assoc($cTest))
			  extract($row);
	$cStudent=$test->getTotalStudentsWhoGaveTest($_SESSION['user_id']);
		  if($row=mysqli_fetch_assoc($cStudent))
			  extract($row);
	  }
	  ?>
	   <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-xl-0" >
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Questions</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_ques;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-white rounded-circle shadow" style="background:green;">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
         
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Tests</h5>
                      <span class="h2 font-weight-bold mb-0" style="color:"><?php echo $testCount; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-white rounded-circle shadow" style="background:red;">
                        <i class="fas fa-file-alt"></i>
                      </div>
                    </div>
                  </div>
              
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Students gave Test</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $studCount; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-white rounded-circle shadow" style="background:yellow;">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   
    </div>
	<?php 
	  }
	  
		   ?>
  
<!--hEADER ENDS HERE-->
   
<!--   Page Content-->
   <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
       <hr style="border-color:white">
     
		  <h3 style='color:white; padding-left:40px;'>LIVE TESTS</h3>

       
    
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
  
          <div class="row">
            <?php 
			  if(mysqli_num_rows($res) > 0 ){
			foreach($res as $tst){
						extract($tst);
			
           if($user_role_id==3){
			    ?>	
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" style=''>
                 <?php
					echo "<a href='showTestStatistics.php?q=$test_id'>$test_name</a>";
						echo "<p>Test Class:D$test_class_id$test_division</p>";
					
						echo "<p>Test Date:$test_date</p>";
				 $start_time=date("g:i a",strtotime(substr($start_time,10)));
				echo "<p>Test Starts at:$start_time</p>";
			
					?>
                </div>
              </div>
            </div>
         
            <?php 
			      }else if($user_role_id==5){
			   if(!$test->isTestGiven($_SESSION['user_id'],$test_id)){
			    ?>
			   <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                 <?php 
							echo "<a href='startTest.php?q=$test_id'>$test_name</a>";
						echo "<p>Test Date:$test_date</p>";
				   $start_time=date("g:i a",strtotime(substr($start_time,10)));
				echo "<p>Test Starts at:$start_time</p>";
				  
			
					?>
                </div>
              </div>
            </div>
			<?php    
		   }
		   }
			}
			  }
            ?>
           
           
           
          </div>
        </div>
      </div>
    </div>
    
<!--   UPCOOMING TESTS  SECTION HERE-->
    <?php 
	  if($user_role_id==5){
		  $res=$test->getAllTestForStudent($student_class_id,">");
	  }else($user_role_id==3){
		  $res=$test->getAllTestForTeacher($_SESSION['user_id'],">")
	  }
		  
	  
		  ?>
		  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
       <hr style="border-color:white">
		 <h3 style='color:white; padding-left:40px;'>UPCOMING TESTS</h3>

       
    
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
  
          <div class="row">
            <?php 
			  if(mysqli_num_rows($res) > 0 ){
				 	foreach($res as $tst){
						extract($tst);
				  
			?>
			   <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                 <?php
							echo "<p>Test Name:$test_name</p>";
						echo "<p>Test Date:$test_date</p>";
					  $start_time=date("g:i a",strtotime(substr($start_time,10)));
				echo "<p>Test Starts at:$start_time</p>";
			
					?>
                </div>
              </div>
            </div>
			<?php   
		   }
		   }
			
			
             ?>
           
           
           
          </div>
        </div>
      </div>
    </div>
<!--    TESTS GIVEN SECTION HERE-->
		  <?php
	  if($user_role_id==5){
		  $res=$test->getAllGivenTest($_SESSION['user_id']);
	  }else
		  $res=$test->getAllTestForTeacher($_SESSION['user_id'],"<");
	  ?>
     <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
       <hr style="border-color:white">
       <?php
       if($user_role_id==3){
		 echo "<h3 style='color:white; padding-left:40px;'>ALL TESTS</h3>";
	   }else if($user_role_id==5){
		    echo "<h3 style='color:white; padding-left:40px;'>TESTS GIVEN</h3>";
	   } ?>
       
    
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
  
          <div class="row">
            <?php 
			  if(mysqli_num_rows($res) > 0 ){
				 	foreach($res as $tst){
						extract($tst);
				  
			?>
			   <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" style="width:300px;">
                 <?php 
							echo "<p>Test Name:$test_name</p>";
						echo "<p>Test Date:$test_date</p>";
						if($user_role_id==5)
					echo "<p>Test Score:$score</p>";
			
					?>
                </div>
              </div>
            </div>
			<?php 
		   }
		   }
			
			
            ?>
           
           
          
          </div>
        </div>
      </div>
    </div>
    
<!--    TEST MISSED BY STUDENT HERE-->
   	  <?php 
	  if($user_role_id==5){
		  $res=$test->getAllTestForStudent($student_class_id,"<");
?>
     <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
       <hr style="border-color:white">
       <?php 
		  	if($user_role_id==5){
		    echo "<h3 style='color:white; padding-left:40px;'>TESTS MISSED</h3>";
	   }?>
       
    
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
  
          <div class="row">
            <?php 
			  if(mysqli_num_rows($res) > 0 ){
				 	foreach($res as $tst){
						extract($tst);
						if(!$test->isTestGiven($_SESSION['user_id'],$test_id)){
				  
			?>
			   <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" style="width:300px;">
                 <?php 
							echo "<p>Test Name:$test_name</p>";
						echo "<p>Test Date:$test_date</p>";
					
			
					 ?>
                </div>
              </div>
            </div>
			<?php    
		   }
		   }
			 }
			
			
             ?>
           
           
          
          </div>
        </div>
      </div>
    </div>
    <?php 
	  }
	  ?>
<!--    Page content ends here-->
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>