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
<title>Masuk Akun</title>
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
<!--static chart-->
</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Masuk Akun <small>TugasKita</small></h1>
			</div>
			<div class="login-block">
				<form method="POST" action="sistem/login.php">
					<input type="text" name="email" placeholder="Email" required>
					<input type="password" name="password" class="lock" placeholder="Password" required>
					<input type="submit" name="Sign In" value="Login">	
					<h3>Belum punya akun?<a href="signup"> Daftar sekarang</a></h3>				
				</form>
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


                      
						
