<?php
	session_start();
	require 'web/sistem/connection.php';

	if (isset($_GET['submit_absent'])) {
		$data = explode("~", $_GET['submit_absent']);

		$_SESSION['grupid_absent'] = $data[0];
		$_SESSION['grupnama_absent'] = $data[1];

		unset($_SESSION['month']);
		unset($_SESSION['year']);
		unset($_SESSION['absent-data']);
	}
?>
<html lang="en">
  <head>
  	<link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/ico.png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">

    <title>TugasKita Absent</title>
    <style type="text/css">
    	h1 {
    		font-family: 'Asap', sans-serif;
    	}
    	table td, p, .tugaskita_sekolah {
    		font-family: 'Nunito', sans-serif;
    	}
    	button:hover {
    		cursor: pointer;
    	}
    	table tbody tr td .absent-date {
    		font-size:10px;
    	}
    	table tbody tr td .absent-status {
    		font-size:10px;
    		font-family: arial;
    		font-weight: bold;
    	}
    </style>
  </head>
  <body>
  	<div class="container">
  		<br>
  		<h1><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png"> TugasKita <small class="text-danger">absent</small></h1>
  		<br>
  		<a href="sekolah"><button class="btn btn-primary tugaskita_sekolah">TUGASKITA SEKOLAH</button></a>
  		<br><br>
  		<h3><u>DAFTAR KELAS</u></h3><br>
  		<div class="list-group">
  			<form action="absent" method="GET">
  				<div class="form-group row">
  			<?php
	  			$G_SQL = "SELECT * FROM grup";
	  			$G_RES = mysqli_query($connection, $G_SQL);
	  			while ($G_FET = mysqli_fetch_assoc($G_RES)) {
	  				$grupid = $G_FET['grup_id'];
	  				// Get how much student
	  				$UG_SQL = "SELECT * FROM user_grup WHERE grup_id='$grupid';";
	  				$UG_RES = mysqli_query($connection, $UG_SQL);
	  				$UG_ROW = mysqli_num_rows($UG_RES);
	  				// Add them
	  				$grupid = $G_FET['grup_id'];
	  				$grupnama = $G_FET['grup_nama'];
	  				echo '
					<div class="col-2">
	 	  				<button type="submit" value="'.$grupid.'~'.$grupnama.'" name="submit_absent" class="list-group-item justify-content-between btn-sm">
			  				<b>'.$grupnama.'</b>
			    			<span class="badge badge-primary">'.$UG_ROW.' siswa</span>
			    		</button><br>
		    		</div>
	  				';
	  			}
	  		?>
			    </div>
  			</form>
		</div>

		<h3><u>DATABASE</u></h3><br>
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<small class="text-muted">menampilkan sekarang</small>
				<h1 class="text-success"><b><?php if(isset($_SESSION['grupnama_absent'])) echo $_SESSION['grupnama_absent']; else echo "NO DATA" ?></b></h1><br>

				<div class="list-group" id="list-tab" role="tablist">
					<form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="1">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==1){echo "active";}}?>">Januari</button>
					</form>
					<form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="2">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==2){echo "active";}}?>">Februari</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="3">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==3){echo "active";}}?>">Maret</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="4">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==4){echo "active";}}?>">April</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="5">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==5){echo "active";}}?>">Mei</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="6">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==6){echo "active";}}?>">Juni</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="7">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==7){echo "active";}}?>">Juli</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="8">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==8){echo "active";}}?>">Agustus</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="9">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==9){echo "active";}}?>">September</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="10">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==10){echo "active";}}?>">Oktober</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="11">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==11){echo "active";}}?>">November</button>
				    </form>
				    <form action="admin_systems/absent.sys.php" method="GET">
						<input type="hidden" name="month" value="12">
				      	<button type="submit" class="list-group-item list-group-item-action <?php if(isset($_SESSION['month'])) {if($_SESSION['month']==12){echo "active";}}?>">Desember</button>
				    </form>
			    </div><br><br>
			    <b>kritik/saran:</b> tugaskitaindonesia@gmail.com<br>
				empowered by <b>TugasKita Indonesia</b>
				<br><br><br>
			</div>
			<div class="col-md-8 col-sm-12">
				<div class="text-right">
					<p>data pada: 
						<span class="badge badge-primary">
							<?php  
							if (isset($_SESSION['month']) && isset($_SESSION['year'])) {
								echo intToMonthNama($_SESSION['month'], true)." ".$_SESSION['year'];
							} else {
								echo "Pilih salah satu bulan untuk melihat data";
							}
							?> 
						</span>
					</p>
				</div>
				<table class="table table-bordered text-center table-sm">
					<thead class="bg-primary">
						<tr>
							<th class="text-light">NAMA SISWA</th>
							<th class="text-light">KEHADIRAN</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (isset($_SESSION['grupid_absent'])) {
								$grupid = $_SESSION['grupid_absent'];
								$UG_SQL = "SELECT * FROM user_grup WHERE grup_id='$grupid';";
								$UG_RES = mysqli_query($connection, $UG_SQL);
								$UG_ROW = mysqli_num_rows($UG_RES);
								$index = 0;
								while ($UG_FET = mysqli_fetch_assoc($UG_RES)) {
									$userid = $UG_FET['user_id'];
									$A_SQL = "SELECT * FROM akun WHERE user_id='$userid';";
									$A_RES = mysqli_query($connection, $A_SQL);
									$A_FET = mysqli_fetch_assoc($A_RES);

									$id = intToStr($A_FET['user_id']);
									$nama = $A_FET['user_namalengkap'];
									$firstnama = explode(" ", $nama)[0];
									echo '
									<tr>
										<td>
										<a data-toggle="collapse" href="#'.$id.'" role="button" aria-expanded="false" aria-controls="'.$id.'">'.$nama.'</a>
										<div class="collapse" id="'.$id.'">
										  <div class="card-body">
										  	<div class="row">
												<table class="table table-borderless table-striped table-hover table-sm">
													<thead class="bg-dark text-light">
														<tr>
															<th>TANGGAL</th>
															<th>STATUS</th>
															<th>ALASAN</th>
														</tr>
													</thead>
													<tbody>';
														if (isset($_SESSION['absent-data'])) {
															foreach ($_SESSION['absent-data'][$index]['tanggal'] as $key => $value) {
																echo '<tr>
																	<td class="absent-date">'.$key.'</td>';

																$valueArray = explode("~", $value);
																$identifier = $valueArray[0]; // YES or NO
																$type = $valueArray[1];
																if ($identifier == "N/A") {
																	echo '<td class="absent-status"><b class="text-danger">'.$identifier.'</b></td>';
																	echo '<td class="absent-status"><b class="text-danger">'.$type.'</b></td>';
																} else if ($identifier == "SPECIAL") {
																	echo '<td class="absent-status"><b class="text-warning">'.$identifier.'</b></td>';
																	echo '<td class="absent-status"><b class="text-warning">'.$type.'</b></td>';
																} else {
																	echo '<td class="absent-status"><b class="text-success">'.$identifier.'</b></td>';
																	echo '<td class="absent-status"><b class="text-success">'.$type.'</b></td>';
																}

																echo '</tr>';
															}

														} else {
															echo '<span class="text-danger">ERROR</span>: Anda belum memilih salah satu bulan';
														}

														if (isset($_SESSION['absent-data'])) {
															echo '
															<tr class="bg-success text-light text-center">
																<td colspan="2">MASUK</td>
																<td>'.$_SESSION['absent-data'][$index]['absented'].'</td>
															</tr>
															<tr class="bg-danger text-light text-center">
																<td colspan="2">N/A</td>
																<td>'.$_SESSION['absent-data'][$index]['not_absented'].'</td>
															</tr>
															<tr class="bg-warning text-light text-center">
																<td colspan="2">SPECIAL</td>
																<td>'.$_SESSION['absent-data'][$index]['special'].'</td>
															</tr>';
														}
													echo '</tbody>
												</table>
											</div>
										  <a data-toggle="collapse" href="#'.$id.'" role="button" aria-expanded="false" aria-controls="'.$id.'">TUTUP</a>
										  </div>
										</div>
										</td>
										<td>';
										if (isset($_SESSION['absent-data'])) {
											echo '<span class="badge badge-success badge-pill">'.$_SESSION['absent-data'][$index]['absented'].'</span> / <span class="badge badge-danger badge-pill">'.$_SESSION['absent-data'][$index]['not_absented'].'</span> / <span class="badge badge-warning badge-pill">'.$_SESSION['absent-data'][$index]['special'].'</span>';
										} else {
											echo "-";
										}
										echo '</td>
									</tr>
									';
									$index++;
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

<?php
	function intToStr($number)
	{
		$final = "";
		foreach (str_split($number) as $key => $value) {
			# CHECK EVERY CHARACTER
			switch (intval($value)) {
				case 0: $val="A"; break;
				case 1: $val="B"; break;
				case 2: $val="C"; break;
				case 3: $val="D"; break;
				case 4: $val="E"; break;
				case 5: $val="F"; break;
				case 6: $val="G"; break;
				case 7: $val="H"; break;
				case 8: $val="I"; break;
				case 9: $val="J"; break;
				default:
					$val="Q";
					break;
			}
			$final = $final.$val;
		}
		return $final;
	}

	function intToMonthNama($numberOfMonth, $isUpper)
	{	
		switch (intval($numberOfMonth)) {
			case 1: $month='januari'; break;
			case 2: $month='februari'; break;
			case 3: $month='maret'; break;
			case 4: $month='april'; break;
			case 5: $month='mei'; break;
			case 6: $month='juni'; break;
			case 7: $month='juli'; break;
			case 8: $month='agustus'; break;
			case 9: $month='september'; break;
			case 10: $month='oktober'; break;
			case 11: $month='november'; break;
			case 12: $month='desember'; break;
			
			default:
				$month='Month not valid';
				break;
		}
		if ($isUpper == true) {
			return strtoupper($month);
		} else {
			return $month;
		}
	}

?>