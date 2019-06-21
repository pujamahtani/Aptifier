<?php
include_once("bootstrap.php");
session_start();
?>
<?php
if(isset($_POST['submit_test'])){
    
    
    $score = 0;
    
    $obj = new Test();
    foreach($_POST['optradio'] as $option_num => $option_val){
//    echo $option_num." ".$option_val."<br>";
    $res = $obj->checkAnswer($option_num, $option_val);
    $score +=$res;
    }
    $test_id = $_SESSION['test_id'];
    $student_id = $_SESSION['user_id'];
    $array = array("test_id"=>$test_id,"student_id"=>$student_id,"score"=>$score, "created_at" => date("Y-m-d H:i:s"),"created_by"=> $student_id,"updated_at" => date("Y-m-d h:i:s"),"updated_by"=> $student_id);
    $res2 = $obj->insert($array,"test_student");
    //echo $test_id;
    
    echo "Your score is:".$score;
	echo "<a href='dashboard.php'>Go to dashboard</a>";

}
?>