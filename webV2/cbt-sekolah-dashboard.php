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
	$current = $date."-".$month."-".$year;
	$_SESSION['timelog_sekolah'] = $current;

	$sekolah_id = $_SESSION['sekolah_id'];

	// GRUP
	if (isset($_GET['grupid_sekolah'])) {
		$_SESSION['grupid_sekolah'] = $_GET['grupid_sekolah'];
		unset($_SESSION['userid_sekolah']);
	}
	if (isset($_GET['grupnama_sekolah'])) {
		$_SESSION['grupnama_sekolah'] = $_GET['grupnama_sekolah'];
		unset($_SESSION['userid_sekolah']);
	}

	// USER
	if (isset($_GET['userid_sekolah'])) {
		$_SESSION['userid_sekolah'] = $_GET['userid_sekolah'];
	}
	if (isset($_GET['usernamalengkap_sekolah'])) {
		$_SESSION['usernamalengkap_sekolah'] = $_GET['usernamalengkap_sekolah'];
	}

	// LOG
	if (isset($_GET['timelog_sekolah'])) {
		$timelog_array = explode("-", $_GET['timelog_sekolah']);
		$timelog = $timelog_array[2]."-".$timelog_array[1]."-".$timelog_array[0];
		
		$_SESSION['timelog_sekolah'] = $timelog;
	}
	$_SESSION['START'] = 0;
	$_SESSION['WINDOW-CHANGE'] = 0;
	$_SESSION['OUT-BREAK'] = 0;
	$_SESSION['BACK'] = 0;
	$_SESSION['OUT'] = 0;
	$_SESSION['REFRESH'] = 0;

	function formatDate($date) {
	    $dateArray = explode("-", $date);
	    $day = $dateArray[0];
	    $month = $dateArray[1];
	    $year = $dateArray[2];
	  
	    switch ($month) {
	      case '1':$month = "Januari";break;
	      case '2':$month = "Februari";break;
	      case '3':$month = "Maret";break;
	      case '4':$month = "April";break;
	      case '5':$month = "MEI";break;
	      case '6':$month = "JUNI";break;
	      case '7':$month = "JULI";break;
	      case '8':$month = "Agustus";break;
	      case '9':$month = "September";break;
	      case '10':$month = "Oktober";break;
	      case '11':$month = "November";break;
	      case '12':$month = "Desember";break;
	    }
	    return $day." ".$month." ".$year;
  	}

  	// GET DATA STAR
  	// get first index idpaket dari paket database untuk tampilan default
  	$IndexPaketId = "";
  	$IndexPaketNama = "";
  	$schoolid = $_SESSION['sekolah_id'];

  	if (isset($_GET['select_paket'])) {
  		// GET DATA FROM CUSTOM PAKET
  		$select_paket_data = explode("~", $_GET['select_paket']);
  		$IndexPaketId = $select_paket_data[0];
  		$IndexPaketNama = $select_paket_data[1];

  		// AND STORE IT TO SESSION
  		$_SESSION['IndexPaketId'] = $select_paket_data[0];
	  	$_SESSION['IndexPaketNama'] = $select_paket_data[1];
  	} else if (isset($_SESSION['IndexPaketId']) && isset($_SESSION['IndexPaketNama'])) {
  		// LOAD THE LAST SESSION OF PAKET
  		$IndexPaketId = $_SESSION['IndexPaketId'];
  		$IndexPaketNama = $_SESSION['IndexPaketNama'];
  	} else {
  		// NOT YET DATA JUST DEFAULT VIEW FOR FIRST INDEX PAKET AT DATABASE
  		$P_SQL = "SELECT * FROM paket WHERE sekolah='$schoolid';";
	  	$P_RES = mysqli_query($connection, $P_SQL);
	  	while ($P_FET = mysqli_fetch_assoc($P_RES)) {
	  		$IndexPaketId = $P_FET['id'];
	  		$IndexPaketNama = $P_FET['nama'];

	  		$_SESSION['IndexPaketId'] = $P_FET['id'];
	  		$_SESSION['IndexPaketNama'] = $P_FET['nama'];
	  		break;
	  	}
  	}

  	$star = array(0,0,0,0,0); // [0] => total 1 bintang; [1] => total 2 bintang, ....
  	$I_SQL = "SELECT * FROM insight WHERE paket='$IndexPaketId';";
  	$I_RES = mysqli_query($connection, $I_SQL);
  	while ($I_FET = mysqli_fetch_assoc($I_RES)) {
  		$jumlahBintang = $I_FET['bintang'];
  		if ($jumlahBintang == 1) {
  			$star[0]++;
  		} else if ($jumlahBintang == 2) {
  			$star[1]++;
  		} else if ($jumlahBintang == 3) {
  			$star[2]++;
  		} else if ($jumlahBintang == 4) {
  			$star[3]++;
  		} else if ($jumlahBintang == 5) {
  			$star[4]++;
  		}
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
  	<link href="https://fonts.googleapis.com/css?family=Bungee&display=swap" rel="stylesheet">
  	<style type="text/css">
        h1, h5 {
            font-family: 'Asap', sans-serif;
        }
        p, button, label, form, ol {
            font-family: 'Nunito', sans-serif;
        }
        button {
        	margin-bottom: 5px; 
        }

        td{
		    word-wrap:break-word
		}

		.scrollBar {
			height: 200px;
			overflow-y: scroll;
		}
		.scrollBarLong {
			height: 300px;
			overflow-y: scroll;
		}

		.cbt-status {
			font-family: 'Bungee', cursive;
		}
    </style>
</head>
<body>
	<div class="container"><br><br>
  		<h1><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png"> TugasKita <small class="text-info">sekolah</small></h1><br>
  		<a href="sistem/logout?type=sekolah"><button class="btn btn-danger btn-sm"><span class="fa fa-sign-out"></span> keluar</button></a>
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<div class="card border-primary">
  					<div class="card-body">
  						<b><span class="fa fa-thumbs-o-up"></span> Selamat Datang, <?php echo $_SESSION['sekolah_nama'];?></b>
  					</div>
  				</div><br>
  				<div class="card">
  					<div class="card-header bg-primary text-light">
  						<b class="h4">DAFTAR KELAS</b>
  					</div>
  					<div class="card-body">
	  					<ul class="nav nav-pills nav-stacked scrollBar">
					    	<?php
					    		// LOAD ALL GRUP
								$SQL = "SELECT * FROM grup";
								$RES = mysqli_query($connection, $SQL);
								while ($FET = mysqli_fetch_assoc($RES)) {
									$id = $FET['grup_id'];
									$nama = $FET['grup_nama'];
									if ((isset($_SESSION['grupid_sekolah']) && $id == $_SESSION['grupid_sekolah']) || (isset($_GET['grupid_sekolah']) && $id == $_GET['grupid_sekolah'])) {
										echo '<li class="nav-item">
								      		<a class="nav-link active" href="cbt-sekolah-dashboard?grupid_sekolah='.$id.'&grupnama_sekolah='.$nama.'">'.$nama.'</a>
								    	</li>';
									} else {
										echo '<li class="nav-item">
								      		<a class="nav-link" href="cbt-sekolah-dashboard?grupid_sekolah='.$id.'&grupnama_sekolah='.$nama.'">'.$nama.'</a>
								    	</li>';
									}
								}
					    	?>
					  	</ul>
					</div>
  				</div><br>
  				<div id="cheating_prosentase" style="width: 400px; height: 200px;"></div>
  				<div class="card">
  					<div class="card-header bg-primary text-light">
  						<b class="h5">Siswa <?php if(isset($_SESSION['grupnama_sekolah'])){echo $_SESSION['grupnama_sekolah'];}?></b>
  					</div>
  					<div class="card-body">
	  					<ul class="nav nav-pills nav-stacked scrollBarLong">
					    	<?php
					    		// LOAD USER IN SELECTED GRUP
								if (isset($_SESSION['grupid_sekolah'])) {
									
									$grupid = $_SESSION['grupid_sekolah'];

									$SQL = "SELECT * FROM user_grup WHERE grup_id='$grupid';";
									$RES = mysqli_query($connection, $SQL);
									while ($FET = mysqli_fetch_assoc($RES)) {
										$userid = $FET['user_id'];
										$start = 0;
										$window_change = 0;
										$out_break = 0;
										$back = 0;
										$out = 0;
										$refresh = 0;
										// GET LOG DATA
										$L_SQL = "SELECT * FROM log_cbt WHERE userid='$userid';";
										
										$L_RES = mysqli_query($connection, $L_SQL);
										$L_ROW = mysqli_num_rows($L_RES);
										if ($L_ROW > 0) {
											while ($L_FET = mysqli_fetch_assoc($L_RES)) {
												$tanggal = $L_FET['tanggal'];
												$log = $L_FET['log'];

												// echo "<tr>";
												// echo "<td>".$tanggal."</td><br>";
												$i = 1;
												$log_array = explode("#", $log);
												foreach ($log_array as $key1 => $value1) {
													// echo "<span class='badge badge-danger'>SESI ".$i."</span><br>";
													$value1_array = explode("/", $value1);
													foreach ($value1_array as $key2 => $value2) {

														if ($key2 == count($value1_array)-1) 
															continue;

														$value2_array = explode("~", $value2);
														foreach ($value2_array as $key3 => $value3) {
															if ($key3 == 0) {
																// waktu
																// echo '<b>'.$value3."</b>: ";
															} else {
																// type
																// echo $value3;
																if ($value3 == "START") {
																	$start++;
																} elseif ($value3 == "WINDOW-CHANGE") {
																	$window_change++;
																} elseif ($value3 == "OUT-BREAK") {
																	$out_break++;
																} else if ($value3 == "BACK") {
																	$back++;
																} elseif ($value3 == "OUT") {
																	$out++;
																} else if ($value3 == "REFRESH") {
																	$refresh++;
																}
															}
														}
														// echo "<br>";
													}

													$i++;
													// echo "</tr>";
												}
											}
										} else {
											// echo "<p>No data yet!</p>";
										}
										//  GET INFO FROM akun TABLE
										$A_SQL = "SELECT * FROM akun WHERE user_id='$userid';";
										$A_RES = mysqli_query($connection, $A_SQL);
										$A_FET = mysqli_fetch_assoc($A_RES);

										$id_user = $A_FET['user_id'];
										$nama_user = $A_FET['user_namalengkap'];
										if (isset($_SESSION['userid_sekolah']) && $id_user == $_SESSION['userid_sekolah']) {
										echo '<li class="nav-item">
								      		<a class="nav-link active" href="cbt-sekolah-dashboard?userid_sekolah='.$id_user.'&usernamalengkap_sekolah='.$nama_user.'">'.$nama_user.' <span class="badge badge-danger"><span class="fa fa-warning"></span> '.$window_change.'</span> <span class="badge badge-warning"><span class="fa fa-minus-circle"></span> '.$out_break.'</span></a>
								    	</li>';
										} else {
											echo '<li class="nav-item">
									      		<a class="nav-link" href="cbt-sekolah-dashboard?userid_sekolah='.$id_user.'&usernamalengkap_sekolah='.$nama_user.'">'.$nama_user.' <span class="badge badge-danger"><span class="fa fa-warning"></span> '.$window_change.'</span> <span class="badge badge-warning"><span class="fa fa-minus-circle"></span> '.$out_break.'</span></a>
									    	</li>';
										}
										// masukan ke session log cbt data
										$_SESSION['START'] += $start;
										$_SESSION['WINDOW-CHANGE'] += $window_change;
										$_SESSION['OUT-BREAK'] += $out_break;
										$_SESSION['BACK'] += $back;
										$_SESSION['OUT'] += $out;
										$_SESSION['REFRESH'] += $refresh;
									}
								}
					    	?>
					  	</ul>
					</div>
  				</div>
			</div>
			<div class="col-md-8 col-sm-12">
  				<button class="btn btn-dark" data-toggle="modal" data-target="#bankPaketSoalModal"><span class="fa fa-archive"></span> BANK PAKET SOAL</button><br>
  				<div id="star_chart" style="height: 400px;"></div>
  				<button class="btn btn-dark" data-toggle="modal" data-target="#komentarSiswa" >Komentar Untuk '<?php echo $IndexPaketNama;?>'</button><br><br>
  				<form action="cbt-sekolah-dashboard" method="GET">
  					<div class="form-group row">
					    <label for="staticEmail" class="col-sm-2 col-form-label">LAPORAN</label>
					    <div class="col-md-4 col-sm-10">
					    	<select name="select_paket" class="form-control">
					      		<?php
					      			$S_SQL = "SELECT * FROM paket WHERE sekolah='$schoolid';";
					      			$S_RES = mysqli_query($connection, $S_SQL);
					      			while ($S_FET = mysqli_fetch_assoc($S_RES)) {
					      				$paketid = $S_FET['id'];
					      				$paketnama = $S_FET['nama'];
					      				echo '<option value="'.$paketid.'~'.$paketnama.'">'.$paketnama.'</option>';
					      			}
					      		?>
					      	</select>
					    </div>
					    <div class="col-md-2 col-sm-10">
					      	<button class="btn btn-success" type="submit" name="submit">SUBMIT</button>
					    </div>
					</div>
  				</form><hr><br>
  				<div class="card border-primary">
					<div class="card-header bg-primary text-light">
						<h4>INFORMASI CBT | <?php if(isset($_SESSION['usernamalengkap_sekolah'])){echo $_SESSION['usernamalengkap_sekolah'];}else{echo "INFORMASI CBT";}?></h4>
					</div>
					<div class="card-body">
						<div class="scrollBarLong">
							<?php
								// LOAD LOG_CBT
								if (isset($_SESSION['userid_sekolah'])) {
									$user = $_SESSION['userid_sekolah'];
									// CHECK JIKA LOG_CBT MEMILIH TANGGAL LAIN
									if (isset($_SESSION['timelog_sekolah'])) {
										$custom_tanggal = $_SESSION['timelog_sekolah'];
										$L_SQL = "SELECT * FROM log_cbt WHERE userid='$user' AND tanggal='$custom_tanggal';";
									} else {
										$L_SQL = "SELECT * FROM log_cbt WHERE userid='$user' AND tanggal='$current';";
									}
									$L_RES = mysqli_query($connection, $L_SQL);
									$L_ROW = mysqli_num_rows($L_RES);
									if ($L_ROW > 0) {
										while ($L_FET = mysqli_fetch_assoc($L_RES)) {
											$tanggal = $L_FET['tanggal'];
											$log = $L_FET['log'];

											echo "<tr>";
											echo "<td><h5 class='text-center'>".formatDate($tanggal)."</h5></td><br>";

											$i = 1;
											$log_array = explode("#", $log);
											foreach ($log_array as $key1 => $value1) {
												echo "<span class='badge badge-primary'>SESI ".$i."</span><br>";
												$value1_array = explode("/", $value1);
												foreach ($value1_array as $key2 => $value2) {

													if ($key2 == count($value1_array)-1) 
														continue;

													$value2_array = explode("~", $value2);
													foreach ($value2_array as $key3 => $value3) {
														if ($key3 == 0) {
															// waktu
															echo '<b>'.$value3."</b>: ";
														} else {
															// type
															echo '<span class="cbt-status">'.$value3.'</span>';
														}
													}
													echo "<br>";
												}
												$i++;
												echo "</tr>";
											}
										}
									} else {
										echo "<p>No data yet!</p>";
									}
								} else {
									echo "Pilih satu murid untuk melihat data!";
								}
							?>
						</div>
					</div>
					<div class="card-footer text-right">
						Data pada: <?php echo formatDate($_SESSION['timelog_sekolah']);?>
					</div>
				</div><br>
				<form action="cbt-sekolah-dashboard" method="GET">
  					<div class="form-group row">
					    <label for="staticEmail" class="col-sm-2 col-form-label">CBT TANGGAL</label>
					    <div class="col-md-4 col-sm-10">
					    	<input type="date" name="timelog_sekolah" class="form-control" required>
					    </div>
					    <div class="col-md-2 col-sm-10">
					      	<button class="btn btn-success" type="submit">LIHAT DATA</button>
					    </div>
					</div>
  				</form>
			</div>
		</div><br><br><br>
	</div>

	<!-- Modal Komentar Siswa -->
	<div class="modal fade" id="komentarSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-dark text-light">
	        <h5 class="modal-title" id="exampleModalLabel">Komentar Siswa | <?php echo $IndexPaketNama;?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="list-group list-group-flush">
	        <?php
	        	$I_SQL = "SELECT * FROM insight WHERE paket='$IndexPaketId';";
			  	$I_RES = mysqli_query($connection, $I_SQL);
			  	while ($I_FET = mysqli_fetch_assoc($I_RES)) {
			  		$jumlahBintang = $I_FET['bintang'];
			  		$komentar = $I_FET['komentar'];
			  		echo '<span class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1">';
			      for ($i=0; $i < $jumlahBintang; $i++) { 
			      	echo '<span class="fa fa-star text-warning"></span>';
			      }
			      echo '</h5>
			      <!-- <small>3 days ago</small> -->
			    </div>
			    <p class="mb-1">'.$komentar.'</p>
			    <!-- <small>Donec id elit non mi porta.</small> -->
			  </span>';

			  	}
	        ?> 
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal BankPaketSoal -->
	<div class="modal fade" id="bankPaketSoalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-dark text-light">
	        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-archive"></span> BANK PAKET SOAL</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <ul class="list-group">
	        	<label>Paket Non-Aktif</label>
	        	<?php
	        		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND aktif='0';";
	        		$P_RES = mysqli_query($connection, $P_SQL);
	        		$P_ROW = mysqli_num_rows($P_RES);
	        		if ($P_ROW > 0) {
	        			while ($P_FET = mysqli_fetch_assoc($P_RES)) {
	        				$P_PAKETID = $P_FET['id'];
	        				$P_PAKETNAMA = $P_FET['nama'];
	        				$P_PAKETBUTIR = $P_FET['butir'];

	        				$S_SQL = "SELECT * FROM soal WHERE paket='$P_PAKETID'";
	        				$S_RES = mysqli_query($connection, $S_SQL);
	        				$S_ROW = mysqli_num_rows($S_RES);

	        				echo '<a href="sistem/load_paket_upload?paket='.$P_PAKETID.'&sekolah='.$sekolah_id.'" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">'.$P_PAKETNAMA.'<span class="badge badge-primary badge-pill">'.$S_ROW.' / '.$P_PAKETBUTIR.'</span></a>';
	        				echo '<div class="text-right">
	        					<span class="badge">TOKEN: '.$P_PAKETID.'</span>
	        				</div>';
	        			}
	        		} else {
	        			echo "<p>Paket Tidak Aktif belum tersedia!</p>";
	        		}
	        	?>
			</ul><hr>
			<ul class="list-group">
				<label>Paket Aktif</label>
	        	<?php
	        		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND aktif='1';";
	        		$P_RES = mysqli_query($connection, $P_SQL);
	        		$P_ROW = mysqli_num_rows($P_RES);
	        		if ($P_ROW > 0) {
	        			while ($P_FET = mysqli_fetch_assoc($P_RES)) {
	        				$P_PAKETID = $P_FET['id'];
	        				$P_PAKETNAMA = $P_FET['nama'];
	        				$P_PAKETBUTIR = $P_FET['butir'];

	        				$S_SQL = "SELECT * FROM soal WHERE paket='$P_PAKETID'";
	        				$S_RES = mysqli_query($connection, $S_SQL);
	        				$S_ROW = mysqli_num_rows($S_RES);

	        				echo '<a href="sistem/load_paket_upload?paket='.$P_PAKETID.'&sekolah='.$sekolah_id.'" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">'.$P_PAKETNAMA.'<span class="badge badge-primary badge-pill">'.$S_ROW.' / '.$P_PAKETBUTIR.'</span></a>';
	        				echo '<div class="text-right">
	        					<span class="badge">TOKEN: '.$P_PAKETID.'</span>
	        					<a href="cbt-nilai?sekolah='.$sekolah_id.'&paket='.$P_PAKETID.'"><button class="btn btn-sm btn-primary">Lihat Nilai</button></a>
	        					<a href="cbt-statistik?sekolah='.$sekolah_id.'&paket='.$P_PAKETID.'"><button class="btn btn-sm btn-success">Lihat Kinerja</button></a>
	        				</div>';
	        			}
	        		} else {
	        			echo "<p>Paket Aktif belum tersedia!</p>";
	        		}
	        	?>
			</ul>
	      </div>
	      <div class="modal-footer">
	        <a href="cbt-upload"><button type="button" class="btn btn-success">Buat Paket Baru</button></a>
	        <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Bintang', 'Bintang'],
          ['1 star', <?php echo $star[0];?>],
          ['2 star', <?php echo $star[1];?>],
          ['3 star', <?php echo $star[2];?>],
          ['4 star', <?php echo $star[3];?>],
          ['5 star', <?php echo $star[4];?>],
        ]);
        var options = {
          chart: {
            title: 'Kinerja Paket Soal',
            subtitle: 'Bintang, Mata Pelajaran, dan Jumlah Bintang: <?php echo $year;?> | <?php echo $IndexPaketNama;?>',
          }
        };
        var chart = new google.charts.Bar(document.getElementById('star_chart'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['START', <?php echo $_SESSION['START'];?>],
          ['WINDOW-CHANGE', <?php echo $_SESSION['WINDOW-CHANGE'];?>],
          ['OUT-BREAK', <?php echo $_SESSION['OUT-BREAK'];?>],
          ['BACK', <?php echo $_SESSION['BACK'];?>],
          ['OUT', <?php echo $_SESSION['OUT'];?>],
          ['REFRESH', <?php echo $_SESSION['REFRESH'];?>]
        ]);
        var options = {
          title: 'Aktifitas CBT <?php if(isset($_SESSION['grupnama_sekolah'])){echo $_SESSION['grupnama_sekolah'];}else{echo "Kelas";}?>',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('cheating_prosentase'));
        chart.draw(data, options);
      }
    </script>
</body>
</html>