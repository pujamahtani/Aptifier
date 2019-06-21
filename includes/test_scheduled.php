<?php
include_once("bootstrap.php");
include_once("../classes/Message.php");
include_once("../classes/Mailer.php");
session_start();
?>
   

   <?php
	include_once("../classes/Functions.php");
    $user_id = $_SESSION['user_id'];
    if(isset($_POST['submit_test'])){
        extract($_POST);
        $obj = new Test();
		$msg= new Message();
        
        
        $array = array("test_name"=>$test_name,"test_date"=>$test_date,"test_class_id"=>$test_class_id,"test_chapter_id"=>$_SESSION['chapter_id'],"test_division"=>$test_division,"test_level"=>$test_level,"created_at" => date("Y-m-d h:i:s"),"created_by"=> $user_id,"updated_at" => date("Y-m-d h:i:s"),"updated_by"=> $user_id);
       	$res2 = $obj->insert($array,"test");
		
		$res=$obj->getPhoneOfAllTestStudents("select user_phone,user_email,user_first_name,user_last_name from test inner join student on test.test_class_id=student.student_class_id inner join users on student.user_id=users.user_id where test.test_name='$test_name'");
		$name=$_SESSION['user_name'];
		$msgg="$test_name test scheduled on $test_date by Proffessor $name! Team Aptifier";
		foreach($res as $row){
			extract($row);
			$student_name=$user_first_name. " ".$user_last_name;
			$obj->sendScheduledTestMail($user_email,$student_name,$name,$test_name,$test_date);
			$msg->sendMessage("$user_phone","$msgg");
		}

        $res3 = $obj->lastTestID();
        
         foreach($_SESSION['array'] as $id){
        //$res1 = $obj->insertQuestionFromQuestionTemp($id);
        $array2 = array("test_id"=>$res3,"question_id"=>$id,"created_at" => date("Y-m-d h:i:sa"),"created_by"=> $user_id,"updated_at" => date("Y-m-d h:i:sa"),"updated_by"=> $user_id);
        $res2 = $obj->insert($array2,"test_question");
         }
        
        $res3 = $obj->deleteQuestions($user_id);
        
    }

    
    ?>
    <script>
    	window.alert('Test Scheduled');
			</script>
<?php
Functions::redirect("dashboard.php");
?>