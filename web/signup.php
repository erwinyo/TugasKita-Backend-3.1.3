<?php
	if(!isset($_SESSION)) 
    	session_start(); 
	if (isset($_SESSION['user_id'])) {
		header("Location: dashboard");
		exit();
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Daftar Akun</title>
<link rel="shortcut icon" href="images/logo.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet">
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--//charts-->
</head>
<body>	
<!--inner block start here-->
<div class="signup-page-main">
     <div class="signup-main">  	
    	 <div class="signup-head">
				<h1>Daftar Akun <small>TugasKita</small></h1>
			</div>
			<div class="signup-block">
				<form method="POST" action="sistem/register">
					<input type="text" name="fullname" placeholder="Nama Lengkap" required>
					<input type="text" name="username" placeholder="Username" required>
					<input type="text" name="email" placeholder="Email" required>
					<input type="password" name="password" class="lock" placeholder="Password" required>
					<input type="submit" name="Sign In" value="Sign up">												
				</form>
				<div class="sign-down">
					<h4>Sudah punya akun? <a href="login"> Klik disini.</a></h4>
				</div>
			</div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>TugasKita Indonesia 2019 | All Rights Reserved</p>
</div>	
<!--COPY rights end here-->
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
