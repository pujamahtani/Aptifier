<?php
include_once("bootstrap.php");
session_start();
?>



	<html>

	<head>

		<title>Aptifiers! | Create Test</title>
		<link href="../assets/data2/images/faviconb.png" rel="icon" type="image/png">
		<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
	</head>

	<body class="" style="background-color:#04456B">
	<h2 style="text-align:center;color:#fff;padding:20px;">Generate|Test</h2>
		<div class="container mt--8 ">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-6">
					<div class="card bg-secondary shadow border-0" style="border-radius:50px;background-color:#f9f9f9;margin-top:150px;">
						<div class="card-header bg-transparent">
							<form action="randomTest.php" method="post">
							<?php
$user_id = $_SESSION['user_id'];
$obj = new Test();
$result = $obj->countnewInsertedQuestions($user_id);

    $result2 = $obj->countoldInsertedQuestions($user_id);

    while($row = mysqli_fetch_assoc($result2)){
        extract($row);
        $res = $obj->getChapterName($question_chapter_id);
        echo "<span style='margin-bottom:0px;color:#04456B;font-weight:400;font-size:15px;padding-left:20px;'>"."<b>".$total."</b>"." questions of chapter ".$res." are already present"."</span>";
        echo "<br>";   
    }

echo "<span style='margin-bottom:0px;color:#04456B;font-weight:400;font-size:15px;padding-left:20px;'>"."you inserted new "."<b>".$result."</b>"." Questions"."</span>";
//echo "you have ".$result2." Old Questions";

?>
								<label style="font-weight:400;font-size:18px;padding-top:20px;text-align:center;margin-left:80px">How many questions should your test contains?</label>
								<input type="text" name="countOfQuestions" style="margin-top:10px;margin-left:240px;width:100px;">
								<label for="" style="font-weight:400;font-size:18px;;text-align:center;padding-left:30px;">Test on: 						
              <select name="test_id" style="width:380px;height:40px;margin:20px;" id="test_id">
               <option value="" >Select one option</option>
       <?php
           if($result = $obj->countnewInsertedQuestions($user_id) > 0){
               echo "<option value='new' style='font-size:16px'>Generate Random Test on new Questions</option>";
           }
           
           $result2 = $obj->countoldInsertedQuestions($user_id);
           while($row = mysqli_fetch_assoc($result2)){
               extract($row);
//               $_SESSION['chapter_id'] = $question_chapter_id;
               $res = $obj->getChapterName($question_chapter_id);
        echo "<option value = '$question_chapter_id' type='submit' name='generateRandom' style='font-size:16px''>Generate Random Test on {$res}</option>";
           }
           
            ?>
            </select></label>
		
								<div style="margin-left:240px;"><button type="submit" name="generateRandom" class="btn btn-primary">Generate</button></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

	</html>
