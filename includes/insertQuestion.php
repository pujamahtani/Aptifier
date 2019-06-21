<?php
include_once("bootstrap.php");
Session::startSession();
?>

<?php
$user_id = $_SESSION['user_id'];
//echo $user_id;
//$array_chapters_id = array();    
//    foreach($chapters as $chapters_id){
//        array_push($array_chapters_id,$chapters_id);
//    }
//    $_SESSION['array_chapters_id'] = $array_chapters_id;

if(isset($_POST['submit_question'])){
    extract($_POST);
    $db = new Database();
    $chapter_id = $_POST['chapter_id'];
    $subject_name = $_POST['subject_name'];
   $question_text = mysqli_real_escape_string($db->getConnection(),$question_text);
   if($_FILES['question_image']['error'] != 0) {
    
    $question_image="none";
    $is_question_image = 0;
    }
    else{ 
        
    $question_image = addslashes(file_get_contents($_FILES["question_image"]["tmp_name"]));

           $is_question_image = 1;

    }
    $bool = TRUE;
    $array = array("question_text"=>$question_text, "question_image"=>$question_image, "question_option1"=>$question_option1, "question_option2"=>$question_option2, "question_option3"=>$question_option3, "question_option4"=>$question_option4, "question_correct_answer"=>$question_correct_answer,"question_difficulty_level"=>$question_difficulty_level, "is_question_image"=>$is_question_image,"question_chapter_id"=> $chapter_id, "created_at" => date("Y-m-d H:i:s"),"created_by"=> $user_id,"updated_at" => date("Y-m-d h:i:s"),"updated_by"=> $user_id);
    
    $obj = new Test();
    if(strcmp($question_option1,$question_option2) == 0){
        $bool = FALSE;
    }
    if(strcmp($question_option1,$question_option2) == 0){
        $bool = FALSE;
    }
    if(strcmp($question_option1,$question_option3) == 0){
        $bool = FALSE;
    }
    if(strcmp($question_option1,$question_option4) == 0){
        $bool = FALSE;
    }
    if(strcmp($question_option2,$question_option3) == 0){
        $bool = FALSE;
    }
    if(strcmp($question_option2,$question_option4) == 0){
        $bool = FALSE;
    }
    if(strcmp($question_option3,$question_option4) == 0){
        $bool = FALSE;
    }
    if($bool){
    $obj->insert($array, "question");
    }
    else{
        ?>
        
        <script>window.alert("Two Mcq Cannot Have Same Answers!");</script>
        <?php
    }
}


if(isset($_POST['finish_inserting_question'])){
    Functions::redirect('showGeneratedTest.php');
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

    <body class="" style="background:#04456B">
       
<!--
        <div class="container-fluid">
             
            <a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/img/brand/logo_blue.png" width="225px" height="73px" style="margin-left:15px;"/>
      </a>
        </div>
-->
        
        <h2 style="text-align: center; padding-top: 30px; padding-left:10px;color:#fff">Add|Questions</h2>
        <div class="container" style="border: 1px solid #ddd; background-color: #fff;width: 600px;margin-right:450px;padding:70px;padding-left:90px;margin-top:0px;">
		<a href="insertQuestionFromExcel.php">Insert From EXCEL</a>
            <form method="post" enctype="multipart/form-data" action="" class="" >
              
              <label for="">Subject:</label>
               <select name="subject_name" style="width: 80px;margin: 20px;" id="subject_name">
                 <option value="">...</option>
                  <?php
                   $obj = new Test();
                   $res = $obj->readAllSubjects();
                   $row = mysqli_fetch_all($res,MYSQLI_ASSOC);
                    for($i=0;$i<count($row);$i++){
                            
                    ?>
                                <option value="<?php echo $row[$i]['subject_id'];?>" name="subject_name"><?php echo $row[$i]['subject_name'];?></option>
                    <?php
                    }
                    ?>
                   
                </select>
               <label for="">Chapter:</label>
               <select name="chapter_id" id="chapters">
                   <option value="0" selected disabled>Select a Chapter</option>
                </select>
  
               
            
                <label for="">Question: <input type="text"  style="width: 350px; margin: 20px;" name="question_text"></label><br>
                <label for="">Option 1: <input type="text"  style="width: 200px; margin: 20px;" name="question_option1"></label><br>
                <label for="">Option 2: <input type="text"  style="width: 200px; margin: 20px;" name="question_option2"></label><br>
                <label for="">Option 3: <input type="text"  style="width: 200px; margin: 20px;" name="question_option3"></label><br>
                <label for="">Option 4: <input type="text"  style="width: 200px; margin: 20px;" name="question_option4"></label><br>
                <label for="">Correct Option:</label>
                <select name="question_correct_answer" style="width: 80px;margin: 20px;">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

                <select name="question_difficulty_level" style="width: 80px;margin: 20px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                
            </select>
                <p>Insert Image (if your question has one!!)</p><input type="file" name="question_image"><br>
                <b>Note:</b>
                <p>skip if your question does not have any image</p>
                <br>
                
                <button type="submit" class="btn btn-primary" style="margin-left:100px; margin-bottom: 20px;" name="submit_question">ADD</button>
                
                <button type="submit" class="btn btn-primary" style="margin-bottom:21px;margin-left:50px;" name="finish_inserting_question">Finish</button>

            </form>

        </div>
        
          <script>
            console.log("hii");
            document.getElementById("subject_name").addEventListener("change",function(){
                
//                console.log("hello");
                
                var strUser = this.options[this.selectedIndex].value;
                
                
            $.ajax({
				url :"fetch.php",
				method:"post",
				data:{subject_id : strUser},
				dataType:"json",
				success:function(data)
                {
                    if(data!=null){
                        $("#chapters").empty();
                        for(var i=0;i<data.length;i++){
                            $("#chapters").append("<option value='"+data[i][0]+"'>"+data[i][1]+"</option>");
                        }
                    }
                },
                error:function(data){
                
                }
    });
                
            });
        </script>

        <!-- Argon Scripts -->
        <!-- Core -->
        <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Argon JS -->
        <script src="../assets/js/argon.js?v=1.0.0"></script>
        
       
    </body>

    </html>
