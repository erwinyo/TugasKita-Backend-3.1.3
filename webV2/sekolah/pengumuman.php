<?php
	session_start();
	require '../connection.php';

	// Standart Check Login Session
	if (isset($_SESSION['sekolah_id'])) {
		$sekolah_id = $_SESSION['sekolah_id'];
		$sekolah_nama = $_SESSION['sekolah_nama'];
	} else {
		header("Location: ../cbt-sekolah");
	}
?>

<html lang="en">
  <head>
  	<link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/ico.png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <title>PENGUMUMAN</title>
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
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
	<nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 shadow">
	  <span class="navbar-brand col-sm-3 col-md-2 mr-0 bg-light"><span class="h4">TugasKita </span></span>
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
	            <a class="nav-link" href="paket">
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

	    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	    	<div class="mt-4">
		    	<?php
					$A_SQL = "SELECT * FROM akun";
					$A_RES = mysqli_query($connection, $A_SQL);
					$A_ROW = mysqli_num_rows($A_RES);
				?>
	    		<h3>PENGUMUMAN</h3>
	    		<p>Kirim Pesan Notifikasi Keseluruh Siswa Hanya Dengan Hitungan Detik Ke <b><?php echo $A_ROW;?> SISWA</b></p>
	    		<div class="row mt-5">
	    			<div class="col-4">
	    				<form action="../sistem/push_notification" method="POST">
			    			<div class="form-group">
			    				<label>Isi Pesan Yang Anda Kirim:</label>
			    				<textarea class="form-control" rows="4" name="pesan" required></textarea>
			    			</div>
			    			<div class="text-right">
			    				<button type="submit" class="btn btn-outline-primary"><span class="fa fa-send"></span> Kirim</button>
			    			</div>
			    		</form>
	    			</div>
	    		</div>
	    	</div>
	    </main>
	  </div>
    </div>	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>