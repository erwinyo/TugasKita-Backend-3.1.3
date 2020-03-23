<?php 
	session_start();
	require 'connection.php';
	if (isset($_SESSION['upload_id'])) {
		if (isset($_GET['id'])) {
			# jika ada data get id
			$paket = $_SESSION['upload_id'];
			$id = $_GET['id'];
			$SQL = "SELECT * FROM soal WHERE id='$id';";
			$RES = mysqli_query($connection, $SQL);
			$FET = mysqli_fetch_assoc($RES);

			$tempSoal = decrypt($FET['soal'], $_SESSION['key']);
			$tempFoto = decrypt($FET['gambar'], $_SESSION['key']);
			$tempA = decrypt($FET['a'], $_SESSION['key']);
			$tempB = decrypt($FET['b'], $_SESSION['key']);
			$tempC = decrypt($FET['c'], $_SESSION['key']);
			$tempD = decrypt($FET['d'], $_SESSION['key']);
			$tempE = decrypt($FET['e'], $_SESSION['key']);
			$tempAFoto = decrypt($FET['a_gambar'], $_SESSION['key']);
			$tempBFoto = decrypt($FET['b_gambar'], $_SESSION['key']);
			$tempCFoto = decrypt($FET['c_gambar'], $_SESSION['key']);
			$tempDFoto = decrypt($FET['d_gambar'], $_SESSION['key']);
			$tempEFoto = decrypt($FET['e_gambar'], $_SESSION['key']);
			$tempJawaban = decrypt($FET['benar'], $_SESSION['key']);

			$_SESSION['upload_soal_array_index'] = array_search($_GET['id'], $_SESSION['upload_soal_array']);
			$nextIndex = $_SESSION['upload_soal_array_index']+1;

		} else {
			# jika tidak ada data maka di redirect ke ada data

			# cek jika sesi upload_soal_array di set
			if (isset($_SESSION['upload_soal_array'])) { 
				# jika ada langsung reload page dengan ada id
				# kembali ke index pertama
				header("Location: cbt-upload-soal?id=".$_SESSION['upload_soal_array'][0]);
				exit();
			} else {
				# jika tidak ada data sesi upload_soal_array
				header("Location: cbt-upload");
				exit();
			}
		}
	} else {
		header("Location: cbt-upload?error=".urlencode("sesi anda telah berakhir, silakan login kembali"));
		exit();
	}

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
  	<title>Soal <?php echo $tempSoal;?></title>
  	<link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<style type="text/css">
        h1, h5 {
            font-family: 'Asap', sans-serif;
        }
        p, button, label, form, input, textarea, ol, .card-body {
            font-family: 'Nunito', sans-serif;
        }
        .gambar:hover {
        	cursor: pointer;
        	box-shadow: 3px 3px 2px grey; 
        }
    </style>
