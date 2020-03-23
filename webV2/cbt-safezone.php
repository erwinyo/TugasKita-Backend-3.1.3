<?php
	session_start();
	require 'connection.php';

	date_default_timezone_set('Asia/Jakarta');
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$date_f = str_pad($date, 2, "0", STR_PAD_LEFT);
	$month_f = str_pad($month, 2, "0", STR_PAD_LEFT);
	$year_f = str_pad($year, 4, "0", STR_PAD_LEFT);

	$current = $month_f."/".$date_f."/".$year_f;


	$user = $_SESSION['userid'];
	$soal_id = $_SESSION['soal'][$_SESSION['soal_idx']]['id'];
	$paket = $_SESSION['id_paket']; // nanti diganti dengan session['paket']
	$waktu = $_SESSION['waktu_paket'];


	$masuk = $_SESSION['masuk_user_paket'];
	$masuk_array = explode("~", $masuk);
	$tanggal_masuk = $masuk_array[0];
	$waktu_masuk = $masuk_array[1];


	// echo "WAKTU MASUK PAKET: ".$waktu_masuk."<br>";
	$waktu_masuk_formatted = strtotime($waktu_masuk);
	$waktu_result = (intval($waktu)*60) + $waktu_masuk_formatted;

	// echo $waktu_result-1577466000;

	$waktu_display = date("H:i:s", $waktu_result);
	//secho $waktu_display;
	$discount_start_date = $current." ".$waktu_display;   // php just changed 
	$start_date = date('M d, Y H:i:s', strtotime($discount_start_date));
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
		<div class="row">
			<div class="col-md-3 col-sm-3"></div>
				<div class="col-md-6 col-sm-6">
					<center>
			            <h1><span class="text-tugaskita">TugasKita</span> <small class="text-info">CBTL</small></h1>
			            <p class="text-danger h5">SMAK STELLA MARIS SURABAYA</p><hr><br><br>
						<b>SISA WAKTU :</b> <p id="demo" class="badge badge-primary">.......................</p><br>
						<h1><span class="fa fa-lock animated swing infinite delay-2s slower"></span> safezone</h1>
						<p>Soal Anda Aman</p>
						<a href="cbt-run"><button class="btn btn-primary"><span class="fa fa-arrow-left"></span> KEMBALI</button></a>&nbsp&nbsp&nbsp&nbsp&nbsp
						<button data-toggle="modal" data-target="#last_verification" class="btn btn-success"><span class="fa fa-check"></span> SELESAI</button>
					</center>
				</div>
			<div class="col-md-3 col-sm-3"></div>
		</div>
	</div>
	<!-- The Modal of last verification before finish the test -->
	<div class="modal fade" id="last_verification">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Mengakhiri CBT</h4>
	      </div>
	      <!-- Modal body -->
	      <div class="modal-body">
	        <form action="sistem/set" method="GET">
        		<?php 
        			$isNotDone = false;
        			$currentidx = $_SESSION['soal_idx'];
        			$user = $_SESSION['userid'];
        			$paket = $_SESSION['id_paket'];
        			for ($i=0; $i < count($_SESSION['soal']); $i++) {

    					$soal_id_database = $_SESSION['soal'][$i]['id'];
        				$check_answerSQL = "SELECT * FROM jawaban_masuk WHERE userid='$user' AND soal='$soal_id_database' AND paket='$paket';";
        				$check_answerRES = mysqli_query($connection, $check_answerSQL);
        				$check_answerROW = mysqli_num_rows($check_answerRES);
        				$check_answerFET = mysqli_fetch_assoc($check_answerRES);
        				if ($check_answerFET['ragu'] == 1) {
        					// ragu-ragu
        					echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-warning sendTimer">'.($i+1).'</button>&nbsp';
        				} else if (!($check_answerROW == 1 && $check_answerFET['jawaban'] != "")) {
        					// not answered default button style
        					echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-outline-dark sendTimer">'.($i+1).'</button>&nbsp';
        					$isNotDone = true;
        				}
        			}
        			if (!$isNotDone) {
        				echo "<br><br><p>Soal sudah terjawab semua!</p>";
        			} else {
        				echo "<br><br><p>Terdeteksi soal tidak dijawab!</p>"; 
        			}
        		?>
        	</form>
        	<a href="cbt-safezone"><button type="button" class="btn btn-info btn-sm sendTimer">REFRESH</button></a>
	      </div>
	      <!-- Modal footer -->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">KEMBALI</button>
	        <a href="sistem/selesai"><button class="btn btn-primary btn-sm sendTimer" <?php if($isNotDone){echo "disabled";}?>>SELESAI</button></a>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Times up Modal -->
	<div class="modal fade" id="terimakasih-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">TugasKita CBTL</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Terima Kasih Anda telah mengikuti ujian, semoga sukses terus. Ciayo!
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Selesai</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script>
		// Set the date we're counting down to
		var countDownDate = new Date('<?php echo $start_date;?>').getTime();
		// Update the count down every 1 second
		var x = setInterval(function() {
		  // Get today's date and time
		  var now = new Date().getTime();
		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;
		  // Time calculations for days, hours, minutes and seconds
		  // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		  // Display the result in the element with id="demo"
		  document.getElementById("demo").innerHTML = hours + "j "
		  + minutes + "m " + seconds + "d ";
		  // If the count down is finished, write some text
		  if (distance < 0) {
		    clearInterval(x);
		    $('#terimakasih-modal').modal('show');
		  }
		}, 1000);

		$('#terimakasih-modal').on('hidden.bs.modal', function (e) {
		  window.location.replace("sistem/selesai");
		})
	</script>
</body>
</html>