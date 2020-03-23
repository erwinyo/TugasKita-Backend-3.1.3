<?php
	session_start();
  	require 'connection.php';
  	if (isset($_POST['tugasid'])) {
  		$tugasid = mysqli_real_escape_string($connection, $_POST['tugasid']);
	  	$T_SQL = "SELECT * FROM tugas WHERE tugas_id='$tugasid';";
	  	$T_RES = mysqli_query($connection, $T_SQL);
	  	$T_FET = mysqli_fetch_assoc($T_RES);

	  	$tugasid = $T_FET['tugas_id'];
	  	$tugasnama = $T_FET['tugas_nama'];
	  	$tugaspelajaran = $T_FET['tugas_pelajaran'];
	  	$tugasdibuat = $T_FET['tugas_dibuat'];
	  	$tugaswaktu = $T_FET['tugas_waktu'];
	  	$tugasprioritas = $T_FET['tugas_prioritas'];
	  	$tugasauthorid = $T_FET['tugas_author_id'];
	  	$tugasposisi = $T_FET['tugas_posisi'];
	  	$tugascerita = $T_FET['tugas_cerita'];
	  	$tugaswaktuformatted = formatDeadline($tugaswaktu);
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
  	<title>Edit Tugas</title>
  	<link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<style type="text/css">
      	h1 {
        	font-family: 'Asap', sans-serif;
      	}
      	label, form {
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
	<div class="container"><br><br>
      	<h1><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png"> TugasKita <small class="text-danger">job</small></h1><br>
      	<div class="card">
	        <h2 class="card-header bg-primary text-light"><span class="fa fa-edit"></span> Edit Tugas</h2> 
	        <div class="card-body">
	          <form action="sistem/update_tugas" method="POST">
	          	<input type="hidden" name="tugasid" value="<?php echo $tugasid;?>">
	            <div class="row">
	                <div class="col-md-6 col-sm-12">
	                    <div class="form-group">
	                      <label>Judul <span class="text-danger">*</span></label>
	                      <input type="text" name="tugasnama" class="form-control" value="<?php echo $tugasnama;?>" required>
	                    </div>
	                    <div class="form-group">
	                      <label>Keterangan <span class="text-danger">(optional)</span></label>
	                      <textarea class="form-control" rows="9" name="tugascerita"><?php echo $tugascerita;?></textarea>
	                    </div>
	                </div>
	                <div class="col-md-6 col-sm-12">
	                    <div class="form-group">
	                      <label>Deadline <span class="text-danger">*</span></label>
	                      <input type="date" name="tugaswaktu" class="form-control" value="<?php echo $tugaswaktuformatted;?>" required>
	                    </div>
	                    <div class="form-group">
	                      <label>Mata Pelajaran <span class="text-danger">*</span></label>
	                      <select name="tugaspelajaran" class="form-control">
	                        <option value="matematika_peminatan" <?php if($tugaspelajaran=="matematika_peminatan"){echo "selected";}?>>Matematika Peminatan</option>
	                        <option value="matematika_wajib" <?php if($tugaspelajaran=="matematika_wajib"){echo "selected";}?>>Matematika Wajib</option>
	                        <option value="agama" <?php if($tugaspelajaran=="agama"){echo "selected";}?>>Agama</option>
	                        <option value="ppkn" <?php if($tugaspelajaran=="ppkn"){echo "selected";}?>>PPKN</option>
	                        <option value="seni_budaya" <?php if($tugaspelajaran=="seni_budaya"){echo "selected";}?>>Seni Budaya</option>
	                        <option value="penjaskes" <?php if($tugaspelajaran=="penjaskes"){echo "selected";}?>>Penjaskes</option>
	                        <option value="fisika" <?php if($tugaspelajaran=="fisika"){echo "selected";}?>>Fisika</option>
	                        <option value="kimia" <?php if($tugaspelajaran=="kimia"){echo "selected";}?>>Kimia</option>
	                        <option value="biologi" <?php if($tugaspelajaran=="biologi"){echo "selected";}?>>Biologi</option>
	                        <option value="geografi" <?php if($tugaspelajaran=="geografi"){echo "selected";}?>>Geografi</option>
	                        <option value="sejarah" <?php if($tugaspelajaran=="sejarah"){echo "selected";}?>>Sejarah</option>
	                        <option value="sosiologi" <?php if($tugaspelajaran=="sosiologi"){echo "selected";}?>>Sosiologi</option>
	                        <option value="mulok" <?php if($tugaspelajaran=="mulok"){echo "selected";}?>>Mulok</option>
	                        <option value="wirausaha" <?php if($tugaspelajaran=="wirausaha"){echo "selected";}?>>Wirausaha</option>
	                        <option value="bahasa_indonesia" <?php if($tugaspelajaran=="bahasa_indonesia"){echo "selected";}?>>Bahasa Indonesia</option>
	                        <option value="bahasa_mandarin" <?php if($tugaspelajaran=="bahasa_mandarin"){echo "selected";}?>>Bahasa Mandarin</option>
	                        <option value="bahasa_inggris" <?php if($tugaspelajaran=="bahasa_inggris"){echo "selected";}?>>Bahasa Inggris</option>
	                        <option value="komputer" <?php if($tugaspelajaran=="komputer"){echo "selected";}?>>Komputer</option>
	                        <option value="lintas_minat" <?php if($tugaspelajaran=="lintas_minat"){echo "selected";}?>>Lintas Minat</option>
	                        <option value="lainnya" <?php if($tugaspelajaran=="lainnya"){echo "selected";}?>>Lainnya</option>
	                      </select>
	                    </div>
	                    <div class="form-group">
	                      <label>Prioritas <span class="text-danger">*</span></label><br>
	                      <div class="form-check-inline">
	                        <label class="form-check-label">
	                          <input type="radio" class="form-check-input" value="wajib" name="tugasprioritas" <?php if($tugasprioritas=="wajib"){echo "checked";}?>>WAJIB
	                        </label>
	                      </div>
	                      <div class="form-check-inline">
	                        <label class="form-check-label">
	                          <input type="radio" class="form-check-input" value="tidak wajib" value="" name="tugasprioritas" <?php if($tugasprioritas=="tidak wajib"){echo "checked";}?>>TIDAK WAJIB
	                        </label>
	                      </div>
	                    </div>
	                </div>
	            </div><br><br>
	            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block" style="font-family: sans-serif;"><span class="fa fa-save"></span> <b>SAVE</b></button>
	          </form>
	          <br>
	          <form action="sistem/delete_tugas" method="POST">
	          	<input type="hidden" name="tugasid" value="<?php echo $tugasid;?>">
	          	<button type="submit" name="submit" class="btn btn-lg btn-outline-danger btn-block" style="font-family: sans-serif;"><b>DELETE</b></button>
	          </form>
	        </div>       
      	</div><br><br>
      	<p>empowered by <b>TugasKita Indonesia</b></p><br><br><br>
	</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
	function formatDeadline($date) {
		$dateArray = explode("-", $date);
		$day = str_pad($dateArray[0], 2, "0", STR_PAD_LEFT);
		$month = str_pad($dateArray[1], 2, "0", STR_PAD_LEFT);
		$year = str_pad($dateArray[2], 4, "0", STR_PAD_LEFT);
		return $year."-".$month."-".$day;
	}
?>