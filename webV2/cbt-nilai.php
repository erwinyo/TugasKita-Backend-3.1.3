<?php
	session_start();
	require 'connection.php';
	$sekolah = mysqli_real_escape_string($connection, $_GET['sekolah']);
	$paket = mysqli_real_escape_string($connection, $_GET['paket']);

	# AMBIL DATA PAKET YANG DIPILIH
	$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah' AND id='$paket';";
	$P_RES = mysqli_query($connection, $P_SQL);
	$P_FET = mysqli_fetch_assoc($P_RES);
	$namapaket = $P_FET['nama'];


	$user_paket_data = array();
	# AMBIL SEMUA NILAI DARI DATABASE
	$UP_SQL = "SELECT * FROM user_paket WHERE sekolah_id='$sekolah' AND paket_id='$paket';";
	$UP_RES = mysqli_query($connection, $UP_SQL);
	while ($UP_FET = mysqli_fetch_assoc($UP_RES)) {
		array_push($user_paket_data, $UP_FET);
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
  	<title>Sekolah | TugasKita</title>
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
        td, th {
        	font-family: arial;
        }
    </style>
</head>
<body>
	<div class="container"><br><br>
  		<div class="row">
  			<div class="col-md-3"></div>
  			<div class="col-md-6">
				<a href="cbt-sekolah-dashboard"><button class="btn btn-primary btn-sm"><span class="fa fa-arrow-left"></span> kembali</button></a>
				<h1 class="mt-3">TugasKita <small class="text-info">sekolah</small></h1>
				<small>LAPORAN NILAI PAKET '<?php echo $namapaket;?>'</small>
  				<table class="table table-bordered table-sm mt-5">
  					<thead>
  						<tr class="bg-dark text-light">
  							<th>NAMA</th>
  							<th>NILAI</th>
  							<th>STATUS</th>
  						</tr>
  					</thead>
  					<tbody>
  						<?php
  							for ($i=0; $i < count($user_paket_data); $i++) { 
  								$userid = $user_paket_data[$i]['user_id'];
  								$status = $user_paket_data[$i]['status'];
  								$nilai = $user_paket_data[$i]['nilai'];

  								# AMBIL DATA AKUN DARI USERID
  								$A_SQL = "SELECT * FROM akun WHERE user_id='$userid';";
  								$A_RES = mysqli_query($connection, $A_SQL);
  								$A_FET = mysqli_fetch_assoc($A_RES);
  								$nama = $A_FET['user_namalengkap'];
  										
  								echo '<tr>
  							<td>'.$nama.'</td>
  							<td>'.$nilai.'</td>
  							<td>'.$status.'</td>
  						</tr>';
  							}
  						?>
  					</tbody>
  				</table>
  			</div>
  			<div class="col-md-3"></div>
  		</div>
	</div> 
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>