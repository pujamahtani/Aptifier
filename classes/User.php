<?php 
    include_once("Database.php");
    include_once("Session.php");
    include_once("Functions.php");
   	include_once("Detection.php");
	include_once("Mailer.php");
	//include_once("Cipher.php");
    class User{
        
    private $table = "users";
   
        
        private $connection;
        public function __construct(){
            global $database;
            $this->connection = $database->getConnection();
            Session::startSession();
//			$cip=new Cipher();
        }
        
        /*********************************************************
        # The below function is used to login the user
        # It automatically assigns session attributes
        # It is responsibility of CALEE to start the session
        # returns true if credentials were correct otherwise false
        **********************************************************/
        
//       public function insertStudent($user_id,$student_class_id,$student_division,$student_branch){
//           $sql = "INSERT INTO student (user_id,student_class_id,student_division,student_branch) VALUES ($user_id,$student_class_id,$student_division,$student_branch)";
//           global $database;
//           $res=$database->query($sql);
//           return $res;
//           
//       }
        
        public function insert($data, $table){
        
        $keys = array_keys($data);
        
        for($i=0;$i<count($keys);$i++){
            $data[$keys[$i]] = mysqli_real_escape_string($this->connection,$data[$keys[$i]]);
        }
        $columnString = implode(", ", array_keys($data));
        $valueString = "'".implode("', '", array_values($data))."'";
        $sql = "INSERT INTO {$table} ({$columnString}) VALUES ({$valueString})";
        global $database;
        $res=$database->query($sql);
        return mysqli_insert_id($this->connection);
    }
        
        public function processLogin($email, $password,$signed_in){
			global $database;

				$_SESSION['user_email']=$email;
				$res=$database->query("select * from users where user_email='$email'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
			
					if(password_verify($password,$user_password)){
						$this->setCookies($user_id,$signed_in);
						if($is_first_login==1){
							$_SESSION['user_id']=$user_id;
							Functions::redirect('registerUser.php');
						}
						else{
							
				$user_name=$user_first_name." ".$user_last_name;
//					// Setting the session variables here for further use 
				$this->setSession($user_id,$user_name,$user_role_id,$user_email);
							
								return true;
						}
				
			
                } else{
                    return false;
                }
            }
		}
		
		public function loginUserWithFaceID($email,$image,$realpath){
			global $database;
			$obj=new Detection();
				$res=$database->query("select * from users where user_email='$email'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
				if($obj->countFaces($realpath)){
				$res=$obj->performDetection($image,$user_profile_pic);
				if($res['confidence']>0.4){
				$user_name=$user_first_name." ".$user_last_name;
				$this->setSession($user_id,$user_name,$user_role_id);
				return true;
				}
				else{

				return false; //FACE DETECTION FAILED ERROR HERE!!!!
				}
				}else{
					return false; //multple faces detectd error here!!
				}
		}else{
                    return false;// LOGIN CREDENTAILS I.E USER_EMAIL DOES NOT EXOSTS ERR HERE!
                }
	}
				
        
        public function user_logout() {
			$this->deleteCookies();
            $_SESSION['login'] = false;
            $_SESSION['user_id'] = null;
            $_SESSION['user_name'] = null;
            $_SESSION['user_role'] = null;
			$_SESSION['student_id'] = null;
			$_SESSION['teacher_id'] = null;
            session_destroy();
        }

		private function setSession($user_id,$user_name,$user_role,$email){
			 		$_SESSION['login'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_role'] = $user_role;
			$_SESSION['user_email']=$email;
		}

		private function setCookies($user_id,$signed_in){
				//	$cip=new Cipher();
			if($signed_in){
                    $cookie_name = "Quiz_Handler_User";
                   // $user_id_to_login = $cip->encrypt($user_id);
//                    $encrypt_id =encrypt($user_id_to_login);
                    $cookie_content = $user_id;
                    $cookie_time = time() + 86400 * 30;
                    $path = "/";
                    setcookie($cookie_name, $cookie_content, $cookie_time, $path);
                } else{
                    $cookie_name = "Quiz_Handler_User";
//                    $user_id_to_login = $cip->encrypt($user_id);;
                  
                    $cookie_content = $user_id;
                    $cookie_time = time() + 3600;
                    $path = "/";
                    setcookie($cookie_name, $cookie_content, $cookie_time, $path);
                }
		}
		
		public function deleteCookies(){
					
		   $cookie_name = "Quiz_Handler_User";
        $user_id_to_logout = $_SESSION['user_id'];  
        $cookie_content = $user_id_to_logout;
        $cookie_time = time() - 86400 * 30;
        $path = "/";
        setcookie($cookie_name, $cookie_content, $cookie_time, $path);
		}

		public function isCookieSet(){
			//$cip=new Cipher();
			global $database;
			if(isset($_COOKIE["Quiz_Handler_User"])){
            $user_id = $_COOKIE["Quiz_Handler_User"];
		
				$res=$database->query("select * from users where user_id='$user_id'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
				$user_name=$user_first_name." ".$user_last_name;

                $this->setSession($user_id,$user_name,$user_role);
					
         		return true;
			}else{
				?>
				<script>console.log("User data not found using user_id from cookie ");</script>
				<?php
			}
		}else
				return false;
		}
		
		public function sendEmailToRecipient($email){
	
       
        $mailer = new Mailer();

        $subject = "Aptifier Account Confirmation";

        $base_url_link ="http://localhost/quiz-handlers/includes/register.php?XSRS=$email";
        $body = "<div style='font-family:Roboto; font-size:16px; max-width: 600px; line-height: 21px;'>     <h4>Hello,</h4>
            <h3>Your Aptifier Account is Ready.</h3>
            <br>  
            <a style='text-decoration:none; color:#fff; background-color:#348eda;border:solid #348eda; border-width:2px 10px; line-height:2;font-weight:bold; text-align:center; display:inline-block;border-radius:4px' href='$base_url_link'>
            Activate your account </a>
            <br>  
            <h3>Thank you for Registering.</h3>
            <br>
            <br>
            <h4>Sincerely,</h4>
            <h5>The Aptifer Team.</h5>
			  <img src='cid:logo' alt='hahahahah'>
            </div>";

       return( $mailer->send_mail($email, $body, $subject));
    }
		public function sendForgotPassEmailToRecipient($email){
	    
        $mailer = new Mailer();

        $subject = "Aptifier Forgot Password Confirmation";

        $base_url_link ="http://localhost/quiz-handlers/includes/resetPassword.php?XSRS=$email";
        $body = "<div style='font-family:Roboto; font-size:16px; max-width: 600px; line-height: 21px;'>     <h4>Hello,</h4>
            <h3>Reset your Account Password here!</h3>
            <br>  
            <a style='text-decoration:none; color:#fff; background-color:#348eda;border:solid #348eda; border-width:2px 10px; line-height:2;font-weight:bold; text-align:center; display:inline-block;border-radius:4px' href='$base_url_link'>
            Reset Your Password</a>
            <br>  
            <h3>Thank you for Choosing Aptifier.</h3>
            <br>
            <br>
            <h4>Sincerely,</h4>
            <h5>The Aptifier Team.</h5>
			 <img src='cid:logo' alt='hahahahah'>
		
            </div>";

       return( $mailer->send_mail($email, $body, $subject));
		}
		
		public function sendChangePassEmailToRecipient($email){
	    
        $mailer = new Mailer();

        $subject = "Aptifer Change Password Confirmation";

        $base_url_link ="http://localhost/quiz-handlers/includes/resetPassword.php?XSRS=$email&action=reset";
       $body = "<div style='font-family:Roboto; font-size:16px; max-width: 600px; line-height: 21px;'>     <h4>Hello,</h4>
            <h3>Change your Account Password here!</h3>
            <br>  
            <a style='text-decoration:none; color:#fff; background-color:#348eda;border:solid #348eda; border-width:2px 10px; line-height:2;font-weight:bold; text-align:center; display:inline-block;border-radius:4px' href='$base_url_link'>
            Change Your Password</a>
            <br>  
            <h3>Thank you for Choosing Aptifier.</h3>
            <br>
            <br>
            <h4>Sincerely,</h4>
            <h5>The Aptifier Team.</h5>
			 <img src='cid:logo' alt='hahahahah'>
		
            </div>";

       return( $mailer->send_mail($email, $body, $subject));
		}
        
        public static function checkActiveSession(){
            if(!Session::isSessionStart())
                Functions::redirect("login.php");
        }

		public function getUserWithCondition($condn,$key){
			global $database;
			$res=$database->query("select * from users where $condn=$key");
			return $res;
		}
		public function getUserWithJoinCondition($sql,$condn,$key){
			global $database;
			$res=$database->query("select * from users $sql where $condn=$key");
			return $res;
		}
		
		
		
		public function insertUserEmail($email,$password){
			 global $database;
			$hashedpass =  password_hash("$password", PASSWORD_BCRYPT); 
			$res=$database->query("INSERT INTO $this->table (user_email,user_password,is_email_verified,is_first_login,is_deleted) VALUES ('$email','$hashedpass',0,1,0)");
		}
        
        


        public function insertUserDetails($user_first_name, $user_last_name, $user_flat, $user_building, $user_street, $user_city, $user_state, $user_nationality,$user_role_id){

			
			global $database;
			
			

			
			$created_by = $_SESSION['user_id'];
        	$current_date = date("Y-m-d h:i:sa");
        	$is_email_verified = 1;


			$sql = "UPDATE $this->table set user_first_name='$user_first_name', user_last_name='$user_last_name', user_flat='$user_flat', user_building='$user_building', user_street='$user_street', user_city='$user_city', user_state='$user_state', user_nationality='$user_nationality', user_role_id= $user_role_id,is_email_verified=1,is_first_login=0, created_by=$created_by, updated_by=$created_by,is_deleted=0 where user_id=$created_by";


			
			
			$res=$database->query($sql);
			
		
			$user_name=$user_first_name." ".$user_last_name;
			$this->setSession($created_by,$user_name,$user_role_id,$_SESSION['user_email']);
			
			//unlink("images/$img_name");
            
			
			
		}
        
        public function selectUserByEmailId($user_email){
            global $database;
            $sql = "SELECT user_id as id FROM users WHERE user_email = '{$user_email}'";
            $res=$database->query($sql);
            $row = $res->fetch_assoc();
            return $row['id'];
        }
		
		public function updateUser($user_first_name,$user_last_name,$user_pincode){
			global $database;
			$user_id=$_SESSION['user_id'];
        	$current_date = date("Y-m-d h:i:sa");
			$sql="UPDATE $this->table set user_first_name='$user_first_name', user_last_name='$user_last_name', updated_by=$user_id,updated_at=now(),user_pincode='$user_pincode' where user_id=$user_id";
			$res=$database->query($sql);
			
			Functions::redirect("showUser.php");
		}
	}

?>