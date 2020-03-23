<?php
  session_start();
  if (isset($_SESSION['sekolah_id'])) {
    header("Location: cbt-sekolah-dashboard");
    exit();
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
  	<title>CBT | TugasKita</title>
  	<link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<style type="text/css">
        h1, h5 {
            font-family: 'Asap', sans-serif;
        }
        p, button, label, form, ol {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
	<div class="container"><br><br>
		<center class="animated fadeInDown">
			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png">&nbsp&nbsp&nbsp
      <h1><span class="text-tugaskita">TugasKita</span> <small class="text-info">sekolah</small></h1>
		</center><br><br>
		<div class="row">
			<div class="col-md-4 col-sm-4"></div>
			<div class="col-md-4 col-sm-4">
				<form action="sistem/login_sekolah" method="POST">
    			<div class="form-group animated fadeInUp delay-1s">
    				<label>Email Sekolah</label>
    				<input type="email" name="email" class="form-control" required>
    			</div>
        	<div class="form-group animated fadeInUp delay-1s faster">
          		<label>Password</label>
          		<input type="password" name="password" class="form-control" required>
        	</div>
      		<input type="hidden" name="type" value="cbt-sekolah"><br>
    			<button class="btn btn-primary animated fadeInUp delay-1s faster" type="submit" name="submit">login</button>
    		</form>
        <div class="text-center mt-4 animated fadeInUp delay-2s faster">
          <a href="cbt-sekolah-daftar"><small>Belum punya akun sekolah? Daftar sekarang</small></a>
        </div>
			</div>
			<div class="col-md-4 col-sm-4"></div>
		</div>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>