</head>	
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-3 col-sm-3"></div>
			<div class="col-md-6 col-sm-6">
				<div class="row">
					<div class="col-6">
						<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_50/v1571068816/tugaskita/assets/ico.png"><br>
						<span class="display-4">Soal <?php echo array_search($_GET['id'], $_SESSION['upload_soal_array'])+1; ?></span>
					</div>	
					<div class="col-6 text-right">
						<button class="btn btn-danger btn-sm mt-4" id="daftar-soal" data-toggle="modal" data-target="#daftar-soal-modal"><span class="fa fa-database"></span> Daftar Soal</button>
						<button class="btn btn-sm btn-info mt-4" id="publikasi"><span class="fa fa-send"></span> Aktifkan Paket</button>
					</div>
				</div>
				<div class="form-group mt-3">
					<div id="preview-foto"></div>
					<button class="btn btn-sm mt-4" id="upload-foto-soal"><span class="fa fa-upload"></span> Upload Foto</button><br><br>
					<div class="form-group">
						<textarea class="form-control" name="soal" rows="3" id="soal" placeholder="Ketik soal Anda disini" required autocomplete="off"><?php if(isset($_GET['id'])){echo $tempSoal;}?></textarea>
					</div>
				</div>
				<form id="my_radio">
					<div class="form-group mt-4 row">
						<div class="col-sm-2 text-center">
							<div class="custom-control custom-radio">
							    <input type="radio" class="custom-control-input" id="A_RADIO" name="jawaban-radio" value="A" <?php if(isset($_GET['id']) && $tempJawaban=="A"){echo "checked";}?>>
							    <label class="custom-control-label" for="A_RADIO">A</label>
							</div>
						</div>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="A" name="A" value="<?php if(isset($_GET['id'])){echo $tempA;}?>" autocomplete="off">
					      	<div id="preview-foto-a"></div>
					    </div>
					    <div class="col-sm-1">
					      	<a href="#upload-foto-A" id="upload-foto-A"><span style="font-size: 24px;" class="fa fa-image mt-2"></span></a>
					    </div>
					</div>
					<div class="form-group mt-2 row">
						<div class="col-sm-2 text-center">
					    	<div class="custom-control custom-radio">
							    <input type="radio" class="custom-control-input" id="B_RADIO" name="jawaban-radio" value="B" <?php if(isset($_GET['id']) && $tempJawaban=="B"){echo "checked";}?>>
							    <label class="custom-control-label" for="B_RADIO">B</label>
							</div>
						</div>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="B" value="<?php if(isset($_GET['id'])){echo $tempB;}?>" name="B" autocomplete="off">
					      	<div id="preview-foto-b"></div>
					    </div>
					    <div class="col-sm-1">
					      	<a href="#upload-foto-B" id="upload-foto-B"><span style="font-size: 24px;" class="fa fa-image mt-2"></span></a>
					    </div>
					</div>
					<div class="form-group mt-2 row">
				    	<div class="col-sm-2 text-center">
							<div class="custom-control custom-radio">
							    <input type="radio" class="custom-control-input" id="C_RADIO" name="jawaban-radio" value="C" <?php if(isset($_GET['id']) && $tempJawaban=="C"){echo "checked";}?>>
							    <label class="custom-control-label" for="C_RADIO">C</label>
							</div>
						</div>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="C" value="<?php if(isset($_GET['id'])){echo $tempC;}?>" name="C" autocomplete="off">
					      	<div id="preview-foto-c"></div>
					    </div>
					    <div class="col-sm-1">
					      	<a href="#upload-foto-C" id="upload-foto-C"><span style="font-size: 24px;" class="fa fa-image mt-2"></span></a>
					    </div>
					</div>
					<div class="form-group mt-2 row">
				    	<div class="col-sm-2 text-center">
							<div class="custom-control custom-radio">
							    <input type="radio" class="custom-control-input" id="D_RADIO" name="jawaban-radio" value="D" <?php if(isset($_GET['id']) && $tempJawaban=="D"){echo "checked";}?>>
							    <label class="custom-control-label" for="D_RADIO">D</label>
							</div>
						</div>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="D" value="<?php if(isset($_GET['id'])){echo $tempD;}?>" name="D" autocomplete="off">
					      	<div id="preview-foto-d"></div>
					    </div>
					    <div class="col-sm-1">
					      	<a href="#upload-foto-D" id="upload-foto-D"><span style="font-size: 24px;" class="fa fa-image mt-2"></span></a>
					    </div>
					</div>
					<div class="form-group mt-2 row">
				    	<div class="col-sm-2 text-center">
							<div class="custom-control custom-radio">
							    <input type="radio" class="custom-control-input" id="E_RADIO" name="jawaban-radio" value="E" <?php if(isset($_GET['id']) && $tempJawaban=="E"){echo "checked";}?>>
							    <label class="custom-control-label" for="E_RADIO">E</label>
							</div>
						</div>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" id="E" value="<?php if(isset($_GET['id'])){echo $tempE;}?>" name="E" autocomplete="off">
					      	<div id="preview-foto-e"></div>
					    </div>
					    <div class="col-sm-1">
					      	<a href="#upload-foto-E" id="upload-foto-E"><span style="font-size: 24px;" class="fa fa-image mt-2"></span></a>
					    </div>
					</div>
				</form>
				<div class="alert alert-success mt-3" role="alert" id="success-alert">
				  	<h4 class="alert-heading"><span class="fa fa-check-circle"></span> Tersimpan!</h4>
				</div>
				<div class="alert alert-danger mt-3" role="alert" id="danger-alert">
				  	<h4 class="alert-heading">Terjadi Kesalahan!</h4>
				</div>
				<div class="text-right mt-5">
					<div class="progress mb-2" style="height: 20px;" id="progress">
					  <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Mohon Tunggu Sebentar</div>
					</div>
					<button class="btn btn-primary" id="simpan"><span class="fa fa-check"></span> simpan soal</button>
					<?php
						if (($_SESSION['upload_soal_array_index']+1) != $_SESSION['upload_butir']) {
							echo '<a href="cbt-upload-soal?id='.$_SESSION["upload_soal_array"][$nextIndex].'"><button class="btn btn-success" id="selanjutnya">lanjut <span class="fa fa-arrow-right"></span></button></a>';
						}
					?>
				</div>
				<div>
					<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#yakin-keluar-modal"><span class="fa fa-sign-out"></span> LOGOUT</button>
				</div>
			</div>
			<div class="col-md-3 col-sm-3"></div>
		</div>
		<br><br><br>
	</div>
	<!-- Modal Daftar Soal-->
	<div class="modal fade" id="daftar-soal-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-light">
	        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-database"></span> DAFTAR SOAL</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="list-group" id="daftar-soal-list"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal Anda yakin keluar?-->
	<div class="modal fade" id="yakin-keluar-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Anda Yakin?<br>Anda masih bisa melanjutkannya nanti</p>
	        <small class="mt-5 text-danger">pastikan Anda sudah menyimpan soal terakhir Anda</small>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	        <a href="sistem/logout?type=upload"><button type="button" class="btn btn-primary">Logout</button></a>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal Gambar Preview -->
	<div class="modal fade" id="gambar-preview-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle"><span class="fa fa-image"></span> FOTO</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <img src="" id="gambar-preview-img" class="img-fluid">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Publikasi Modal -->
	<div class="modal fade" id="publikasi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-info text-light">
	        <h5 class="modal-title" id="exampleModalLongTitle"><span class="fa fa-send"></span> Status Aktif</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Paket Anda berhasil diaktifkan.
	        <span class="badge badge-primary">Paket Anda sudah aktif, tetapi belum siap untuk digunakan.</span></p>
	        <hr class="mt-5">	
	        <p>Klik "Tidak Publikasikan" untuk menonaktifkan kembali. Klik 'Tutup' untuk membiarkan paket ini aktif.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" id="tidak-publikasi"><span class="fa fa-close"></span> Non-Aktifkan Paket</button>
	        <button type="button" class="btn btn-success" data-dismiss="modal"><span class="fa fa-check"></span> Selesai</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script type="text/javascript">
  		// Fungsi Sleep
  		function sleep(ms) {
		  return new Promise(resolve => setTimeout(resolve, ms));
		}
		async function waitfor(miliseconds) {
		  await sleep(miliseconds);
		}
		// Fungsi Load Daftar Soal
  		var paket = "<?php echo $paket;?>";
  		function appendLinkElement(data, parent) { 
  			var p = document.getElementById(parent);
  			// Buat element <a> dan diberi modifikasi
            var link = document.createElement("A");
            link.href = "cbt-upload-soal?id="+data.id;
            link.classList.add("list-group-item");
            link.classList.add("list-group-item-action");
            link.innerHTML = "<b class='h4 mr-5'>"+data.number+"</b>"+data.title;
            // append ke element parent nya
            p.appendChild(link); 
        }
        // Load daftar soal
        function loadDaftarSoal() {
        	$.post("sistem/load_daftar_soal_upload.php", 
	        	{
	        		paket: paket
	        	},
        	function(data, status) {
        		var parsed = JSON.parse(data);
        		if (parsed.success == "1") {
        			document.getElementById("daftar-soal-list").innerHTML = "";
    				for (var i = 0; i < parsed.soal.length; i++) {
	        			appendLinkElement(parsed.soal[i], "daftar-soal-list");
	        		}
        		} else {
        			alert("Terjadi Kesalahan! mohon halaman dimuat lagi. Jika terjadi terus-menerus klik simpan & logout, tanyakan ke kami.");
        		}
        	});
        }
        loadDaftarSoal(); // default load
		var foto = "<?php echo $tempFoto;?>";
		var foto_A = "<?php echo $tempAFoto;?>";
		var foto_B = "<?php echo $tempBFoto;?>";
		var foto_C = "<?php echo $tempCFoto;?>";
		var foto_D = "<?php echo $tempDFoto;?>";
		var foto_E = "<?php echo $tempEFoto;?>";
		var jawaban = "<?php if(isset($_GET['id']) && $tempJawaban!=""){echo $tempJawaban;}else{echo "";}?>";
		$('#my_radio').change(function(){
            selected_value = $("input[name='jawaban-radio']:checked").val();
            jawaban = selected_value;
        });
  		$("#success-alert").hide();
  		$("#danger-alert").hide();
  		$("#progress").hide();
  		$("#simpan").click(function(event) {
  			$("#success-alert").hide();
  			$("#danger-alert").hide();
  			var soal = $("#soal").val();
  			var A = $("#A").val();
  			var B = $("#B").val();
  			var C = $("#C").val();
  			var D = $("#D").val();
  			var E = $("#E").val();
  			if (soal!="" && A!="" && B!="" && C!="" && D!="" && E!="" && jawaban!="") {
  				$("#simpan").fadeOut('slow', function() {
  					$("#progress").fadeIn('slow', function() {
						$.post('sistem/register_soal.php', 
		  					{
		  						id: "<?php echo $_GET['id'];?>",
		  						soal: soal,
		  						foto: foto,
		  						A: A,
		  						B: B,
		  						C: C,
		  						D: D,
		  						E: E,
		  						fotoA: foto_A,
		  						fotoB: foto_B,
		  						fotoC: foto_C,
		  						fotoD: foto_D,
		  						fotoE: foto_E,
		  						jawaban: jawaban,
		  						type: 'update'
		  					}, 
	  					function(data, status) {
		  					/*optional stuff to do after success */
		  					if (data == "1") {
		  						$("#progress").fadeOut('slow', function() {
		  							$("#simpan").fadeIn('slow');
		  							$("#success-alert").fadeIn('slow', function() {
		  								loadDaftarSoal();
		  								waitfor(5000);
		  								$("#success-alert").fadeOut('slow');
		  								detectDone();
		  							});
		  						});
		  					} else {
		  						alert(data);
		  						$("#progress").fadeOut('slow', function() {
		  							$("#simpan").fadeIn('slow');
		  							$("#danger-alert").fadeIn('slow', function(){
		  								waitfor(5000);
		  								$("#danger-alert").fadeOut('slow');
		  								detectDone();
		  							});
		  						});
		  					}
		  				});
  					});
  				});
  			} else {
  				alert("Data masih kurang lengkap!");
  			}
  		});
  	</script>
  	<!-- Cloudinary Widget --> 
  	<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
  	<script type="text/javascript">
  		// Preview Image fungsi
  		function previewImage(img_url, parent, width) { 
            var img = new Image(); 
            img.src = img_url;
            img.width = width;
            img.style = "margin-top: 10px;margin-right: 10px";
            img.classList.add("img-fluid"); 
            img.classList.add("img-thumbnail"); 
            img.classList.add("rounded"); 
            img.classList.add("gambar"); 
            document.getElementById(parent).appendChild(img); 
        }
        var soal_width = 60;
        // Load all image from database
        if (foto != "") {
	        if (foto.indexOf(',') > -1) {
	        	var fotoArray = foto.split(",");
	        	for (var i = 0; i < fotoArray.length; i++) {
	        		previewImage(fotoArray[i], 'preview-foto', soal_width);
	        	}
	        } else {
	        	previewImage(foto, 'preview-foto', soal_width);
	        }  
	    }
	    var pilihan_width = 50;
        // Load all image A from database
        if (foto_A != "") {
	        if (foto_A.indexOf(',') > -1) {
	        	var fotoArray = foto_A.split(",");
	        	for (var i = 0; i < fotoArray.length; i++) {
	        		previewImage(fotoArray[i], 'preview-foto-a', pilihan_width);
	        	}
	        } else {
	        	previewImage(foto_A, 'preview-foto-a', pilihan_width);
	        }  
	    }
        // Load all image B from database
        if (foto_B != "") {
	        if (foto_B.indexOf(',') > -1) {
	        	var fotoArray = foto_B.split(",");
	        	for (var i = 0; i < fotoArray.length; i++) {
	        		previewImage(fotoArray[i], 'preview-foto-b', pilihan_width);
	        	}
	        } else {
	        	previewImage(foto_B, 'preview-foto-b', pilihan_width);
	        } 
	    } 
        // Load all image C from database
        if (foto_C != "") {
	        if (foto_C.indexOf(',') > -1) {
	        	var fotoArray = foto_C.split(",");
	        	for (var i = 0; i < fotoArray.length; i++) {
	        		previewImage(fotoArray[i], 'preview-foto-c', pilihan_width);
	        	}
	        } else {
	        	previewImage(foto_C, 'preview-foto-c', pilihan_width);
	        }  
	    }
        // Load all image D from database
        if (foto_D != "") {
	        if (foto_D.indexOf(',') > -1) {
	        	var fotoArray = foto_D.split(",");
	        	for (var i = 0; i < fotoArray.length; i++) {
	        		previewImage(fotoArray[i], 'preview-foto-d', pilihan_width);
	        	}
	        } else {
	        	previewImage(foto_D, 'preview-foto-d', pilihan_width);
	        }  
	    }
	    // Load all image E from database
        if (foto_E != "") {
	        if (foto_E.indexOf(',') > -1) {
	        	var fotoArray = foto_E.split(",");
	        	for (var i = 0; i < fotoArray.length; i++) {
	        		previewImage(fotoArray[i], 'preview-foto-e', pilihan_width);
	        	}
	        } else {
	        	previewImage(foto_E, 'preview-foto-e', pilihan_width);
	        }  
	    }
  		var upload_foto_soal_widget = cloudinary.createUploadWidget({ 
		  cloudName: "dizwvnwu0", uploadPreset: "tugaskita_soal" }, (error, result) => { 
		  	if (result && result.event === "success") {
		        var secure_url = result.info.secure_url;
		        foto = foto+","+secure_url;
		        previewImage(secure_url, 'preview-foto', soal_width);
		        detectClickGambarPreviewModal();
		    }
		  });
  		var upload_foto_A_widget = cloudinary.createUploadWidget({ 
		  cloudName: "dizwvnwu0", uploadPreset: "tugaskita_pilihan" }, (error, result) => { 
		  	if (result && result.event === "success") {
		        var secure_url = result.info.secure_url;
		        foto_A = foto_A+","+secure_url;
		        previewImage(secure_url, 'preview-foto-a', pilihan_width);
		        detectClickGambarPreviewModal();
		    }
		  });
  		var upload_foto_B_widget = cloudinary.createUploadWidget({ 
		  cloudName: "dizwvnwu0", uploadPreset: "tugaskita_pilihan" }, (error, result) => { 
		  	if (result && result.event === "success") {
		        var secure_url = result.info.secure_url;
		        foto_B = foto_B+","+secure_url;
		        previewImage(secure_url, 'preview-foto-b', pilihan_width);
		        detectClickGambarPreviewModal();
		    }
		  });
  		var upload_foto_C_widget = cloudinary.createUploadWidget({ 
		  cloudName: "dizwvnwu0", uploadPreset: "tugaskita_pilihan" }, (error, result) => { 
		  	if (result && result.event === "success") {
		        var secure_url = result.info.secure_url;
		        foto_C = foto_C+","+secure_url;
		        previewImage(secure_url, 'preview-foto-c', pilihan_width);
		        detectClickGambarPreviewModal();
		    }
		  });
  		var upload_foto_D_widget = cloudinary.createUploadWidget({ 
		  cloudName: "dizwvnwu0", uploadPreset: "tugaskita_pilihan" }, (error, result) => { 
		  	if (result && result.event === "success") {
		        var secure_url = result.info.secure_url;
		        foto_D = foto_D+","+secure_url;
		        previewImage(secure_url, 'preview-foto-d', pilihan_width);
		        detectClickGambarPreviewModal();
		    }
		});
		var upload_foto_E_widget = cloudinary.createUploadWidget({ 
		  cloudName: "dizwvnwu0", uploadPreset: "tugaskita_pilihan" }, (error, result) => { 
		  	if (result && result.event === "success") {
		        var secure_url = result.info.secure_url;
		        foto_E = foto_E+","+secure_url;
		        previewImage(secure_url, 'preview-foto-e', pilihan_width);
		        detectClickGambarPreviewModal();
		    }
		});
  		// klik button 'upload-foto-soal'
  		$("#upload-foto-soal").click(function(event) {
  			upload_foto_soal_widget.open();
  		});
  		// klik button 'upload-foto-soal'
  		$("#upload-foto-A").click(function(event) {
  			upload_foto_A_widget.open();
  		});
  		// klik button 'upload-foto-soal'
  		$("#upload-foto-B").click(function(event) {
  			upload_foto_B_widget.open();
  		});
  		// klik button 'upload-foto-soal'
  		$("#upload-foto-C").click(function(event) {
  			upload_foto_C_widget.open();
  		});
  		// klik button 'upload-foto-soal'
  		$("#upload-foto-D").click(function(event) {
  			upload_foto_D_widget.open();
  		});
  		// klik button 'upload-foto-soal'
  		$("#upload-foto-E").click(function(event) {
  			upload_foto_E_widget.open();
  		});
  	</script>
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
  		detectClickGambarPreviewModal(); // default run saat browser di load
  		// kenapa dibuat begini? karena web nya tidak mau preview saat ada uploadtan baru
  		var sekolah = "<?php echo $_SESSION['sekolah_id'];?>";
  		function detectDone() {
  			$("#publikasi").hide();
  			$.post("sistem/check_all_soal_paket.php", 
  			{
  				sekolah: sekolah,
  				paket: paket
  			}, function(data, status) {
  				if (data == "1") {
  					$("#publikasi").show('slow');
  				}
  			});
  		}
  		detectDone();
  		$("#publikasi").click(function(event) {
  			$.post("sistem/publikasi_paket.php", 
  			{
  				sekolah: sekolah,
  				paket: paket,
  				public: "1"
  			}, function(data, status) {
  				if (data == "1") {
  					$('#publikasi-modal').modal('show');
  				}
  			});
  		});
  		$("#tidak-publikasi").click(function(event) {
  			$.post("sistem/publikasi_paket.php", 
  			{
  				sekolah: sekolah,
  				paket: paket,
  				public: "0"
  			}, function(data, status) {
  				if (data == "1") {
  					$('#publikasi-modal').modal('hide');
  					alert("Paket Anda telah berhasil di nonaktifkan");
  				}
  			});
  		});
  	</script>
</body>
</html>