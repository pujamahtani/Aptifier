<?php
include_once("../classes/Session.php");
include_once("../classes/Functions.php");
include_once("../classes/User.php");
include_once("../classes/Database.php");
global $database;
Session::startSession();
$page="GRAPHS";
$obj=new User();
$user_id=$_SESSION['user_id'];
$res=$obj->getUserWithCondition("user_id",$user_id);
if($row=mysqli_fetch_assoc($res))
	extract($row);
$user_role_id=$_SESSION['user_role'];

$data=array();
$labels=array();
if(isset($_POST['subject'])){
$res=$database->query("select count(*) as cnt,subject_name as subject from test_student inner join test on test_student.test_id=test.test_id inner join chapter on test.test_chapter_id=chapter.chapter_id inner join subject on chapter.chapter_subject_id=subject.subject_id where test_student.student_id=$user_id GROUP by subject_name");

foreach($res as $row){
	extract($row);
	array_push($data,$cnt);
	array_push($labels,$subject);
}	
	$headline="Total tests given for each sbuject(All Time)";
	$type=1;
}
else if(isset($_POST['chapter'])){
	$res=$database->query("select count(*) as cnt,chapter_name as cname from test_student inner join test on test_student.test_id=test.test_id inner join chapter on test.test_chapter_id=chapter.chapter_id WHERE test_student.student_id=$user_id GROUP by chapter.chapter_id");
$data=array();
$labels=array();
foreach($res as $row){
	extract($row);
	array_push($data,$cnt);
	array_push($labels,$cname);
}
	$headline="Total tests given for each chapter(All Time)";
	$type=2;
}
else if(isset($_POST['score'])){
	$res=$database->query("select score,test_name from test_student inner join test on test_student.test_id=test.test_id where student_id=$user_id");
foreach($res as $row){
	extract($row);
	array_push($data,$score);
	array_push($labels,$test_name);
}
	$headline=" Max score for each test taken (All Time)";
	$type=3;
}else if(isset($_POST['month'])){
	$data1=array();
	$res=$database->query("select count(*) as cnt,subject.subject_name as sname from test_student inner join test on test_student.test_id=test.test_id INNER join chapter on test.test_chapter_id=chapter.chapter_id INNER join subject on chapter.chapter_subject_id=subject.subject_id where EXTRACT(MONTH FROM test_student.created_at)=2 and student_id=$user_id GROUP by subject.subject_id");
	foreach($res as $row){
	extract($row);
	array_push($data,$cnt);
	array_push($labels,$sname);
}
	$res=$database->query("select count(*) as cnt,subject.subject_name as sname from test_student inner join test on test_student.test_id=test.test_id INNER join chapter on test.test_chapter_id=chapter.chapter_id INNER join subject on chapter.chapter_subject_id=subject.subject_id where EXTRACT(MONTH FROM test_student.created_at)=3 and student_id=$user_id GROUP by subject.subject_id");
	foreach($res as $row){
	extract($row);
	array_push($data1,$cnt);
	
}
	$headline="No of test given for each test";
	$type=4;
	?>
	<script>
		var data1 = <?php echo json_encode($data1); ?>;

	</script>
	<?php
}else if(isset($_POST['performance'])){
	$res=$database->query("SELECT score,test.test_name FROM `test_student` inner join test on test_student.test_id=test.test_id where student_id=$user_id");
	foreach($res as $row){
	extract($row);
	array_push($data,$score);
	array_push($labels,$test_name);
}
	$type=5;
	$headline="All time Overall Performance";
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
				<!-- Top navbar here -->
				<!-- Header -->
				<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
					<div class="container-fluid">
						<form action="" method="post">
							<input type="submit" name="subject" value="Subjects" class="btn" style="background:#f9f9f9;color:#04456B;margin-bottom:15px;px;">
							<input type="submit" name="chapter" value="Chapter" class="btn" style="background:#f9f9f9;color:#04456B;margin-bottom:15px;px;">
							<input type="submit" name="score" value="Score" class="btn" style="background:#f9f9f9;color:#04456B;margin-bottom:15px;px;">
							<input type="submit" name="month" value="Previous Month" class="btn" style="background:#f9f9f9;color:#04456B;margin-bottom:15px;px;">
							<input type="submit" name="performance" value="Overall Performance" class="btn" style="background:#f9f9f9;color:#04456B;margin-bottom:15px;px;">
							<div id="container" style="height:550px; width:1000px; display:none; background-color: white;">
								<?php echo $headline; ?>
								<canvas id="class"></canvas>
							</div>


						</form>
					</div>

				</div>
				<!-- Page content -->

			</div>

			<!-- Charts.js Scripts -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

			<script src="../assets/js/myChart.js"></script>
			<script>
				var type = "<?php echo $type; ?>";
				var data = <?php echo json_encode($data); ?>;
				var labels = <?php echo json_encode($labels); ?>;

				document.getElementById("container").style.display = "block";
				if (type == 1) {
					renderPieChart(data, labels, "Subjects")
				} else if (type == 2) {
					renderChart(data, labels, "bar");
				} else if (type == 3) {
					renderChart(data, labels, "horizontalBar");
				} else if (type == 4) {
					renderDoubleChart(data, data1, labels,"bar");
				} else if (type == 5) {
					renderLineChart(data, labels);
				}

			</script>
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
		?>
