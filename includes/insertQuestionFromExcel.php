<?php
include_once("../classes/Database.php");
include_once("../classes/Session.php");
Session::startSession();
global $database;


  if (isset($_POST['upload'])) {
//	  echo "hi";
    $ok = true;
    $file = $_FILES['csv_file']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == NULL) {
      echo 'Please select a file to import';
 }
    else {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          
          $question_text = $filesop[0];
          $question_option1 = $filesop[1];
          $question_option2 = $filesop[2];
          $question_option3 = $filesop[3];
          $question_option4 = $filesop[4];
          $question_correct_answer = $filesop[5];
          $question_difficulty_level = $filesop[6];
		  $question_chapter_id = $filesop[7];
		 
		  $created_by=$_SESSION['user_id'];
      
        if ($ok) {
          $sql="INSERT INTO question(question_text,question_option1,question_option2,question_option3,question_option4,question_correct_answer,question_difficulty_level,is_question_image,question_chapter_id,created_by,is_deleted) VALUES('$question_text',$question_option1,$question_option2,$question_option3,$question_option4,'$question_correct_answer',$question_difficulty_level,0,$question_chapter_id,$created_by,0)";
      }
      if ($database->query($sql)) {

  
		  echo "You database has imported successfully!";
       
      } else {
        echo 'Sorry! There is some problem in the import file.';
 
        }
    }
  }
	
  }

?>
	<html>

	<head>
		<title>Upload Excel Sample Here</title>
		<!-- Argon CSS -->
		<link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
		 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 
	</head>

	<body style="background:#fff">
	 <!-- Sidenav -->
 

<!--

		<a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/data2/images/155120841628803503.png" width="365px" height="76px" style="margin-left:15px;"/>
      </a>
-->

		<h1 style="text-align:center; padding-top:75px;">Upload your .csv files here</h1>
		<div class="container" style="border: 1px solid #ddd; background-color: #f9f9f9; margin:0 auto;width: 400px;margin-left:550px;padding:70px;padding-left:90px;">

			<form action="" method="post" enctype="multipart/form-data">
				<input type="file" name="csv_file" style="padding-right:25px;">
				<input type="submit" name="upload" value="Press here" class="btn btn-primary" style="margin-top:25px;margin-left:40px;">
			</form>
		</div>
	</body>

	</html>
