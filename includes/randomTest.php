<?php
include_once("bootstrap.php");
session_start();

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

<body class="" style="background-color:#04456B">
   <h2 style="text-align:center;color:#fff;padding:20px;">Solve the below questions|</h2>
    
    <form method="post" action="test_scheduled.php">
        <div class="main-content">
            <!-- Header -->
<!--            <div class="header py-lg-8"></div>-->
            <?php
            $user_id = $_SESSION['user_id'];
            $obj = new Test();
            
            
            if(isset($_POST['generateRandom'])){
                extract($_POST);
                if($test_id == "new"){
                $result = $obj->countnewInsertedQuestions($user_id);
                //$res = $obj->lastInsertQuestionID($user_id);
                $array2 = array();
            $res = $obj->selectNewQuestions($user_id);
                while($row=mysqli_fetch_assoc($res)){
                    extract($row);
                    $_SESSION['chapter_id'] = $question_chapter_id;
                    array_push($array2,$questions_id);
                }
                
//                foreach($array2 as $id){
//                        echo "array2 id : ".$id." ";
//                    echo "<br>";
//                    }
                    echo "count=".count($array2);
                    echo "<br>";
                
                }
                else{
                    $result = $obj->countQuestions($test_id);
                        //here $test_id is $question_chapter_id
                $array2 = array();
                $_SESSION['chapter_id'] = $test_id;
            $res = $obj->selectOldQuestions($user_id,$test_id);
                while($row=mysqli_fetch_assoc($res)){
                    extract($row);
                    array_push($array2,$questions_id);
                }
					/*
                foreach($array2 as $id){
                        echo "array2 id : ".$id." ";
                        echo "<br>";
                    }
                    echo "count=".count($array2);*/
                    echo "<br>";
                    
                }
                if($countOfQuestions <= $result){
                    
                    //$array = array();
                    $arr = range(0, count($array2)-1);
                    shuffle($arr);
    $nonrepeatarray = array_slice($arr, 0, $countOfQuestions);
                    /*
                    foreach($nonrepeatarray as $id){
                        echo "nonrepeatarray id : ".$id." ";
                        echo "<br>";
                    }*/
					$temp=array();
					for($i=0;$i<count($nonrepeatarray);$i++){
						array_push($temp,$array2[$nonrepeatarray[$i]]);
					}
                    $_SESSION['array'] = $temp;
                
                }
                $obj = new Test();
                $k=1;
                for($j=0;$j<count($nonrepeatarray);$j++){
                    $res = $obj->getQuestionWithRandomNumber($array2[$nonrepeatarray[$j]]);
                   // echo "index=".$array[$j]." ";
                    $row = mysqli_fetch_assoc($res);
                    extract($row);
            ?>
                <!-- Page content -->
                 <div class="main-content">
		<!-- Header -->
		<div class="header" style="margin-bottom:100px;"></div>
		<!-- Page content -->
		<div class="container mt--8 pb-5">
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-7">
					<div class="card bg-secondary shadow border-0" style="border-radius:10px;background-color:#E1E2E1">
						<div class="card-header bg-transparent">
							<?php
                if($is_question_image == 1){
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['question_image']).'" width="200px" height="200px"/>';
                }
                        ?>
							<div class="">
								<p style="padding-left:20px;"id="<?php echo $questions_id;?>" ><span><?php echo $k.")";?> </span><?php echo $question_text; ?></p>
							</div>
						</div>
						<div class="card-body">
							<ul style="margin-left:0px; list-style: none;">
								<div style="width:250px;height:40px;box-shadow:5px 5px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;margin-left:20px;"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="a"><span style="color:#04456B;font-size:16px;">A.&nbsp</span><?php echo $question_option1 ?></li></div>
								<div style="width:250px;height:40px;box-shadow:5px 5px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;margin-left:20px;"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="b"><span style="color:#04456B;font-size:18px;">B.&nbsp</span><?php echo $question_option2 ?></li></div>
								<div style="width:250px;height:40px;box-shadow:5px 5px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;margin-left:20px;"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="c"><span style="color:#04456B;font-size:18px;">C.&nbsp</span><?php echo $question_option3 ?></li></div>
								<div style="width:250px;height:40px;box-shadow:5px 5px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;margin-left:20px; "><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="d"><span style="color:#04456B;font-size:18px;">D.&nbsp</span><?php echo $question_option4 ?></li></div>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
                <?php
            $k++;
}//end of loop
    }//end of if
            ?>
            <div class="container">
            <label style="color:#fff;">Name of the Test: <input type="text" name="test_name"></label>
            
        <label style="color:#fff;padding-left:10px;">Date To be conducted on: <input type="date" name="test_date"></label>
       
<!--
				<p>Start Time:</p>
				<input type="time" name="start_time">
				<p>End Time:</p>
				<input type="time" name="end_time">
-->
        <label style="color:#fff;padding-left:10px;">Class:<select name="test_class_id" id="test_division">
            <option value="1">D1</option>
            <option value="2">D2</option>
            <option value="3">D3</option>
            <option value="4">D4</option>
            <option value="5">D5</option>
            <option value="6">D6</option>
            <option value="7">D7</option>
            <option value="8">D8</option>
            <option value="9">D9</option>
            <option value="10">D10</option>
            <option value="11">D11</option>
            <option value="12">D12</option>
            <option value="13">D13</option>
            <option value="14">D14</option>
            <option value="15">D15</option>
            <option value="16">D16</option>
            <option value="17">D17</option>
            <option value="18">D18</option>
            <option value="19">D19</option>
            <option value="20">D20</option>
        </select>
        </label>
     
        <label style="color:#fff;padding-left:10px;">Test Level:  <select name="test_level" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select></label>         
      
                   
        <label style="color:#fff;padding-left:10px;">Test Level:<select name="test_division" id="">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select></label>         
        
                    <button type="submit" name="submit_test" class="btn"style="background-color:white;color:#04456B;margin-left:400px;margin-top:30px;margin-bottom:30px ">SET TEST</button>
                    <a href="<?php echo BASEURL."includes/showGeneratedTest.php "?>" class="btn" style="background-color:white;color:#04456B;margin-top:30px;margin-bottom:30px">Generate Again!</a>
        </div>
		</div>

    </form>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>
</html>
