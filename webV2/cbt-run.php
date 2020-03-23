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

	// block the sniffer
	if (!isset($_SESSION['id_paket'])) {
		header("Location: cbt-start");
	}

	if (!isset($_SESSION['soal'])) {
		header("Location: cbt-dashboard");
	}

	$user = $_SESSION['userid'];
	$soal_id = $_SESSION['soal'][$_SESSION['soal_idx']]['id'];
	$paket = $_SESSION['id_paket']; // nanti diganti dengan session['paket']
	$waktu = $_SESSION['waktu_paket'];
	$sekolah = $_SESSION['sekolah_paket'];
	$kunci = $_SESSION['kunci_paket'];
	// cek kunci ada atau tidak
	if ($kunci == "") {
		$_SESSION['cbt-error'] = "Paket Soal terenkripsi dan tidak bisa di akses!";
		header("Location: cbt-error?err=Paket Soal terenkripsi dan tidak bisa di akses!");
		exit();
	}

	// Insert into session
	$_SESSION['soalid'] = $soal_id;

	$SQL = "SELECT * FROM soal WHERE id='$soal_id' AND paket='$paket' AND sekolah='$sekolah';";
	$RES = mysqli_query($connection, $SQL);
	$FET = mysqli_fetch_assoc($RES);

	$soal = decrypt($FET['soal'], $kunci);
	$gambar = decrypt($FET['gambar'], $kunci);
	$a = decrypt($FET['a'], $kunci);
	$a_gambar = decrypt($FET['a_gambar'], $kunci);
	$b = decrypt($FET['b'], $kunci);
	$b_gambar = decrypt($FET['b_gambar'], $kunci);
	$c = decrypt($FET['c'], $kunci);
	$c_gambar = decrypt($FET['c_gambar'], $kunci);
	$d = decrypt($FET['d'], $kunci);
	$d_gambar = decrypt($FET['d_gambar'], $kunci);
	$e = decrypt($FET['e'], $kunci);
	$e_gambar = decrypt($FET['e_gambar'], $kunci);
	$benar = decrypt($FET['benar'], $kunci);

	// Check apakah soal sudah dijawab
	$SQL = "SELECT * FROM jawaban_masuk WHERE userid='$user' AND soal='$soal_id' AND paket='$paket' AND sekolah='$sekolah';";
	$RES = mysqli_query($connection, $SQL);
	$ROW = mysqli_num_rows($RES);

	if ($ROW > 0) {
		$FET = mysqli_fetch_assoc($RES);
		if ($FET['jawaban'] != "") {
			$jawaban = $FET['jawaban'];
		}
		if ($FET['ragu'] != "0") { // 0 = false; 1 = true
			$ragu = $FET['ragu'];
		}
	}

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



	function decrypt($text, $key) {
		// Store the cipher method 
	    $ciphering = "AES-128-CTR"; 
		$options = 0;
		// Non-NULL Initialization Vector for decryption 
      	$decryption_iv = '1234567891011121'; 
        
      	// Store the decryption key 
      	$decryption_key = $key; 
        
      	// Use openssl_decrypt() function to decrypt the data 
      	$decryption=openssl_decrypt ($text, $ciphering, $decryption_key, $options, $decryption_iv); 
      	return $decryption;
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
        #demo, #soal {
        	font-size: 18px;
        }
        input[type='radio'] { 
        	transform: scale(1.5); 
        }
        input[type='checkbox'] { 
        	transform: scale(2); 
        }
        #option-text {
        	margin-left: 10px;
        }
        .bg-tugaskita {
        	background-color: #001629;
        }
        .text-tugaskita {
        	color: #001629;
        }

        /* Hide the browser's default radio button */
		.container input {
		  position: absolute;
		  opacity: 0;
		  cursor: pointer;
		}

        /* Create a custom radio button */
		.checkmark {
		  position: absolute;
		  top: 0;
		  left: 0;
		  height: 25px;
		  width: 25px;
		  background-color: #eee;
		  border-radius: 50%;
		}

		/* On mouse-over, add a grey background color */
		.container:hover input ~ .checkmark {
		  background-color: #ccc;
		  cursor: pointer;
		}

		/* When the radio button is checked, add a blue background */
		.container input:checked ~ .checkmark {
		  background-color: #2196F3;
		}

		/* Create the indicator (the dot/circle - hidden when not checked) */
		.checkmark:after {
		  content: "";
		  position: absolute;
		  display: none;
		}

		/* Show the indicator (dot/circle) when checked */
		.container input:checked ~ .checkmark:after {
		  /*display: block;*/
		}

		/* Style the indicator (dot/circle) */
		.container .checkmark:after {
		 	top: 9px;
			left: 9px;
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: white;
		}

		.checkmark {
			font-weight: bold;
			font-family: sans-serif;
        }
    </style>
