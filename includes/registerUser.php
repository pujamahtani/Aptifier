
<?php
include_once("bootstrap.php");
Session::startSession();
?>


<?php
if(isset($_POST['submit_user_details'])){
    extract($_POST);
    $user = new User();
//    $user_name=$user_first_name." ".$user_last_name;
//	$info = pathinfo($_FILES['user_profile_pic']['name']);
//	$ext = $info['extension']; // get the extension of the file
//	$newname = "$user_name.".$ext; 
//	$target = 'images/'.$newname;
//
//	move_uploaded_file( $_FILES['user_profile_pic']['tmp_name'], $target);
//	
   $result = $user->insertUserDetails($user_first_name, $user_last_name, $user_flat, $user_building, $user_street, $user_city, $user_state, $user_nationality,$user_role_id);
	
    $res = $_SESSION['user_id'];;
	
    if($_POST['user_role_id'] == 5){
    $data = array("user_id"=>$res,"student_class_id"=>$user_class_id,"student_division"=>$user_division,"student_branch"=>$user_branch);
    
    $res1 = $user->insert($data,"student");
    }
    if($_POST['user_role_id'] == 3){
    $data = array("user_id"=>$res,"teacher_branch_id"=>$user_branch,"teacher_designation_id"=>$user_designation);
    $res2 = $user->insert($data,"teacher");
    
    }
    

////	

	Functions::redirect('dashboard.php');
}

?>
  

  <!DOCTYPE html>
   
   <html>
   
    <head>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/details.css">
         <title>Aptifiers! | Personal Details</title>
    </head>
    <body>
       
        <div class="container">
           <h1>Details</h1>
       <hr style="background: #37abed">
            <form action="#" method="post" name="add_user" enctype="multipart/form-data">
                <label>First Name</label>
                <input type="text" class="form-control" name="user_first_name" id="user_first_name">
                <label>Last Name</label>
                <input type="text" class="form-control" name="user_last_name" id="user_last_name">
             
                <br>
                <H4>Address:</H4>
                <label>Flat</label>
                <input type="text" class="form-control" name="user_flat" id="user_flat">
                <label>Building</label>
                <input type="text" class="form-control" name="user_building" id="user_building">
                <label>Street</label>
                <input type="text" class="form-control" name="user_street" id="user_street">
                <label>City</label>
                <input type="text" class="form-control" name="user_city" id="user_city">
                <label>State</label>
                <input type="text" class="form-control" name="user_state" id="user_state">
                <label>Natioanlity</label>
                <input type="text" class="form-control" name="user_nationality" id="user_nationality">
                <br>
                <label for="">You are a :</label>
                <select name="user_role_id" style="width: 100px;margin: 20px;" id="user_role_id">
                <option value="">..</option>
                <?php 
                $obj = new Test();
                $res = $obj->userTypes();
                
                while($row = mysqli_fetch_assoc($res)){
                    extract($row);
                ?>
                <option value="<?php echo $user_type_id;?>" name="user_role_id"><?php echo $user_type_name;?></option>
                <?php
                }
                ?>
                </select>
                <br>
                <div id="div"></div>
                <div class="inputoutput">
    			<img id="imageSrc" alt="No Image" style="display: block" />
    			<div class="caption"><input type="file" id="fileInput" name="user_profile_pic" /></div>
				</div>
               <br>
                
                <button class="btn btn-primary" name="submit_user_details" id="submit_user_details">Submit</button>
                
            </form>
        </div>
        <script>
			let imgElement = document.getElementById("imageSrc");
			imgElement.height=250;
			imgElement.width=250;
			let inputElement = document.getElementById("fileInput");
			inputElement.addEventListener("change", (e) => {
  			imgElement.src = URL.createObjectURL(e.target.files[0]);
			}, false);	
		</script>
     <script>
            console.log("hii");
            document.getElementById("user_role_id").addEventListener("change",function(){
                
//                console.log("hello");
                
                var strUser = this.options[this.selectedIndex].value;
                //console.log(strUser);
                
                
            $.ajax({
				url :"fetch2.php",
				method:"post",
				data:{user_type_id : strUser},
				dataType:"html",
				success:function(data)
                {
                    $("#div").empty();
                    $("#div").append(data);
                },
                error:function(data){
                    console.log("not working");
                }
    });
                
            });
        </script>
        <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
   
    </body>
</html>

