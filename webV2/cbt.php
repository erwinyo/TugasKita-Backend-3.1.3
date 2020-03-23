 <?php
	session_start();
  if (isset($_SESSION['userid'])) {
    header("Location: cbt-start");
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
        h1 {
            font-family: 'Asap', sans-serif;
        }
        p, button, label, form {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
	<div class="container"><br><br>
		<center class="animated fadeInDown">
			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png"><br>
      <h1>TugasKita <small class="text-info">CBTL</small></h1>
		</center><br><br><br>
      <div class="row">
      	<div class="col-md-4 col-sm-4"></div>
      	<div class="col-md-4 col-sm-4">
          <form action="sistem/login" method="POST">
          	<div class="form-group animated fadeInUp delay-1s">
          		<label>Email Anda</label>
          		<input type="email" name="email" class="form-control" required autocomplete="off">
          	</div>
            <div class="form-group animated fadeInUp delay-1s faster">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <input type="hidden" name="type" value="cbt-siswa"><br>
            <div class="text-right animated fadeInUp delay-1s faster">
          	 <button class="btn btn-primary" type="submit" name="submit">masuk <span class="fa fa-arrow-right animated wobble infinite slow"></span></button> 
            </div>
          </form>
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