</head>
<body>
	<div class="container animated fadeInRight">
		<div class="row mt-3">
			<div class="col-md-3"></div>
			<div class="col-md-6 col-sm-12">
				<center>
		            <p class="text-danger h6">SMAK STELLA MARIS SURABAYA</p><hr>
				</center>
				<div class="row">
					<div class="col-5">
						<h1 id="soal" class="badge badge-pill badge-dark"><?php echo $_SESSION['soal_idx']+1;?> dari <?php echo count($_SESSION['soal']);?></h1><br>
						<a href="cbt-safezone"><button class="btn-warning sendTimer">safezone</button></a>
					</div>
					<div class="col-7">
						<div class="text-right">
							<b>SISA WAKTU :</b> <p id="demo" class="badge badge-primary">.......................</p><br>
							<button data-toggle="modal" data-target="#daftarsoal" class="btn btn-sm btn-info"><span class="fa fa-book"></span> DAFTAR SOAL</button>
						</div>
					</div>
				</div><br><br>
				<?php 
					if ($gambar != null) {
						if (strpos($gambar, ',')) {
							$gambar_array = explode(",", $gambar);
							foreach ($gambar_array as $key => $value) {
								if ($value == null) // check the last index | ussually null
									continue;
								echo '<img class="gambar img-fluid img-thumbnail" src="'.$value.'" width="120">';
							}
						} else {
							echo '<img class="gambar img-fluid img-thumbnail" src="'.$gambar.'" width="120" class="img-fluid img-thumbnail">';
						}
					}
				?>
				<p class="h5"><?php echo $soal; ?></p><br>
				<form id="pilihan" action="#" method="GET" class="mt-3">
					<div class="form-check">
					  <label class="form-check-label">
					    <input type="radio" class="form-check-input" name="optradio" value="A" <?php if(isset($jawaban) && $jawaban=="A")echo "checked";?>><span id="option-text"><?php echo $a;?></span><br>
					    <div class="ml-2">
						  	<?php 
								if ($a_gambar != null) {
									if (strpos($a_gambar, ',')) {
										$a_gambar_array = explode(",", $a_gambar);
										foreach ($a_gambar_array as $key => $value) {
											if ($value == null) // check the last index | ussually null
												continue;
											echo '<img class="gambar img-fluid img-thumbnail" src="'.$value.'" width="80">';
										}
									} else {
										echo '<img class="gambar img-fluid img-thumbnail" src="'.$a_gambar.'" width="80">';
									}
								}
							?>
					  	</div>
					    <span class="checkmark text-center">A</b></span>
					  </label>
					</div><br>
					<div class="form-check">
					  <label class="form-check-label">
					    <input type="radio" class="form-check-input" name="optradio" value="B" <?php if(isset($jawaban) && $jawaban=="B")echo "checked";?>><span id="option-text"><?php echo $b;?></span><br>
					    <div class="ml-2">
						  	<?php 
								if ($b_gambar != null) {
									if (strpos($b_gambar, ',')) {
										$b_gambar_array = explode(",", $b_gambar);
										foreach ($b_gambar_array as $key => $value) {
											if ($value == null) // check the last index | ussually null
												continue;
											echo '<img class="gambar img-fluid img-thumbnail" src="'.$value.'" width="80">';
										}
									} else {
										echo '<img class="gambar img-fluid img-thumbnail" src="'.$b_gambar.'" width="80">';
									}
								}
							?>
					  	</div>
					    <span class="checkmark text-center">B</span>
					  </label>
					</div><br>
					<div class="form-check">
					  <label class="form-check-label">
					    <input type="radio" class="form-check-input" name="optradio" value="C" <?php if(isset($jawaban) && $jawaban=="C")echo "checked";?>><span id="option-text"><?php echo $c;?></span><br>
					    <div class="ml-2">
						    <?php 
								if ($c_gambar != null) {
									if (strpos($c_gambar, ',')) {
										$c_gambar_array = explode(",", $c_gambar);
										foreach ($c_gambar_array as $key => $value) {
											if ($value == null) // check the last index | ussually null
												continue;
											echo '<img class="gambar img-fluid img-thumbnail" src="'.$value.'" width="80">';
										}
									} else {
										echo '<img class="gambar img-fluid img-thumbnail" src="'.$c_gambar.'" width="80">';
									}
								}
							?>
						</div>
					    <span class="checkmark text-center">C</span>
					  </label>
					</div><br>
					<div class="form-check">
					  <label class="form-check-label">
					    <input type="radio" class="form-check-input" name="optradio" value="D" <?php if(isset($jawaban) && $jawaban=="D")echo "checked";?>><span id="option-text"><?php echo $d;?></span><br>
					    <div class="ml-2">
						    <?php 
								if ($d_gambar != null) {
									if (strpos($d_gambar, ',')) {
										$d_gambar_array = explode(",", $d_gambar);
										foreach ($d_gambar_array as $key => $value) {
											if ($value == null) // check the last index | ussually null
												continue;
											echo '<img class="gambar img-fluid img-thumbnail" src="'.$value.'" width="80">';
										}
									} else {
										echo '<img class="gambar img-fluid img-thumbnail" src="'.$d_gambar.'" width="80">';
									}
								}
							?>
						</div>
					    <span class="checkmark text-center">D</span>
					  </label>
					</div><br>
					<div class="form-check">
					  <label class="form-check-label">
					    <input type="radio" class="form-check-input" name="optradio" value="E" <?php if(isset($jawaban) && $jawaban=="E")echo "checked";?>><span id="option-text"><?php echo $e;?></span><br>
					    <div class="ml-2">
						    <?php 
								if ($e_gambar != null) {
									if (strpos($e_gambar, ',')) {
										$e_gambar_array = explode(",", $e_gambar);
										foreach ($e_gambar_array as $key => $value) {
											if ($value == null) // check the last index | ussually null
												continue;
											echo '<img class="gambar img-fluid img-thumbnail" src="'.$value.'" width="80">';
										}
									} else {
										echo '<img class="gambar img-fluid img-thumbnail" src="'.$e_gambar.'" width="80">';
									}
								}
							?>
						</div>
					    <span class="checkmark text-center">E</span>
					  </label>
					</div><br>
				</form>
				<br><br>
				<div class="row">
					<div class="col-md-4">				
						<?php
							if ($_SESSION['soal_idx'] != 0) {
								echo '<form action="sistem/set" method="GET">
							<button type="submit" name="new_soal_idx" value="'.($_SESSION['soal_idx']-1).'" class="btn btn-secondary btn-block sendTimer"><span class="fa fa-arrow-left"></span> KEMBALI</button></a>
						</form><br>';
							}
						?>
					</div>
					<div class="col-md-4">
						<div class="custom-control custom-checkbox mb-3 ml-4">
					      <input type="checkbox" class="custom-control-input ragu" id="customCheck" name="ragu" <?php if (isset($ragu)) {echo "checked";}?>>
					      <label class="custom-control-label text-warning" for="customCheck" style="font-family: arial;"><b>RAGU-RAGU</b></label>
					    </div>
					</div>
					<div class="col-md-4">
						<?php 
							if ($_SESSION['soal_idx'] != count($_SESSION['soal'])-1) {
								echo '<form action="sistem/set" method="GET">
							<button name="new_soal_idx" value="'.($_SESSION['soal_idx']+1).'" class="btn btn-success btn-block sendTimer">LANJUT <span class="fa fa-arrow-right"></span></button></a>
						</form>';
							}
						?>
						
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div><br><br><br><br>
	</div>
	<!-- The Modal Daftar Soal -->
	  <div class="modal fade" id="daftarsoal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-body">
	        	<div class="row">
		      		<div class="col-8">
		      			<h4 class="modal-title">Daftar Soal</h4>
		      		</div>
		      		<div class="col-4">
		      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          	<span aria-hidden="true">&times;</span>
				        </button>
		      		</div>
		      	</div>
	        	<form action="sistem/set" method="GET" class="mt-2">
	        		<?php 
	        			$currentidx = $_SESSION['soal_idx'];
	        			for ($i=0; $i < count($_SESSION['soal']); $i++) {
	        				if ($currentidx==$i) {
	        					// current soal position button style
	        					echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-dark sendTimer">'.($i+1).'</button>&nbsp';
	        				} else {
	        					$soal_id_database = $_SESSION['soal'][$i]['id'];
		        				$check_answerSQL = "SELECT * FROM jawaban_masuk WHERE soal='$soal_id_database' AND paket='$paket' AND userid='$user';";
		        				$check_answerRES = mysqli_query($connection, $check_answerSQL);
		        				$check_answerROW = mysqli_num_rows($check_answerRES);
		        				$check_answerFET = mysqli_fetch_assoc($check_answerRES);
		        				if ($check_answerFET['ragu'] == 1) {
		        					// ragu-ragu
		        					echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-warning sendTimer">'.($i+1).'</button>&nbsp';
		        				} else if ($check_answerROW == 1 && $check_answerFET['jawaban'] != "") {
		        					// answered button style 
		        					echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-secondary sendTimer">'.($i+1).'</button>&nbsp';
		        				} else {
		        					// not answered default button style
		        					echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-outline-secondary sendTimer">'.($i+1).'</button>&nbsp';
		        				}
	        				}
	        			}
	        		?>
	        		
	        	</form>
	        </div>   
	      </div>
	    </div>
	  </div>

	<!-- Times up Modal -->
	<div class="modal fade" id="terimakasih-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="exampleModalLongTitle">TugasKita CBTL</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	        <p>Terima Kasih Anda telah mengikuti ujian, semoga sukses terus. Ciayo!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Gambar Preview -->
	<div class="modal fade" id="gambar-preview-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="exampleModalLongTitle"><span class="fa fa-image"></span> FOTO</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	        <img src="" id="gambar-preview-img" class="img-fluid mt-2">
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
	<script>
		function sendAnswer(str, type) {
	        var xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                detectDone();
	            }
	        };
	        xmlhttp.open("GET", "sistem/send_answer?q="+str+"&type="+type, true);
	        xmlhttp.send();
		}
		$('#pilihan input').on('change', function() {
		   sendAnswer($('input[name=optradio]:checked', '#pilihan').val(), 'jawaban');
		});
		$('.ragu').click(function(){
            if($(this).prop("checked") == true){
                sendAnswer('1', 'ragu');
            }
            else if($(this).prop("checked") == false){
                sendAnswer('0', 'ragu');
            }
        });
	</script>
	<!-- Timer every soal -->
	<script type="text/javascript">
		var totalSeconds = 0;
		setInterval(setTime, 1000);

		function setTime() {
		  ++totalSeconds;
		  // secondsLabel.innerHTML = pad(totalSeconds % 60);
		  // minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
		}

		$('.sendTimer').click(function(){
			sendAnswer(totalSeconds, "timer");            
        });
	</script>
	<!-- Detect Kalau ada -->
	<script type="text/javascript">
		function detectClickGambarPreviewModal() {
	  		$(".gambar").click(function(event) {
	  			var srcImg = $(this).attr('src');
	  			$('#gambar-preview-modal').modal('show');
	  			$('#gambar-preview-modal').on('shown.bs.modal', function (e) {
					$("#gambar-preview-img").attr('src', srcImg);
				});
	  		});
  		}
  		detectClickGambarPreviewModal();
	</script>
	<!-- Detect Done -->
	<script type="text/javascript">
		function detectDone() {
			$("#status-selesai").text("Soal belum selesai dikerjakan!");
			$("#selesai-button-verification").hide();
  			$.post("sistem/check_all_done_cbt", 
  			{
  				
  			}, function(data, status) {
  				if (data == "1") {
					$("#status-selesai").text("Semua soal telah terjawab!");
					$("#selesai-button-verification").show('slow');
  				} else if (data == "2") {
					$("#status-selesai").text("Terdapat soal 'ragu-ragu' tapi Anda masih bisa meyelesaikan!");
					$("#selesai-button-verification").show('slow');
  				}
  			});
  		}
  		detectDone();
	</script>
</body>
</html>