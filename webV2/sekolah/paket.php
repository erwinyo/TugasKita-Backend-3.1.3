<?php
	session_start();
	require '../connection.php';

	// Standart Check Login Session
	if (isset($_SESSION['sekolah_id'])) {
		$sekolah_id = $_SESSION['sekolah_id'];
	} else {
		header("Location: ../cbt-sekolah");
	}

	$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id';";
	$P_RES = mysqli_query($connection, $P_SQL);
	$P_ROW = mysqli_num_rows($P_RES);
?>
<html lang="en">
  <head>
  	<link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/ico.png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- AOS (Animated Scroll Bar) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <title>PAKET</title>
    <style type="text/css">
    	.font-asap {
    		font-family: 'Asap', sans-serif;
    	}
	    .bd-placeholder-img {
	      font-size: 1.125rem;
	      text-anchor: middle;
	      -webkit-user-select: none;
	      -moz-user-select: none;
	      -ms-user-select: none;
	      user-select: none;
	    }
        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }

        .scrollBar {
			height: 300px;
			overflow-y: scroll;
		}

		.scrollBarLong {
			height: 50em;
			overflow-y: scroll;
		}
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
	<nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 shadow">
	  <span class="navbar-brand col-sm-3 col-md-2 mr-0 bg-light"><span class="h4">TugasKita</span></span>
	  <ul class="navbar-nav px-3">
	    <li class="nav-item text-nowrap">
	      <a class="nav-link" href="../sistem/logout?type=sekolah">Sign out</a>
	    </li>
	  </ul>
	</nav>

	<div class="container-fluid">
	  <div class="row">
	    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
	      <div class="sidebar-sticky">
	        <ul class="nav flex-column">
	          <li class="nav-item">
	            <a class="nav-link" href="home">
	              <span class="fa fa-home"></span>
	              HOME <span class="sr-only">(current)</span>
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link active" href="paket">
	              <span class="fa fa-database"></span>
	              PAKET
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="komentar">
	              <span class="fa fa-commenting"></span>
	              KOMENTAR
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="nilai">
	              <span class="fa fa-circle-o-notch"></span>
	              NILAI
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="../sistem/logout?type=sekolah">
	              <span class="fa fa-sign-out"></span>
	              SIGNOUT
	            </a>
	          </li>
	        </ul>
	        <div class="mt-5 ml-3 mr-3">
	        	<b>Customer Feedback:</b><br>
	        	tugaskitaindonesia@gmail.com
	        </div>
	      </div>
	    </nav>

	    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mb-5">
	    	<div class="mt-4">
	    		<div class="row">
	    			<div class="col-md-8">
	    				<h3><?php if(isset($P_ROW)){echo $P_ROW;}else{echo "~";}?> Paket Ditemukan</h3>
	    				<small>DAFTAR PAKET SOAL SEKOLAH SMAK STELLA MARIS SURABAYA</small>
	    			</div>
	    			<div class="col-md-4 text-right">
	    				<button class="btn btn-lg- btn-outline-success mr-5" data-toggle="modal" data-target="#tambahBaruModal"><span class="fa fa-plus"></span> TAMBAH BARU</button>
	    			</div>
	    		</div>
	    		<div class="mt-5">
	    			<h6 class="mb-0 text-success">&#8226; PAKET AKTIF</h6><hr>
	    			<div class="row">
	    				<div class="col-md-6">
	    					<div class="list-group scrollBar pr-3" id="list-tab" role="tablist">
							  	<?php
					        		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND aktif='1';";
					        		$P_RES = mysqli_query($connection, $P_SQL);
					        		$P_ROW = mysqli_num_rows($P_RES);
					        		if ($P_ROW > 0) {
					        			while ($P_FET = mysqli_fetch_assoc($P_RES)) {
					        				$P_PAKETID = $P_FET['id'];
					        				$P_PAKETNAMA = $P_FET['nama'];
					        				$P_PAKETBUTIR = $P_FET['butir'];
					        				$P_PAKETKUNCI = $P_FET['kunci'];
					        				if ($P_PAKETKUNCI != "") {
					        					$isThereKey = "1";
					        					$icon = "fa fa-check-circle";
					        					$tooltip = "ONLINE & READY";
					        				} else {
					        					$isThereKey = "0";
					        					$icon = "fa fa-circle";
					        					$tooltip = "ONLINE";
					        				}

					        				$S_SQL = "SELECT * FROM soal WHERE paket='$P_PAKETID'";
					        				$S_RES = mysqli_query($connection, $S_SQL);
					        				$S_ROW = mysqli_num_rows($S_RES);

					        				echo '
					        				<a class="list-group-item list-group-item-action published" id="publish-'.$P_PAKETID.'-list" data-toggle="list" open-public="'.$isThereKey.'" href="#publish-'.$P_PAKETID.'" role="tab" aria-controls="publish-'.$P_PAKETID.'">
						        				<div class="row">
						        					<div class="col-11"><span class="'.$icon.' mr-3 text-success" data-toggle="tooltip" title="'.$tooltip.'"></span>'.$P_PAKETNAMA.'</div>
						        				</div>
					        				</a>';
					        			}
					        		} else {
					        			echo "<p>Paket Aktif belum tersedia!</p>";
					        		}
					        	?>
							</div>
		    				<div class="mt-5">
		    					<h6 class="mb-0 text-danger">&#8226; PAKET TIDAK AKTIF</h6><hr>
		    					<div class="list-group scrollBar pr-3" id="list-tab" role="tablist">
		    						<?php
						        		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND aktif='0';";
						        		$P_RES = mysqli_query($connection, $P_SQL);
						        		$P_ROW = mysqli_num_rows($P_RES);
						        		if ($P_ROW > 0) {
						        			while ($P_FET = mysqli_fetch_assoc($P_RES)) {
						        				$P_PAKETID = $P_FET['id'];
						        				$P_PAKETNAMA = $P_FET['nama'];
						        				$P_PAKETBUTIR = $P_FET['butir'];
						        				$P_PAKETKUNCI = $P_FET['kunci'];
						        				if ($P_PAKETKUNCI != "") {
						        					$isThereKey = "1";
						        					$icon = "fa fa-check-circle";
					        						$tooltip = "OFFLINE & READY";
						        				} else {
						        					$isThereKey = "0";
						        					$icon = "fa fa-circle";
					        						$tooltip = "OFFLINE";
						        				}

						        				$S_SQL = "SELECT * FROM soal WHERE paket='$P_PAKETID'";
						        				$S_RES = mysqli_query($connection, $S_SQL);
						        				$S_ROW = mysqli_num_rows($S_RES);

						        				echo '
						        				<a class="list-group-item list-group-item-action unpublished" id="unpublish-'.$P_PAKETID.'-list" data-toggle="list" open-public="'.$isThereKey.'" href="#unpublish-'.$P_PAKETID.'" role="tab" aria-controls="unpublish-'.$P_PAKETID.'">
							        				<div class="row">
							        					<div class="col-11"><span class="'.$icon.' mr-3 text-danger" data-toggle="tooltip" title="'.$tooltip.'"></span>'.$P_PAKETNAMA.'</div>
							        				</div>
						        				</a>';
						        			}
						        		} else {
						        			echo "<p>Paket Tidak Aktif belum tersedia!</p>";
						        		}
						        	?>
								</div>
		    				</div>
	    				</div> 
	    				<div class="col-md-6 scrollBarLong tab-content" id="nav-tabContent">
	    					<?php
				        		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND aktif='1';";
				        		$P_RES = mysqli_query($connection, $P_SQL);
				        		$P_ROW = mysqli_num_rows($P_RES);
				        		if ($P_ROW > 0) {
				        			while ($P_FET = mysqli_fetch_assoc($P_RES)) {
				        				$P_PAKETID = $P_FET['id'];
				        				$P_PAKETNAMA = $P_FET['nama'];
				        				$P_PAKETBUTIR = $P_FET['butir'];
				        				$P_PAKETPILGAN = $P_FET['pilihan_ganda'];
				        				$P_PAKETURAIAN = $P_FET['uraian'];
				        				$P_PAKETWAKTU = $P_FET['waktu'];
				        				$P_PAKETSOAL = $P_FET['soal'];
				        				$P_PAKETKUNCI = $P_FET['kunci'];
				        				if ($P_PAKETKUNCI != "") {
				        					$P_PAKETKUNCI_ICON = "fa fa-check-circle";
				        					$P_PAKETKUNCI_TEXT = "ONLINE & SIAP DIGUNAKAN";
				        				} else {
				        					$P_PAKETKUNCI_ICON = "fa fa-circle";
				        					$P_PAKETKUNCI_TEXT = "ONLINE";
				        				}

				        				$S_SQL = "SELECT * FROM soal WHERE paket='$P_PAKETID'";
				        				$S_RES = mysqli_query($connection, $S_SQL);
				        				$S_ROW = mysqli_num_rows($S_RES);

				        				echo '<div class="tab-pane fade" id="publish-'.$P_PAKETID.'" role="tabpanel" aria-labelledby="publish-'.$P_PAKETID.'-list">
				    						<center>
												<h1 class="display-2 text-warning"><b><span id="rate-value-'.$P_PAKETID.'">0.0</span></b></h1>
												<small><span class="fa fa-info-circle"></span> RATING PAKET SOAL BERDASARKAN DATA NYATA</small><br>
												<div class="mt-3">
													<button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#analisisModal"><span class="fa fa-bar-chart-o"></span> ANALISIS</button>
													<a href="komentar?paket='.$P_PAKETID.'"><button type="button" class="btn btn-outline-primary mb-1"><span class="fa fa-commenting"></span> KOMENTAR</button></a>
													<a href="nilai?paket='.$P_PAKETID.'"><button type="button" class="btn btn-outline-primary mb-1"><span class="fa fa-circle-o-notch"></span> NILAI</button></a>
													<button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#editModal"><span class="fa fa-pencil"></span> EDIT</button>
													<button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#pengaturanModal"><span class="fa fa-gear"></span> PENGATURAN</button>
												</div>
											</center>
											<div class="row mt-5">
												<div class="col-4">
													NAMA PAKET:
												</div>
												<div class="col-8">
													'.$P_PAKETNAMA.'
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													BUTIR:
												</div>
												<div class="col-8">
													'.$P_PAKETBUTIR.' SOAL
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													PILIHAN GANDA:
												</div>
												<div class="col-8">
													'.$P_PAKETPILGAN.'
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													URAIAN:
												</div>
												<div class="col-8">
													'.$P_PAKETURAIAN.'
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													WAKTU:
												</div>
												<div class="col-8">
													'.$P_PAKETWAKTU.' MENIT
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													ENTRY TOKEN:
												</div>
												<div class="col-8">
													<h5><span class="badge badge-primary">'.$P_PAKETID.'</span></h5>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													STATUS:
												</div>
												<div class="col-8">
													<span class="animated flash slower infinite '.$P_PAKETKUNCI_ICON.' text-success"> <b>'.$P_PAKETKUNCI_TEXT.'</b></span>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													SOAL ID:
												</div>
												<div class="col-8">';
													foreach (explode(",", $P_PAKETSOAL) as $key => $value) {
														echo $value."<br>";
													}	
												echo '</div>
											</div>
				    					</div>';
				        			}
				        		}

				        		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND aktif='0';";
				        		$P_RES = mysqli_query($connection, $P_SQL);
				        		$P_ROW = mysqli_num_rows($P_RES);
				        		if ($P_ROW > 0) {
				        			while ($P_FET = mysqli_fetch_assoc($P_RES)) {
				        				$P_PAKETID = $P_FET['id'];
				        				$P_PAKETNAMA = $P_FET['nama'];
				        				$P_PAKETBUTIR = $P_FET['butir'];
				        				$P_PAKETPILGAN = $P_FET['pilihan_ganda'];
				        				$P_PAKETURAIAN = $P_FET['uraian'];
				        				$P_PAKETWAKTU = $P_FET['waktu'];
				        				$P_PAKETSOAL = $P_FET['soal'];
				        				$P_PAKETKUNCI = $P_FET['kunci'];
				        				if ($P_PAKETKUNCI != "") {
				        					$P_PAKETKUNCI_ICON = "fa fa-check-circle";
				        					$P_PAKETKUNCI_TEXT = "OFFLINE & SIAP DIGUNAKAN";
				        				} else {
				        					$P_PAKETKUNCI_ICON = "fa fa-circle";
				        					$P_PAKETKUNCI_TEXT = "OFFLINE";
				        				}

				        				$S_SQL = "SELECT * FROM soal WHERE paket='$P_PAKETID'";
				        				$S_RES = mysqli_query($connection, $S_SQL);
				        				$S_ROW = mysqli_num_rows($S_RES);

				        				echo '<div class="tab-pane fade" id="unpublish-'.$P_PAKETID.'" role="tabpanel" aria-labelledby="unpublish-'.$P_PAKETID.'-list">
				    						<center>
												<h1 class="display-2 text-warning"><b><span id="rate-value-'.$P_PAKETID.'">0.0</span></b></h1>
												<small><span class="fa fa-info-circle"></span> RATING PAKET SOAL BERDASARKAN DATA NYATA</small><br>
												<div class="mt-3">
													<button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#editModal"><span class="fa fa-pencil"></span> EDIT</button>
													<button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#pengaturanModal"><span class="fa fa-gear"></span> PENGATURAN</button>
												</div>
											</center>
											<div class="row mt-5">
												<div class="col-4">
													NAMA PAKET:
												</div>
												<div class="col-8">
													'.$P_PAKETNAMA.'
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													BUTIR:
												</div>
												<div class="col-8">
													'.$P_PAKETBUTIR.' SOAL
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													PILIHAN GANDA:
												</div>
												<div class="col-8">
													'.$P_PAKETPILGAN.'
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													URAIAN:
												</div>
												<div class="col-8">
													'.$P_PAKETURAIAN.'
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													WAKTU:
												</div>
												<div class="col-8">
													'.$P_PAKETWAKTU.' MENIT
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													ENTRY TOKEN:
												</div>
												<div class="col-8">
													<h5><span class="badge badge-primary">'.$P_PAKETID.'</span></h5>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													STATUS:
												</div>
												<div class="col-8">
													<span class="animated flash slower infinite '.$P_PAKETKUNCI_ICON.' text-danger"> <b>'.$P_PAKETKUNCI_TEXT.'</b></span>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4">
													SOAL ID:
												</div>
												<div class="col-8">';
													foreach (explode(",", $P_PAKETSOAL) as $key => $value) {
														echo $value."<br>";
													}	
												echo '</div>
											</div>
				    					</div>';
				        			}
				        		}
				        	?>
						</div>
	    			</div>
	    		</div>
	    	</div>
	    </main>
	  </div>
    </div>

    <!-- TAMBAH BARU - Modal -->
	<div class="modal fade" id="tambahBaruModal" tabindex="-1"  role="dialog" aria-labelledby="tambahBaruModalTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="tambahBaruModalTitle"><span class="fa fa-plus"></span> TAMBAH PAKET BARU</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	        
			<div class="form-group">
				<label>Nama Paket</label>
				<input type="text" name="paket" class="form-control" id="paket">
			</div>
			<div class="form-group">
				<div class="form-row">
			    	<div class="col-6">
			    		<label>Pengerjaan (menit)</label>
			      		<input type="number" class="form-control" id="pengerjaan">
			    	</div>
			    	<div class="col">
			    		<label>Pilgan</label>
			      		<input type="number" class="form-control" id="pilgan">
			    	</div>
			    	<div class="col">
			    		<label>Uraian</label>
			      		<input type="number" class="form-control" id="uraian">
			    	</div>
			  	</div>
			</div>
			<div class="form-group">
				<?php
					$key = bin2hex(openssl_random_pseudo_bytes(16));
					$_SESSION['key'] = $key;
				?>
				<label>Kata Kunci (generasi otomatis)</label>
				<input type="text" name="key" class="form-control" value="<?php echo $key;?>" readonly>
				<small class="ml-1 text-danger">Mohon kata kunci untuk disimpan pribadi (notepad), kata kunci tidak akan kami simpan</small>
			</div>
	  		<div class="text-right">
	  			<div class="progress" style="height: 20px;" id="progress">
				  <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Mohon Tunggu Sebentar</div>
				</div>
	  			<button class="btn btn-primary mt-2" type="submit" name="submit" id="submit"><span class="fa fa-plus"></span> Buat Paket Baru</button>
	  		</div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- ANALISIS - Modal -->
	<div class="modal fade bd-example-modal-lg" id="analisisModal" tabindex="-1"  role="dialog" aria-labelledby="analisisModalTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="analisisModalTitle"><span class="fa fa-bar-chart-o"></span> ANALISIS</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	      	<canvas class="mt-2" id="myChart"></canvas>
	      	<div class="mt-3">
	      		<p><b>NB:</b> Paket Soal harus dalam status <b class="text-success">ONLINE & SIAP DIGUNAKAN</b> untuk bisa melihat data analisis</p>
	      	</div>
		  	<span class="spinner-grow spinner-grow-sm text-danger mt-4" role="status"></span> <span class="text-danger">PENGAMBILAN DATA SEDANG BERLANGSUNG...</span>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- EDIT - Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	        <div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="analisisModalTitle"><span class="fa fa-pencil"></span> EDIT</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	      	<div class="mt-2 pl-3 pr-3">
	  			<div class="form-group">
	  				<div class="form-row">
	      				<label>Masukan Kata Kunci</label>
	      				<input type="text" name="key" class="form-control" id="key-form" autocomplete="off" required>
	  				</div>
	  			</div>
	  			<div class="text-right">
	  				<a id="kata-kunci-submit"><button class="btn btn-primary">SUBMIT</button></a>
	  			</div>
	  		</div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- PENGATURAN - Modal -->
	<div class="modal fade" id="pengaturanModal" tabindex="-1" role="dialog" aria-labelledby="pengaturanModalTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	        <div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="pengaturanModalTitle"><span class="fa fa-gear"></span> PENGATURAN</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	      	<div class="mt-2 pl-2 pr-2">
	      		<legend><span class="fa fa-send text-primary"></span> <b class="text-primary">PUBLIKASI</b></legend>
	      		Paket Anda membutuhkan <b class="text-primary">ijin publikasi</b> agar bisa di akses oleh murid-murid Anda.
	      	</div>
	      	<div class="mt-2 pl-3 pr-3" id="pengaturan-publikasi-layout">
	      		<form action="../sistem/buka_publikasi_paket" method="POST" id="publikasi-form">
	      			<div class="form-group">
		  				<div class="form-row">
		      				<label>Masukan Kata Kunci</label>
		      				<input type="hidden" name="paket" class="paket-pengaturan" value="">
		      				<input type="hidden" name="sekolah" value="<?php echo $sekolah_id;?>">
		      				<input type="hidden" name="type" class="type-pengaturan" value="1/0">
		      				<input type="text" name="key" class="form-control" id="key-form-pengaturan" autocomplete="off" required>
		  				</div>
		  			</div>
		  			<div class="text-right">
		  				<a href="javascript:{}" onclick="document.getElementById('publikasi-form').submit();"><b class="text-primary">Mulai Publikasi <span class="fa fa-arrow-right"></span></b></a>
		  			</div>
	      		</form>
	  		</div>
	  		<div class="mt-4 pl-2 pr-2" id="pengaturan-hentikan-publikasi-layout">
	  			<p><span class="fa fa-check-circle text-success"></span> <b>Paket sudah Publik</b></p>
	  			<div class="text-right">
	  				<form action="../sistem/buka_publikasi_paket" method="POST" id="hentikan-publikasi-form">
	  					<input type="hidden" name="paket" class="paket-pengaturan" value="">
	      				<input type="hidden" name="sekolah" value="<?php echo $sekolah_id;?>">
	      				<input type="hidden" name="type" class="type-pengaturan" value="1/0">
	  					<a href="javascript:{}" onclick="document.getElementById('hentikan-publikasi-form').submit();"><b class="text-primary"><span class="fa fa-ban"></span> Hentikan Publikasi</b></a>
	  				</form>
	  			</div>
	  		</div>
	  		<div class="pl-2 pr-2">
	  			<a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" data-dismiss="modal" aria-label="Close"><b class="text-danger"><span class="fa fa-close"></span> Hapus Paket</b></a>
	  		</div>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- PENGATURAN VERIFICATION - Modal -->
	<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="pengaturanVerificationModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-8">
	      			<h5 class="modal-title" id="pengaturanModalTitle"><span class="fa fa-gear"></span> PENGATURAN</h5>
	      		</div>
	      		<div class="col-4">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
	      		</div>
	      	</div>
	      	<div class="mt-2 pl-2 pr-2">
	      		<p>Semua data yang berdasarkan <b>ID paket</b> akan terhapus dan tidak bisa di kembalikan lagi. Apa Anda yakin?</p>
	      		<form action="../sistem/delete_paket" method="GET" id="hapus-paket-form">
	  				<input type="hidden" name="paket" class="paket-pengaturan" value="">
	      			<input type="hidden" name="sekolah" value="<?php echo $sekolah_id;?>">
	      			<div class="text-right">
	      				<a href="javascript:{}" onclick="document.getElementById('hapus-paket-form').submit();"><b class="text-success">YA</b></a><br>
	      				<a href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#pengaturanModal"><b class="text-danger">TIDAK</b></a>
	      			</div>
	  			</form>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- TAMBAH PAKET BARU -->
    <script type="text/javascript">
  		$("#progress").hide();
  		$("#submit").click(function(event) {
  			var paket = $("#paket").val();
  			var pengerjaan = $("#pengerjaan").val();
  			var pilgan = $("#pilgan").val();
  			var uraian = $("#uraian").val();

  			if (paket!="" && pengerjaan!="" && pilgan!="" && uraian!="") {
  				$("#progress").show();
  				$("#submit").hide();
  				$.post("../sistem/register_paket.php", 
  					{
  						nama: paket, 
  						sekolah: "<?php echo $sekolah_id;?>",
  						pilgan: pilgan,
  						uraian: uraian,
  						waktu: pengerjaan
  					}, 
  					function(data, status) {
  					/*optional stuff to do after success */
  					if (data == "1") {
  						// Simulate an HTTP redirect:
						  window.location.replace("../cbt-upload-soal");
  					} else {
  						alert(data);
  						$("#progress").hide();
  						$("#submit").show();
  					}
  				});
  			} else {
  				alert("Data belum lengkap!");
  			}
  		});
  	</script>
  	<!-- ANALISIS -->
  	<!-- Chart.js -->
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
  	<script type="text/javascript">

  		var i = "";
  		var first = false;
  		$(".published").click(function(event) {
  			op = $(this).attr('open-public');
  			i = $(this).attr('id').split("-")[1];
  			// Cek hanya sekali jalan
  			if (first == false) {loadData(i);}
  			first = true;

  			// ganti attribute 'paket' di kata kunci setiap kali list di klik
  			$("#kata-kunci-submit").attr('paket', i);
			// ganti attribute 'value' di kata kunci setiap kali list di klik
  			$(".paket-pengaturan").attr('value', i);
  			$(".type-pengaturan").attr('value', op);
  			// sembunyikan layout pengaturan
  			if (op == "1") {
  				$("#pengaturan-publikasi-layout").hide();
  				$("#pengaturan-hentikan-publikasi-layout").show();
  			} else if(op == "0") {
  				$("#pengaturan-publikasi-layout").show();
  				$("#pengaturan-hentikan-publikasi-layout").hide();
  			}
  		});

  		$(".unpublished").click(function(event) {
  			op = $(this).attr('open-public');
  			i = $(this).attr('id').split("-")[1];
  			// Cek hanya sekali jalan
  			if (first == false) {loadData(i);}
  			first = true;

  			// ganti attribute 'paket' di kata kunci setiap kali list di klik
  			$("#kata-kunci-submit").attr('paket', i);
  			// ganti attribute 'value' di kata kunci setiap kali list di klik
  			$(".paket-pengaturan").attr('value', i);
  			$(".type-pengaturan").attr('value', op);
  			// sembunyikan layout pengaturan
  			if (op == "1") {
  				$("#pengaturan-publikasi-layout").hide();
  				$("#pengaturan-hentikan-publikasi-layout").show();
  			} else if(op == "0") {
  				$("#pengaturan-publikasi-layout").show();
  				$("#pengaturan-hentikan-publikasi-layout").hide();
  			}
  		});

  		$("#kata-kunci-submit").click(function(event) {
  			var key = $("#key-form").val();
  			var paket = $(this).attr('paket');
  			window.location.replace("../sistem/load_paket_upload?paket="+paket+"&sekolah="+"<?php echo $sekolah_id;?>"+"&key="+key);
  		});

  		function addData(chart, label, data) {
		    chart.data.labels.push(label);
		    chart.data.datasets.forEach((dataset) => {
		        dataset.data.push(data);
		    });
		    chart.update();
		}
		function removeData(chart) {
		    chart.data.labels.pop();
		    chart.data.datasets.forEach((dataset) => {
		        dataset.data.pop();
		    });
		    chart.update();
		}
  		var ctx = document.getElementById('myChart').getContext('2d');
  		var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: "",
					        datasets: [{
					            label: 'Prosentase Kesulitan Soal',
					            data: "",
					            backgroundColor: "#159F8A",
					        }]
					    },
					    options: {
					        scales: {
					            yAxes: [{
					                ticks: {
					                    beginAtZero: true
					                }
					            }]
					        }
					    }
					});
  		function sleep(ms) {
		  return new Promise(resolve => setTimeout(resolve, ms));
		}
		async function demo(paket) {
			await sleep(2000);
			if (paket == i) {
		    	loadData(paket);
			} else {
				loadData(i);
			}
		}	
		function loadData(paket) {
			console.log("LOADED DATA : "+paket);
			$.post('../sistem/load_statistik', 
			{
				paket: paket,
				sekolah: "<?php echo $sekolah_id;?>"
			}, function(data, textStatus, xhr) {
	  			var parsed = JSON.parse(data);
	  			if (parsed['success'] == "1") {
	  				for(var a = 0; a < 100; a++){
	  					removeData(myChart);
	  				}
	  				
	  				var soalid = [];
	  				var soalnama = [];
	  				var time_spend = [];
	  				var background = [];
	  				var border = [];
	  				for(var i = 0; i < parsed['data'].length; i++){
	  					var parsedArray = parsed['data'][i].split("~");
	  					soalid.push(parsedArray[0]);
	  					soalnama.push(parsedArray[1]);
	  					time_spend.push(parsedArray[2]);
	  					$("#rate-value-"+paket).text(parseInt(parsedArray[3]).toFixed(1));
	  					// console.log(parseInt(parsedArray[3]).toFixed(1));

	  					addData(myChart, parsedArray[1].slice(0,20), parsedArray[2]);
	  				}
	  				demo(paket);
				} else {
					alert(parsed['message']);
					console.log(parsed);
				}
			}); 
		}
  	</script>
  	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  	<script>
		AOS.init();
	</script>
  </body>
</html>