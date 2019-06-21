<?php
include_once('classes/Functions.php');
include_once('classes/User.php');

include_once('classes/Mailer.php');
$obj=new User();

if($obj->isCookieSet()){
	Functions::redirect('includes/dashboard.php');
}
else{

?>
	<html>

	<head>
		<style>
			.vd {
				padding-right: 30px;
				color: #08476E;
				letter-spacing: 1px;


			}

			.vd:hover {
				color: #066fac;
			}

			footer {
				background-color: #08476E;
				padding-top: 30px;

			}

			footer p {
				font-size: 16px;
				font-weight: 300;
			}

			.contact-left h3,
			.contact-right h3 {
				color: #fff;
				font-size: 28px;
				font-weight: 700;
			}

			.contact-left p {
				color: #fff;
				margin-bottom: 30px;
			}

			.contact-info {
				background: url('assets/images/world-map.png') no-repeat;
				background-size: contain;
			}

			address {
				color: #fff;
			}

			address strong,
			.phone-fax-email strong {
				font-size: 16px;
				letter-spacing: 1px;
			}

			.form-control {
				background-color: transparent;
				border-radius: 0;
				color: #fff;
				font-size: 16px;
				font-weight: 300;
				border-color: #fff;
				margin-bottom: 20px;
				padding: 8px 15px;
			}

			.pics {
				border-radius: 50%;
				width: 180px;
				height: 180px;
			}

			.pics:hover {
				box-shadow: 0 0 10px 5px rgba(0, 140, 186, 0.5);
			}

			/*CSS for image hovering*/

			.hovering {
				position: relative;
				display: inline-block;
				

			}

			.hovering h2 {
				position: absolute;
				bottom: 1px;
				margin: 0;
				color: white;
				text-align: center;
				background: black;
				background: rgba(0, 0, 0, 0.5);
				border-radius: 50%;
				width: 180px;
				height: 180px;
				line-height:90px;
				padding: 15px;
				box-sizing: border-box;
				display: none;
				font-size: 14px;
				
			}

			.hovering:hover h2 {
				display: block;
			}

		</style>


		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Aptifiers!</title>
		<link rel="shortcut icon" href="assets/data2/images/faviconb.png" />
		
		<link rel="stylesheet" href="assets/css/bootstrap2.min.css">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="assets/engine2/style.css" />
<script type="text/javascript" src="assets/engine2/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
		
	</head>

	<body style="">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="wg-nav-wrapper">
					<div class="nav-header">
						<!--					<a href="#" class="navbar-brand"><img src="assets/images/" alt="logo" width="171" height="81" style="margin:15px 45px 15px"></a>-->

						<a href="#"><img src="assets/data2/images/155120841628803503.png" alt=""></a>
						<div style="display: inline; margin:30px 400px 30px;color:#066fac">


							<a href="#about" class="vd" style="text-decoration: none;">About</a>
							<a href="#contact" class="vd" style="text-decoration: none;">Contact</a>
							<a href="includes/register.php" class="btn" style="text-decoration: none;color: #fff;width:90px;margin-left: 20px;background-color:#08476E">Sign Up</a>
							<a href="includes/login.php" class="btn" style="text-decoration: none;color: #fff;width:90px;margin-left: 20px;background-color:#08476E ">Login</a>
						</div>
					</div>
					<!--nav-header-->
				</div>
				<!--wg-nav-wrapper-->
			</div>
			<!--container-fluid-->
		</nav>
		<section id="home">

			<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container2">
<div class="ws_images"><ul>
		<li><img src="assets/data2/images/web_1280__3.png" alt="Web 1280 – 3"  id="wows2_0"/></li>
		<li><a href="http://wowslider.net"><img src="assets/data2/images/web_1280__1.png" alt="bootstrap carousel example" id="wows2_1"/></a></li>
		<li><img src="assets/data2/images/web_1280__2.png" alt="Web 1280 – 2" id="wows2_2"/></li>
	</ul></div>
	
</div>	
<script type="text/javascript" src="assets/engine2/wowslider.js"></script>
<script type="text/javascript" src="assets/engine2/script.js"></script>
<!-- End WOWSlider.com BODY section -->


		</section>










		<div class="container-fluid" id="about">
			<h1 style="text-align: center;margin-top:120px;color:#04456B;letter-spacing: 3px;font-weight:350 ">ABOUT US</h1>
			<p style="text-align: center;margin-top:25px;color:#04456B;font-weight:350;font-size: 18px;">A Place where a student can test its skills!</p>
			<p style="text-align:center;margin:25px 150px 15px 150px;color:#04456B;font-weight:350;font-size:16px;">More than 75% colleges conduct online tests for the students between there official term tests just to make sure that the students are in touch with the terminologies and the concepts which are to be taught in different lectures planned all around the semester duration. Most of these tests are conducted online either on the official websites of these colleges or onto some online portal whereas our college uses Google forms to conduct such tests. While conducting these tests there are a number of mishaps faced by the students and the teachers as well. One major problem faced by the faculty is the process of retrieving data and the credibility of the students appearing for the tests. We aim to work on these 2 broad areas for the project. We will implement face recognition for ensuring that the expected student is giving the test. This particular software will prevent cheating in these examinations, the overhead of using Google forms (once the data set is saved it can be used until the syllabus is changed) and promote integrity, credibility, data retrieval and the efficiency of conducting tests.</p>
		</div>

		<footer id="contact" style="margin-top:150px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="contact-left">


							<div class="contact-info" style="color:white;" id="contact">
								<b>Created By Students of VESIT D12(CMPN Batch 2020)</b><br>
								<div class="dev-info">
									<br>
									<div class=hovering>
										<img class="pics" src="assets/img/brand/chirag.png" alt="Chirag Raghani">
										<h2><span>Chirag Raghani</span><span style="line-height:0px;"><br>Backend Support</span></h2>
										
									</div>
                                   
                                    <div class="hovering">
                                    	<img class="pics" src="assets/img/brand/dhiren.png" alt="Dhiren Chotwani" style="margin-left:40px">
                                    	<h2  style="margin-left:40px;"><span style="margin-left:40px">Dhiren Chotwani</span><span style="line-height:0px; "><br >Backend Support</span></h2>
								
                                    </div>
									<div class="hovering">
										<img class="pics" src="assets/img/brand/priyanka.jpg" alt="Priyanka Lalchandani" style="margin-top:30px;">
										<h2><span>Priyanka Lalchandani</span><span style="line-height:0px;"><br>DB Admin</span></h2>
									</div>
									<div class="hovering">
										<img class="pics" src="assets/img/brand/puja.jpg" alt="Puja mahtani" style="margin-left:40px; margin-top:30px;">
										<h2  style="margin-left:40px;"><span>Puja Mahtani</span><span style="line-height:0px;"><br>UI/UX</span></h2>
									</div>
									

								</div>


							</div>

						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="contact-right">
							<h2 style="font-weight: 300;letter-spacing: 3px;color: white;padding-bottom: 20px;">Contact Us</h2>
							<form action="" method="post">
								<input type="text" name="full_name" placeholder="Full Name" class="form-control">
								<input type="email" name="email" placeholder="Email Address" class="form-control">
								<textarea name="message" rows="3" placeholder="your message.." class="form-control"></textarea>

								<div class="send-btn"><button class="btn" style="color:#066fac;background: #fff;font-weight:500;width:200px;" name="send_enquiry_msg">SEND</button></div>
							</form>
						</div>
					</div>
				</div>

			</div>
			<div class="row ">
				<div class="col-md-12 col-sm-6">
					<p class="copy" style="text-align:center;background:#08476E;color: white;letter-spacing: 2px;width: 100%;padding-top:15px;">Copyrights @ Aptifier, 2018</p>
				</div>
			</div>


		</footer>

	</body>

	</html>


	<?php

}
if(isset($_POST['send_enquiry_msg'])){

	$mailer=new Mailer("index");
	extract($_POST);
	$subject="A new user $full_name sent an Enquiry";
	$body = "<div style='font-family:Roboto; font-size:16px; max-width: 600px; line-height: 21px;'>   
          
            <br>  
            <p style='text-decoration:none; color:#fff; background-color:#08476E;border:solid #08476E; border-width:2px 10px; line-height:2;font-weight:bold; text-align:center; display:inline-block;border-radius:4px'>
            $email says <br> $message </p>
            <br>  
          
            <br>
            <br>
			  <img src='cid:logo' alt='hahahahah'>
            </div>";
	$mailer->send_mail("handlesquizlikeaboss@gmail.com",$body,$subject);
	
	$subject="Your Enquiry is under Process";
	$body = "<div style='font-family:Roboto; font-size:16px; max-width: 600px; line-height: 21px;'>     <h4>Hello,</h4>
            <h3>Hello, We're from The Aptifier!</h3>
            <br>  
            <p style='text-decoration:none; color:#fff; background-color:#08476E;border:solid #08476E; border-width:2px 10px; line-height:2;font-weight:bold; text-align:center; display:inline-block;border-radius:4px'>
            We,ve received your enquiry,our representative will get back to you soon! </p>
            <br>  
            <h3>Thank you for choosing The Aptifiers!.</h3>
            <br>
            <br>
            <h4>Sincerely,</h4>
            <h5>The Aptifier Team.</h5>
			  <img src='cid:logo' alt='hahahahah'>
            </div>";
	
	$mailer->send_mail($email,$body,$subject);
}

?>
