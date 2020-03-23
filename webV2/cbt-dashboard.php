<?php 
	session_start();
	require 'connection.php';
	if (isset($_SESSION['id_paket'])) {
		
	} else {
		header("Location: cbt-start");
		exit();
	}
	$userid = $_SESSION['userid']; // userid
	$usernamalengkap = $_SESSION['usernamalengkap']; // usernamalengkap

	$paket = $_SESSION['id_paket'];
	$UP_SQL_CHECK = "SELECT * FROM user_paket WHERE user_id='$userid' AND paket_id='$paket';";
	$UP_RES_CHECK = mysqli_query($connection, $UP_SQL_CHECK);
	$UP_ROW_CHECK = mysqli_num_rows($UP_RES_CHECK);
	$UP_FET_CHECK = mysqli_fetch_assoc($UP_RES_CHECK); // get status data from user_paket database
	$_SESSION['status_user_paket'] = $UP_FET_CHECK['status']; // update session['status_user_paket']
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

        .label-info-paket {
        	font-family: arial;
        	font-weight: bold;
        }
    </style>
</head>
<body>
	<div class="container">
		<br><br>
		<center class="animated fadeInDown">
			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png">&nbsp&nbsp&nbsp
			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_60/v1571068816/tugaskita/assets/stella-maris.png"><br> 
            <h1>TugasKita <small class="text-info">CBTL</small></h1>
            <p class="text-danger">SMAK STELLA MARIS SURABAYA</p>
		</center>
        <div class="row">
        	<div class="col-md-3 col-sm-3"></div>
        	<div class="col-md-6 col-sm-6">
        		<hr>
        		<div class="animated fadeInUp slow">
        			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/v1575272912/tugaskita/assets/220px-User_icon_2.svg.png" width="70">&nbsp&nbsp&nbsp<b><?php echo $usernamalengkap; ?> | <span class="badge badge-primary">WELCOME</span></b>
        		</div>
        		<br><br><br>
        		<a class="animated fadeInDown delay-1s faster" href="sistem/logout-cbt"><button class="btn btn-danger btn-sm"><span class="fa fa-sign-out"></span> logout paket</button></a>
        		<br><br>
        		<?php  
		        	if ($_SESSION['aktif_paket'] == "1") {
		        		echo '<div class="card animated fadeInRight delay-2s faster">
	        			<div class="card-body">
	        				<h5 class="card-title"><span class="fa fa-exclamation-circle"></span> PERATURAN</h5>
	        				<ol>
	        					<li>Kerjakan soal dengan jujur dan tepat.</li><br>
	        					<li>Pastikan semua soal sudah terjawab dengan benar dan pasti.</li><br>
	        					<li>Dilarang keras untuk mencontek dan keluar dengan menggunakan floating app. Jika diketahui maka akan diproses sesuai peraturan.</li>
	        				</ol>
	        			</div>
	        		</div>
	        		<br>
	        		<div class="card animated fadeInRight delay-2s fast">
	        			<diV class="card-header bg-primary text-light">
	        				<b><span class="fa fa-eye"></span> INFO PAKET SOAL</b>
	        			</div>
	        			<div class="card-body">
	        				<div class="row">
	        					<div class="col-md-4">
	        						<b>Nama Paket : </b> 
	        					</div>
	        					<div class="col-md-8">
	        						<p>'.$_SESSION['nama_paket'].'</p>
	        					</div>
	        				</div>
	        				<div class="row">
	        					<div class="col-md-4">
	        						<b>Waktu : </b>
	        					</div>
	        					<div class="col-md-8">
	        						<p>'.$_SESSION['waktu_paket'].' menit</p>
	        					</div>
	        				</div>
	        				<div class="row">
	        					<div class="col-md-4">
	        						<b>Butir Soal : </b> 
	        					</div>
	        					<div class="col-md-8">
	        						<p>'.$_SESSION['butir_paket'].'</p>
	        					</div>
	        				</div>
	        				<div class="row">
	        					<div class="col-md-4">
	        						<b>Pilihan Ganda : </b>
	        					</div>
	        					<div class="col-md-8">
	        						<p>'.$_SESSION['pilgan_paket'].' SOAL</p>
	        					</div>
	        				</div>
	        				<div class="row">
	        					<div class="col-md-4">
	        						<b>Uraian : </b>
	        					</div>
	        					<div class="col-md-8">
	        						<p>'.$_SESSION['uraian_paket'].' SOAL</p>
	        					</div>
	        				</div>
	        				<div class="row">
	        					<div class="col-md-4">
	        						<b>Pembuat : </b>
	        					</div>
	        					<div class="col-md-8">
	        						<p>'.$_SESSION['pembuat_paket_nama'].'</p>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<br><br>';
	        		if ($_SESSION['status_user_paket'] == "INCOMPLETE") {
	        			echo '<form action="sistem/load_soal" method="POST" class="animated fadeInLeft delay-3s fast">
	        			<button type="submit" name="paketid" value="'.$_SESSION['id_paket'].'" class="btn btn-block btn-primary">Mulai Test &nbsp<span class="fa fa-arrow-right"></span></button>
	        		</form>';
	        		} else {
	        			echo '<form action="sistem/load_soal" method="POST" class="animated fadeInLeft delay-3s fast">
	        			<button type="submit" name="paketid" value="'.$_SESSION['id_paket'].'" class="btn btn-block btn-primary" disabled>Sudah Dikerjakan &nbsp<span class="fa fa-arrow-right"></span></button>
	        		</form>';
	        		}
	        		
        			} else {
        				echo '<p>Paket belum aktif!</p>';
        			}
        		?>
        	</div>
        	<div class="col-md-3 col-sm-3"></div>
        </div>
        <br><br><br>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>