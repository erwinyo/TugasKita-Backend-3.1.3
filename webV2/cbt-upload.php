<?php 
	session_start();
  if (isset($_SESSION['sekolah_id'])) {
    # code...
  } else {
    header("Location: cbt-sekolah");
    exit();
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
  	<title>Upload | TugasKita</title>
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
		<center>
			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png">&nbsp&nbsp&nbsp
			<img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/stella-maris.png" width="50"><br>
      <h1><span class="text-tugaskita">TugasKita</span> <small class="text-info">CBTL <small class="text-success">upload</small></small></h1>
      <p class="text-danger h5">SMAK STELLA MARIS SURABAYA</p>
		</center>
		<div class="row">
			<div class="col-md-3 col-sm-3"></div>
			<div class="col-md-6 col-sm-6"><hr>
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
		  		<br>
		  		<div class="text-right">
		  			<div class="progress" style="height: 20px;" id="progress">
					  <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Mohon Tunggu Sebentar</div>
					</div>
		  			<button class="btn btn-primary mt-2" type="submit" name="submit" id="submit"><span class="fa fa-plus"></span> Buat Paket Baru</button>
		  		</div>
			</div>
			<div class="col-md-3 col-sm-3"></div>
		</div><br><br><br><br><br>
	</div>
	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
  				$.post("sistem/register_paket.php", 
  					{
  						nama: paket, 
  						sekolah: "<?php echo $_SESSION['sekolah_id'];?>",
  						pilgan: pilgan,
  						uraian: uraian,
  						waktu: pengerjaan
  					}, 
  					function(data, status) {
  					/*optional stuff to do after success */
  					if (data == "1") {
  						// Simulate an HTTP redirect:
						  window.location.replace("cbt-upload-soal");
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
</body>
</html>