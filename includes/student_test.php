<?php
include_once("../classes/Session.php");
Session::startSession();
?>
<?php
include_once("bootstrap.php");
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

<body class="">
	<!-- Sidenav -->
	<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
		<div class="container-fluid">
		<!-- Brand -->
			<a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/img/brand/logo_blue.png" class="navbar-brand-img" alt="...">
      </a>
     <!-- Collapse -->
			<div class="collapse navbar-collapse" id="sidenav-collapse-main">
       <!-- Navigation -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
                       </a>
					</li>
               </ul>
           </div>
		</div>
	</nav>
	
<form method="post" action="output.php">
<?php
$obj = new Test();
$user_id = $_SESSION['user_id'];
//ider dhiren k error k vajah se session use ni kar rhe h
//$_SESSION['test_id']
$result_set = $obj->showTest($_SESSION['test_id']);

$count =  mysqli_num_rows($result_set);

$i=1;
$array = array();
$arrayofquestions = array();
//variable for looping in array $arrayofquestions
$j=0;
//foreach($_SESSION['array'] as $id){
//    echo $id;
//}
while($row = mysqli_fetch_assoc($result_set)){
    extract($row);
   array_push($arrayofquestions,$questions_id);
    
?>
    <div class="main-content" <?php if($j!=0)echo "style='display:none'";?>value="<?php echo $arrayofquestions[$j];?>" <?php echo "id='myDiv{$j}'"; ?>>
		<!-- Header -->
		<div class="header py-lg-8"></div>
		<!-- Page content -->
		<div class="container mt--8 pb-5">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-7">
					<div class="card bg-secondary shadow border-0">
						<div class="card-header bg-transparent pb-5" id="question_image">
							<?php
                if($is_question_image == 1){
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['question_image']).'" width="200px" height="200px"/>';
                }
                        ?>
							<div class="text-muted mt-2 mb-3">Time Left: <strong style="font-size:16px;">10min</strong><small style="margin-left:260px;">Questions:<strong style="font-size:16px;">1/1</strong></small></div>
							<div class="" id="question_text">
								<p id="questionID" value="<?php echo $questions_id;?>"><span><?php echo $i.")";?> </span><?php echo $question_text; ?></p>
							</div>
						</div>
						<div class="card-body" style="background=#f9f9f9;margin:0px;">
							<ul style="list-style: none;">
								<div style="width:350px;height:40px;box-shadow:0px 0px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;"><li id="question_option1"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="a"><span>A. </span><?php echo $question_option1 ?></li></div>
								<div style="width:350px;height:40px;box-shadow:0px 0px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="b"><span>B. </span><?php echo $question_option2 ?></li></div>
								<div style="width:350px;height:40px;box-shadow:0px 0px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="c"><span>C. </span><?php echo $question_option3 ?></li></div>
								<div style="width:350px;height:40px;box-shadow:0px 0px 25px -10px #999;padding-left:20px;padding-top:8px;margin-bottom:15px;"><li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="d"><span>D. </span><?php echo $question_option4 ?></li></div>
							</ul>
							<a style="padding:15px; margin-bottom: 15px; width:50px;height:50px; border: none; text-align:center; margin-top: 20px;border-radius:50px;color:white;font-weight:400;box-shadow:1px 1px 50px -10px #999" class="btn btn-primary" <?php if($j!=0)echo 'onclick="previous()"';?>><i class='fas fa-arrow-left'></i></a>
							<a style="padding:15px; margin-bottom: 15px;  width:50px;height:50px;border: none; text-align:center; float: right; margin-top: 20px;border-radius:50px;color:white;font-weight:400;box-shadow:1px 1px 50px -10px #999" class="btn btn-primary" id="nextQuestion" 
							<?php if($j != $count-1)echo 'onclick="next()"';?>><i class='fas fa-arrow-right'></i></a>


						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

		<?php
            $i++;
            $j++;
       }
            ?>
   
	<button type="submit" name="submit_test" class="btn btn-blue" style="margin-left:700px;color:#04456B;">Submit</button>
   
    </form>
    
            <script>
        $(window).blur(function(){
            window.alert("dont switch or you will be logged out!");
            
        });
        
        </script>
<script>
document.getElementsByTagName("BODY")[0].onresize = function() {myFunction()};

var x = 0;
function myFunction() {
  var x = 0;
  Window.alert("Dont resize the page! you have "+(3-x)+" turns left");
    x++;
}
</script>

     <script>
            //console.log("hii");
         var i = 0;
//         var conversion = i.toString();
//         var myDiv = "myDiv";
//         var final = myDiv.concat(conversion);
//         console.log(final);
            
         function next(){                 
               //console.log("hello");                
                var questionID = document.getElementById("questionID").val;                
                var x = document.getElementById("myDiv"+i);
             console.log(x.style.display);
             x.style.display = "none";
                
        i++;
        
        
        var x = document.getElementById("myDiv"+i);
        console.log(x.style.display);
        if(x.style.display === "none"){
            x.style.display = "block";
        }
         
        
    }
         
        function previous(){                 
               //console.log("hello");                
                var questionID = document.getElementById("questionID").val;                
                var x = document.getElementById("myDiv"+i);
             console.log(x.style.display);
             x.style.display = "none";
                
        i--;
        
        
        var x = document.getElementById("myDiv"+i);
        console.log(x.style.display);
        if(x.style.display === "none"){
            x.style.display = "block";
        }
         
        
    }
        </script>
		
	<!-- Argon Scripts -->
	<!-- Core -->
	<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Argon JS -->
	<script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>


