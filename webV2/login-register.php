<?php
  session_start();
  if (isset($_SESSION['userid'])) {
    header("Location: dashboard");
  }
?>
<!DOCTYPE html>
<html>
<head>
  	<link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/ico.png" />
  	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TugasKita</title>
    <style type="text/css">
    	h1, .h1 {
    		font-family: 'Asap', sans-serif;
    	}
    	label, form , p{
    		font-family: 'Nunito', sans-serif;
    	}
    </style>
</head>
<body>
	<div class="container"><br><br>
      <h1 class="animated fadeInLeft"><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_80/v1571068816/tugaskita/assets/ico.png"> TugasKita</h1><br>
  		<div class="card border-0 animated slideInUp">
        <div class="card-body">
          <b class="h3"><span class="fa fa-quote-left"></b><b class="h5"></span>&nbsp&nbspApapun lupanya, selalu ingat TugasKita</b>
        </div>
      </div> 
      <div class="card animated fadeInUp">
        <div class="card-body">
          <h3 class="card-title text-success"><i class="fa fa-child animated bounce infinite slower"></i> <b>How it works?</b></h3>
          <p class="card-text"><b>TugasKita</b> akan <b>mengingat</b> semua tugas Anda, dan Anda akan diberi <b>informasi</b> akan tugas-tugas besok dan yang akan datang sesuai dengan <b>penginputan data</b> yang diberikan. <b><u>To The Point. Flexible. Updated Every Second.</u></b></p>
        </div>
        <div class="card-footer text-right text-light bg-success">
          TugasKita Indonesia
        </div>
      </div><br>
  		<div class="row animated fadeInUp delay-1s fast">
  			<div class="col-md-6 col-sm-12">
  				<div class="card">
	  				<h3 class="card-header bg-primary text-light"><b>SIGNUP ACCOUNT</b></h3>
	  				<div class="card-body bg-light">
	  					<form action="sistem/register.php" method="POST">
		  					<div class="form-group">
		  						<label>Nama Lengkap <span class="text-danger">*</span></label>
		  						<input type="text" name="namalengkap" class="form-control" placeholder="cth: John Doe, Christian Johanna, ..." required>
		  					</div>
		  					<div class="form-group">
		  						<label>Username <span class="text-danger">*</span></label>
		  						<input type="text" name="username" class="form-control" placeholder="cth: johndoe, christianjohanna123, ..." required>
		  					</div>
		  					<div class="form-group">
		  						<label>Email (@GMAIL / @YAHOO) <span class="text-danger">*</span></label>
		  						<input type="email" name="email" class="form-control" placeholder="cth: johndoe@gmail.com, christianjohanna@yahoo.com, ..." required>
		  					</div>
		  					<div class="form-group">
		  						<label>Password <span class="text-danger">*</span></label>
		  						<input type="password" name="password" class="form-control" placeholder="xxxxxxxx" required>
		  					</div><br>
		  					<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-pencil animated tada infinite"></i> Daftarkan Akun Baru</button>
		  				</form>
	  				</div>
		  			<div class="card-footer text-right text-info border-0">
  						<b><i class="fa fa-lock text-primary"></i> Secured by TugasKita</b>
  					</div>
	  			</div><br>
  			</div>
  			<div class="col-md-6 col-sm-12">
  				<div class="card border-0 animated fadeInUp delay-2s fast">
  					<div class="card-body">
  						<h3 class="card-title"><b>TugasKita</b></h3>
  						<p class="card-text">is a project under development for daily school management. Until now it still development</p>
  					</div>
            <div class="card-footer bg-success"></div>
  				</div><br>
  				<div class="card animated fadeInUp delay-3s fast">
	  				<h3 class="card-header bg-primary text-light"><b>LOGIN ACCOUNT</b></h3>
  					<div class="card-body bg-light">
		  				<form action="sistem/login" method="POST">
		  					<div class="form-group">
		  						<label>Email <span class="text-danger">*</span></label>
		  						<input type="email" name="email" class="form-control" placeholder="cth: johndoe@gmail.com, christianjohanna@yahoo.com, ..." required autocomplete="off">
		  					</div>
		  					<div class="form-group">
		  						<label>Password <span class="text-danger">*</span></label>
		  						<input type="password" name="password" class="form-control" placeholder="xxxxxxxx" required>
		  					</div><br>
		  					<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-sign-in animated wobble infinite slow"></i> Masuk Akun</button>
		  				</form><br>
              <a href="forgot-password">Forgot Password?</a>
              <p>Terlalu lama menunggu? Anda dapat mengklik lagi tombol login</p>
  					</div>
  					<div class="card-footer text-right text-info border-0">
  						<b><i class="fa fa-lock text-primary"></i> Secured by TugasKita</b>
  					</div>
  				</div><br>
  			</div>
  		</div><br>
      <span class="animated fadeInDown delay-4s">Project Maintanced and Development <b>still going...</b><br><br>
	</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>