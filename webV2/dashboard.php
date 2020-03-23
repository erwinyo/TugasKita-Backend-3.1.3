<?php
	session_start();
	require 'connection.php';
  require 'cloudinary/cloudinary-connect.php';
  date_default_timezone_set('Asia/Jakarta');
  $info = getdate();
  $date = $info['mday'];
  $month = $info['mon'];
  $year = $info['year'];
  $hour = $info['hours'];
  $min = $info['minutes'];
  $sec = $info['seconds'];
  $today = formatDate($date."-".$month."-".$year);
	if (isset($_SESSION['userid'])) {
		loadUndangan($connection);
	} else {
		header("Location: error404/404-page-not-found");
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
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Dashboard | TugasKita</title>
    <style type="text/css">
    	h1 {
    		font-family: 'Asap', sans-serif;
    	}
    	label, form {
    		font-family: 'Nunito', sans-serif;
    	}
    	.showmore {
    		cursor: pointer;
    	}
    	.pform, .tugas-desc {
    		font-family: 'Nunito', sans-serif;
    	}
    </style>
</head>
<body>
	<div class="container"><br><br>
  		<h1 class="animated slideInLeft"><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_80/v1571068816/tugaskita/assets/ico.png"> TugasKita <small class="text-danger">job</small></h1><br>
  		<div class="row">
  			<div class="col-md-4 col-sm-12">
          <div class="row">
            <div class="col-6" data-aos="fade-up">
              <a href="sistem/logout"><button class="btn btn-danger btn-sm"><span class="fa fa-sign-out"></span> LOGOUT</button></a>
            </div>
            <div class="col-6 text-right" data-aos="fade-up">
              <span class="badge badge-light"><?php echo $_SESSION['userpoint'];?> <b class="text-primary">points</b></span>
            </div>
          </div><br>
  				<div class="card border-primary" data-aos="fade-up">
  					<div class="card-body">
  						<b><span class="fa fa-thumbs-o-up"></span> Hello, <?php echo $_SESSION['usernamalengkap'];?></b>
  					</div>
  				</div><br>
          <div class="card border-0" data-aos="fade-up">
            <div class="card-body bg-light">
              <h3 class="card-title"><i class="fa fa-vcard"></i> <b>TugasKita <small class="text-info"><b>absent</b></small></b></h3>
              <p class="card-text">Record all your attendance data</p>
              <a href="#qrcanreader-comingsoon"><button class="btn btn-info disabled">QR SCAN READER</button></a>
            </div>
            <div class="card-footer text-right bg-info text-light">
              In development (coming soon)
            </div>
          </div><br>
  				<div class="card border-primary" data-aos="fade-up">
  					<h3 class="card-header bg-primary text-light"><i class="fa fa-group animated tada infinite"></i> <b>GRUP</b></h3>
  					<div class="card-body">
  						<h6 class="card-title">Pilih satu untuk melihat tugas</h6>
  						<?php
  							$userid = $_SESSION['userid'];
  							$UG_SQL = "SELECT * FROM user_grup WHERE user_id='$userid';";
  							$UG_RES = mysqli_query($connection, $UG_SQL);
  							$UG_ROW = mysqli_num_rows($UG_RES);
  							if ($UG_ROW > 0) {
  								while ($UG_FET = mysqli_fetch_assoc($UG_RES)) {
	  								$grupid = $UG_FET['grup_id'];
	  								$G_SQL = "SELECT * FROM grup WHERE grup_id='$grupid';";
	  								$G_RES = mysqli_query($connection, $G_SQL);
	  								$G_FET = mysqli_fetch_assoc($G_RES);
	  								$grupnama = $G_FET['grup_nama'];

	  								echo '<form action="sistem/load_tugas" method="POST">
			  							<div class="form-group">
			  								<input type="hidden" name="grupid" value="'.$grupid.'">
			  							</div>
			  							<button type="submit" name="submit" class="btn btn-danger">'.$grupnama.'</button>
			  						</form>';
	  							}
  							} else {
  								echo "<p class='text-danger'>Anda tidak memiliki grup!</p>";
  							}
  						?>
  					</div>
  				</div><br>
  				<div class="card border-primary" data-aos="fade-up">
  					<h3 class="card-header bg-primary text-light"><i class="fa fa-inbox"></i> <b>KOTAK MASUK</b></h3>
  					<div class="card-body">
  						<?php
  							$data = $_SESSION['undangan'];
  							if (count($data['listofinvitation']) > 0) {
  								for($i=0;$i<count($data['listofinvitation']);$i++) {
                			$invite_from = $data['listofinvitation'][$i]['invite_from'];
                			$invite_from_id = $data['listofinvitation'][$i]['invite_from_id'];
                			$invite_to_grup = $data['listofinvitation'][$i]['invite_to_grup'];
                			$invite_to_grup_id = $data['listofinvitation'][$i]['invite_to_grup_id'];
                			$as_status = $data['listofinvitation'][$i]['as_status'];
                      echo $invite_from_id." : ".$invite_to_grup_id."<br>";
                			echo '<div class="card border-info">
  							<div class="card-body">
  								<p class="card-title"><b>'.$invite_from.'</b> mengundangan Anda ke grup <b>'.$invite_to_grup.'</b></p>
		  						<form action="sistem/accept_undangan" method="POST">
		  							<div class="form-group">
		  								<input type="hidden" name="grupid" value="'.$invite_to_grup_id.'">
		  								<input type="hidden" name="as_status" value="'.$as_status.'">
		  							</div>
		  							<button type="submit" name="submit" class="btn btn-success btn-sm">terima</button>
		  						</form>
		  						<form action="sistem/delete_undangan" method="POST">
		  							<div class="form-group">
		  								<input type="hidden" name="fromid" value="'.$invite_from_id.'">
		  								<input type="hidden" name="grupid" value="'.$invite_to_grup_id.'">
		  							</div>
		  							<button type="submit" name="submit" class="btn btn-danger btn-sm">tolak</button>
  								</form>
  							</div>
  						</div>';
                		}
  							} else {
  								echo "Tidak ada pesan masuk!";
  							}
  							
  						?><br>
  					</div>
  				</div><br>
          <?php
            if (isset($_SESSION['grup'])) {
              echo '<div class="card border-primary" data-aos="fade-up">
            <h3 class="card-header bg-primary text-light"><i class="fa fa-plus"></i> <b>TAMBAH</b></h3>
            <div class="card-body">
              <p class="card-title"><b>Menambahkan tugas baru:</b></p>
              <form action="sistem/register_tugas" method="POST">
                <div class="form-group">
                  <label>Nama Tugas <span class="text-danger">*</span></label>
                  <input type="text" name="tugasnama" class="form-control" placeholder="cth. Ulangan agama, Kliping ppkn" required>
                </div>
                <div class="form-group">
                  <label>Mata Pelajaran <span class="text-danger">*</span></label>
                  <select name="tugaspelajaran" class="form-control">
                    <option value="matematika_peminatan">Matematika Peminatan</option>
                    <option value="matematika_wajib">Matematika Wajib</option>
                    <option value="agama">Agama</option>
                    <option value="ppkn">PPKN</option>
                    <option value="seni_budaya">Seni Budaya</option>
                    <option value="penjaskes">Penjaskes</option>
                    <option value="fisika">Fisika</option>
                    <option value="kimia">Kimia</option>
                    <option value="biologi">Biologi</option>
                    <option value="geografi">Geografi</option>
                    <option value="sejarah">Sejarah</option>
                    <option value="sosiologi">Sosiologi</option>
                    <option value="mulok">Mulok</option>
                    <option value="wirausaha">Wirausaha</option>
                    <option value="bahasa_indonesia">Bahasa Indonesia</option>
                    <option value="bahasa_mandarin">Bahasa Mandarin</option>
                    <option value="bahasa_inggris">Bahasa Inggris</option>
                    <option value="komputer">Komputer</option>
                    <option value="lintas_minat">Lintas Minat</option>
                    <option value="lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Deadline <span class="text-danger">*</span></label>
                  <input type="date" name="tugaswaktu" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Keterangan <span class="text-danger">*</span></label>
                  <textarea class="form-control" name="tugascerita" rows="5" placeholder="Keterangan tambahan tentang tugas..."></textarea>
                </div>
                <div class="form-group">
                  <label>Prioritas <span class="text-danger">*</span></label><br>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="wajib" name="tugasprioritas" checked>WAJIB
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="tidak wajib" value="" name="tugasprioritas">TIDAK WAJIB
                    </label>
                  </div>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block" style="font-family: sans-serif;"><span class="fa fa-save"></span> <b>SAVE</b></button>
              </form>
            </div>
          </div>
          <br>';
            }
          ?>
  			</div>
  			<div class="col-md-8 col-sm-12">
  				<div class="card border-0" data-aos="fade-up">
  					<div class="card-body bg-light">
  						<h3 class="card-title text-success"><i class="fa fa-child animated bounce infinite slow"></i> <b>How it works?</b></h3>
  						<p class="card-text"><b>TugasKita</b> akan <b>mengingat</b> semua tugas Anda, dan Anda akan diberi <b>informasi</b> akan tugas-tugas besok dan yang akan datang sesuai dengan <b>penginputan data</b> yang diberikan. <b><u>To The Point. Flexible. Updated Every Second.</u></b></p>
  					</div>
            <div class="card-footer text-right text-light bg-success">
              TugasKita Indonesia
            </div>
  				</div><br>
  				<div class="card border-0" data-aos="fade-up">
  					<h3 class="card-header bg-primary text-light"><b>SEKARANG <small class="badge-danger badge-pill"><?php echo $today;?></small></b></h3>
  					<div class="card-body bg-light">
  						<?php
  							if (isset($_SESSION['tugas'])) {
  								if (count($_SESSION['tugas']['tugas_today']) > 0) {
  									for ($i=0; $i < count($_SESSION['tugas']['tugas_today']); $i++) { 
                      $id = $_SESSION['tugas']['tugas_today'][$i]['tugasid'];
                      $title = $_SESSION['tugas']['tugas_today'][$i]['tugaspelajaran'];
	  									$header = $_SESSION['tugas']['tugas_today'][$i]['tugasnama'];
	  									$subheader = $_SESSION['tugas']['tugas_today'][$i]['tugascerita'];
	  									echo '<div class="row">
				  							<div class="col-md-9 col-sm-8">
				  								<h5><b>'.$header.'</b> <small class="text-light badge-pill badge-primary">'.$title.'</small></h5>
				  								<p class="card-text tugas-desc">'.$subheader.'</p>
				  							</div>
                        <div class="col-md-3 col-sm-2">
                          <form action="edit-tugas" method="POST">
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-info"><span class="fa fa-edit"></span> edit</button>
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-danger"><span class="fa fa-trash"></span></button>
                          </form>
                        </div>
				  						</div>
				  						<br>';
	  								}
  								} else {
  									echo "<p>Tidak ada tugas!</p>";
  								}
  							} else {
  								echo "<p>Pilih salah satu grup untuk melihat tugas!</p>";
  							}
  						?>
  					</div>
  				</div><br>
  				<div class="card border-0" data-aos="fade-up">
  					<h3 class="card-header bg-primary text-light"><b>BESOK</b></h3>
  					<div class="card-body bg-light">
  						<?php
  							if (isset($_SESSION['tugas'])) {
  								if (count($_SESSION['tugas']['tugas_tommorow']) > 0) {
  									for ($i=0; $i < count($_SESSION['tugas']['tugas_tommorow']); $i++) {
                      $id = $_SESSION['tugas']['tugas_tommorow'][$i]['tugasid']; 
                      $title = $_SESSION['tugas']['tugas_tommorow'][$i]['tugaspelajaran']; 
	  									$header = $_SESSION['tugas']['tugas_tommorow'][$i]['tugasnama'];
	  									$subheader = $_SESSION['tugas']['tugas_tommorow'][$i]['tugascerita'];
	  									echo '<div class="row">
				  							<div class="col-md-9 col-sm-8">
				  								<h5><b>'.$header.'</b> <small class="text-light badge-pill badge-primary">'.$title.'</small></h5>
				  								<p class="card-text tugas-desc">'.$subheader.'</p>
				  							</div>
                        <div class="col-md-3 col-sm-2">
                          <form action="edit-tugas" method="POST">
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-info"><span class="fa fa-edit"></span> edit</button>
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-danger"><span class="fa fa-trash"></span></button>
                          </form>
                        </div>
				  						</div>
				  						<br>';
	  								}
  								} else {
  									echo "<p>Tidak ada tugas!</p>";
  								}
  							} else {
  								echo "<p>Pilih salah satu grup untuk melihat tugas!</p>";
  							}
  						?>
  					</div>
  				</div><br>
  				<div class="card border-0" data-aos="fade-up">
  					<h3 class="card-header bg-primary text-light"><b>LAINNYA</b></h3>
  					<div class="card-body bg-light">
  						<?php
  							if (isset($_SESSION['tugas'])) {
  								if (count($_SESSION['tugas']['tugas_others']) > 0) {
  									for ($i=0; $i < count($_SESSION['tugas']['tugas_others']); $i++) { 
	  									$id = $_SESSION['tugas']['tugas_others'][$i]['tugasid'];
                      $title = $_SESSION['tugas']['tugas_others'][$i]['tugaspelajaran'];
                      $header = $_SESSION['tugas']['tugas_others'][$i]['tugasnama'];
	  									$subheader = $_SESSION['tugas']['tugas_others'][$i]['tugascerita'];
                      $subsubheader = $_SESSION['tugas']['tugas_others'][$i]['tugaswaktu_harilagi'];
	  									echo '<div class="row">
				  							<div class="col-md-9 col-sm-8">
				  								<h5><b>'.$header.'</b> <small class="text-light badge-pill badge-primary">'.$title.'</small></h5>
				  								<p class="card-text">'.$subheader.'</p>
				  							</div>
                        <div class="col-md-3 col-sm-4">
                          <b class="text-danger">'.$subsubheader.'</b><br>
                          <form action="edit-tugas" method="POST">
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-info"><span class="fa fa-edit"></span> edit</button>
                            <button type="submit" name="tugasid" value="'.$id.'" class="btn-danger"><span class="fa fa-trash"></span></button>
                          </form>
                        </div>
				  						</div>
				  						<br>';
	  								}
  								} else {
  									echo "<p>Tidak ada tugas!</p>";
  								}
  							} else {
  								echo "<p>Pilih salah satu grup untuk melihat tugas!</p>";
  							}
  						?>
  					</div>
  				</div><br>
          <div class="card border-primary" data-aos="fade-up">
            <h3 class="card-header bg-primary text-light"><span class="fa fa-user-plus"></span> <b>TAMBAH TEMAN</b></h3>
            <div class="card-body">
              <p class="card-title"><b>Ketik username teman untuk mencarinya</b></p>
              <form action="sistem/search_user" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-9 col-sm-9">
                    <input type="text" name="username" class="form-control" required>
                  </div>
                  <div class="form-group col-md-3 col-sm-3">
                    <button class="btn btn-primary" type="submit" name="submit"><span class="fa fa-search"></span> SEARCH</button>
                  </div>
                </div>
              </form><br>
              <?php
                if (isset($_SESSION['search_teman_val'])) {
                  $search = $_SESSION['search_teman_val'];
                  $success = $search['success']; 
                  $message = $search['message']; 
                  if ($success == "1") {
                    $id = $search['id'];
                    $namalengkap = $search['namalengkap'];
                    $username = $search['username'];
                    $avatar = $search['avatar'];
                    echo '<p><b>USER FOUNDED!</b></p>
                      '.cl_image_tag("tugaskita/profile/".$avatar.".jpg", array("width"=>100, "crop"=>"scale", "radius"=>100)).' &nbsp&nbsp&nbsp<b>'.$namalengkap.'</b><br><br>
                      <form action="sistem/register_teman" method="POST">
                      <input type="hidden" name="temanusername" value="'.$username.'">  
                      <button class="btn btn-success btn-sm" type="submit" name="submit"><span class="fa fa-plus"></span> Tambah Pertemanan</button>
                      </form>';
                  } else {
                    echo '<p><b>'.strtoupper($message).'!</b></p>';
                  }
                }
              
                if (isset($_SESSION['search_teman_status'])) {
                  $status = $_SESSION['search_teman_status']['message'];
                  echo "<br><span class='text-danger'><b>STATUS : </b></span> <b>".$status."</b>";
                }
              ?>             
            </div>
          </div><br>
  				<div class="card border-0" data-aos="fade-up">
  					<h3 class="card-header bg-success text-light"><i class="fa fa-android"></i> <b>Android App</b></h3>
  					<div class="card-body bg-light">
  						<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/v1571243816/tugaskita/assets/playstore.png" width="300" class="img-fluid"><br><br>
  						<p class="card-text pform">TugasKita sudah tersedia di Google Play Store <a href="https://play.google.com/store/apps/details?id=com.management.tugaskita30" target="_blank">DOWNLOAD SEKARANG</a></p>
  					</div>
            <div class="card-footer text-right bg-success text-light">
              TugasKita Indonesia
            </div>
  				</div><br><br>
  			</div>
  		</div><br>
  		<p class="text-center"><b>saran & kritik</b> : tugaskitaindonesia@gmail.com</p>
  		<p class="text-center"><i class="fa fa-lock"></i> Secured by <b>TugasKita Indonesia</b></p>
	</div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>

<?php
	function loadUndangan($connection) {
		$userid = $_SESSION['userid'];
		$SQL = "SELECT * FROM invite_grup WHERE invite_to='$userid';";
		$RES = mysqli_query($connection, $SQL);
		$list = array();
		$list['listofinvitation'] = array();
		if ($RES) {
			while ($FET = mysqli_fetch_assoc($RES)) {
				$getInviteFrom = $FET['invite_from'];
				$akunSQL = "SELECT * FROM akun WHERE user_id='$getInviteFrom';";
				$akunRES = mysqli_query($connection, $akunSQL);
				$akunFET = mysqli_fetch_assoc($akunRES);

				$getInviteToGrup = $FET['invite_to_grup'];
				$grupSQL = "SELECT * FROM grup WHERE grup_id='$getInviteToGrup';";
				$grupRES = mysqli_query($connection, $grupSQL);
				$grupFET = mysqli_fetch_assoc($grupRES);

				$ind['invite_from'] = $akunFET['user_namalengkap'];
				$ind['invite_from_id'] = $akunFET['user_id'];
				$ind['invite_to_grup'] = $grupFET['grup_nama'];
				$ind['invite_to_grup_id'] = $grupFET['grup_id'];
				$ind['as_status'] = $FET['as_status'];
				array_push($list['listofinvitation'], $ind);
			}
			$list['success'] = "1";
			$list['message'] = "Successfully loaded";
			
			$_SESSION['undangan'] = $list;
		} else {
			echo "Error SQL Command!";
			mysqli_close($connection);
			exit();
		}
	}

  function formatDate($date) {
    $dateArray = explode("-", $date);
    $day = $dateArray[0];
    $month = $dateArray[1];
    $year = $dateArray[2];
  
    switch ($month) {
      case '1':$month = "JAN";break;
      case '2':$month = "FEB";break;
      case '3':$month = "MAR";break;
      case '4':$month = "APR";break;
      case '5':$month = "MEI";break;
      case '6':$month = "JUNI";break;
      case '7':$month = "JULI";break;
      case '8':$month = "AGT";break;
      case '9':$month = "SEPT";break;
      case '10':$month = "OKT";break;
      case '11':$month = "NOV";break;
      case '12':$month = "DES";break;
    }
    return $day." ".$month." ".$year;
  }
?>