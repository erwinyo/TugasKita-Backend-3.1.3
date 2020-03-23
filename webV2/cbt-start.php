<?php
	session_start();
  require 'connection.php';
	if (!isset($_SESSION['userid'])) {
		header("Location: cbt");
	}
	// automatic redirect to cbt-dashboard.php
	else if (isset($_SESSION['id_paket'])) {
		header("Location: cbt-dashboard");
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
            <form action="sistem/load_paket" method="POST">
            	<div class="form-group animated fadeInUp delay-1s">
            		<label>Pilih Sekolah</label>
            		<select name="sekolah" class="form-control">
                  <?php 
                    $SQL = "SELECT * FROM sekolah";
                    $RES = mysqli_query($connection, $SQL);
                    while ($FET = mysqli_fetch_assoc($RES)) {
                      $id = $FET['id'];
                      $nama = $FET['nama'];
                      echo '<option value="'.$id.'">'.$nama.'</option>';
                    }
                  ?>
            		</select>
              </div><br>
              <div class="form-group animated fadeInUp delay-1s faster">
            		<label>Masukan Token Paket Soal</label>
            		<input type="number" name="token" class="form-control" required autocomplete="off">
        	    </div><br>
            	<button class="btn btn-primary btn-lg animated fadeInUp delay-1s faster" type="submit" name="submit"><span class="fa fa-send animated wobble infinite slow"></span> mulai</button>
            </form><br><br><br><br>
          	<center>
              <form action="sistem/logout" method="POST">
                <input type="hidden" name="type" value="cbt">
          		  <button class="btn btn-danger btn-sm animated fadeInUp delay-2s faster" type="submit" name="submit">logout account</button>
              </form>
          	</center>
        	</div>
        	<div class="col-md-4 col-sm-4"></div>
    	</div><br><br><br><br><br>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>