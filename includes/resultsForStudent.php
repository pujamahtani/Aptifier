<?php
 include_once("../classes/Session.php");
include_once("../classes/Functions.php");
include_once("../classes/User.php");
include_once("../classes/Test.php");
Session::startSession();
$page="Results";
$display=0;
$obj=new User();
$test=new Test();
$user_id=$_SESSION['user_id'];
$res=$obj->getUserWithCondition("user_id",$user_id);
if($row=mysqli_fetch_assoc($res))
	extract($row);
$user_role_id=$_SESSION['user_role'];
if(isset($_POST['tabular'])){
$results=$test->getResultsForStudent($user_id);
	$display=1;
}
if(isset($_POST['excel'])){
	$file = fopen("sample csv files/ResultsStudent.csv","w");
	$results=$test->getResultsForStudent($user_id);
	foreach ($results as $row)
  {
	extract($row);
	//fputcsv needs an source to put a file thus array you can also append it to a string and directl send it. i did it if i need to send tht data that is being saved to csv file to some other function
		 
	$list=array("$test_name,$test_date,$test_level,$score,$created_at");
//db sends an array explode needs a string implode converts array into string
  fputcsv($file,explode(',',implode(",",$list)));
  }

fclose($file);
}
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <title>Aptifiers! | Results</title>
  <!-- Favicon -->
  <link href="../assets/data2/images/faviconb.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <style>
	table, th, td {
  border: 1px solid #999;
}
	  th, td {
  padding: 15px;
  text-align: center;
}
	  tr:hover {background-color:#066FAC;
	  color:white;}
	</style>
</head>

<body>
   <!-- Sidenav -->
  <?php include_once("templates/sidebar.php"); ?>
  <!-- Sidenav Ends here-->
  
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
     <?php include_once("templates/topbar.php"); ?>
      <!-- Top navbar here -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
                              
		<form action="" method="post" >
            <div class="card-body" >
                  <div class="row" style="background:#04456B">
                    <div class="col">
                     <button name="tabular" class="btn" style="color:#04456B; background:#fff">Tabular Format</button>
                      
                    </div>
                   
                  </div>
                 
                </div>
            </form>
           <form action="" method="post">
                   <div class="card-body">
                  <div class="row" style="background:#04456B">
                    <div class="col">
                   <button name="excel" class="btn" style="color:#04456B; background:#fff">Excel Sheet</button>
                      
                    </div>
                   
                  </div>
                 
                </div>
			  </form>
<!--
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                        <a href="showGeneratedTest.php">Create Test!!</a>
                     
                    </div>
                   
                  </div>
                  
                </div>
              </div>
            </div>
-->
           
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <?php
	  if($display==1){
		  $count=1;
		  ?>
		  <br><br>
   <div id="ResultsTable" style="overflow-x:auto;">
  <table style="width:80%;margin-left:10%">
   		<tr style="background:#08476E; color:white">
   	<th>Test Sr</th>
    <th>Test Name</th> 
    <th>Test Date</th>
    <th>Test Level</th>
    <th>Test Score</th>
    <th>Test Given at</th>
  </tr>
  <?php
	  foreach($results as $result){
	  extract($result);
		  switch($test_level){
			  case 1:$level="Easy";
				  break;
				   case 2:$level="Medium";
				  break;
				   case 3:$level="Difficulty";
				  break;
		  }
	  ?>
  	<tr>
  	<td><?php echo $count++; ?></td>
    <td><?php echo $test_name; ?></td>
    <td style="width:20%;"><?php echo $test_date; ?></td>
    <td><?php echo $level; ?></td> 
    <td align="center"><?php echo $score; ?></td>
    <td style="width:30%;"><u><?php echo $created_at; ?></u></td>
  </tr>
  	<?php
	  }
	  ?>
   	</table>
   </div>
   <?php
	  }
		  ?>
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