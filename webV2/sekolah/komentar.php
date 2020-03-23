<?php
	session_start();
	require '../connection.php';

	// Standart Check Login Session
	if (isset($_SESSION['sekolah_id'])) {
		$sekolah_id = $_SESSION['sekolah_id'];
	} else {
		header("Location: ../cbt-sekolah");
	}

	// GET request check and SESSION check -> paket ID
	$isThereId = false;
	if (isset($_GET['paket'])) {
		$paket = mysqli_real_escape_string($connection, $_GET['paket']);
		$isThereId = true;

		// set session
		$_SESSION['paket'] = $paket;

		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND id='$paket';";	
		$P_RES = mysqli_query($connection, $P_SQL);
		$P_FET = mysqli_fetch_assoc($P_RES);

	} else if (isset($_SESSION['paket'])) {
		$paket = $_SESSION['paket'];
		$isThereId = true;
		
		$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah_id' AND id='$paket';";	
		$P_RES = mysqli_query($connection, $P_SQL);
		$P_FET = mysqli_fetch_assoc($P_RES);
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
    <!-- AOS (Animated Scroll Bar) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <title>KOMENTAR</title>
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
	            <a class="nav-link" href="paket">
	              <span class="fa fa-database"></span>
	              PAKET
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link active" href="komentar">
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
	    	<?php
		    	if ($isThereId) {
		    		$I_SQL = "SELECT * FROM insight WHERE paket='$paket';";
					$I_RES = mysqli_query($connection, $I_SQL);
					$I_ROW = mysqli_num_rows($I_RES);
		    	}
	    	?>
	    	<div class="mt-4">
	    		<div class="row">
	    			<div class="col-md-8">
	    				<h3><?php if($isThereId){echo $I_ROW;} else {echo "0";}?> Komentar Siswa <span class="text-primary">&#8226;</span> <?php if($isThereId){echo $P_FET['nama'];}?></h3>
	    				<small>DAFTAR KOMENTAR SISWA SMAK STELLA MARIS SURABAYA</small>
	    			</div>
	    		</div>
	    		<div class="mt-5">
	    			<div>
	    				<ul type="none">
			      			<?php
					        	if ($isThereId) {
								  	while ($I_FET = mysqli_fetch_assoc($I_RES)) {
								  		$jumlahBintang = $I_FET['bintang'];
								  		$komentar = $I_FET['komentar'];
								  		echo '<li class="mt-3">
								  				<div class="badge">';
												    for ($i=0; $i < $jumlahBintang; $i++) { 
												    	echo '<span class="fa fa-star text-warning"></span>';
												    }				    
									       echo '</div><br>
									       		<span class="komentar"><b>"'.$komentar.'"</b></span>
									    </li>';
								  	}
					        	} else {
					        		echo "<p>Apa yang Anda cari tidak ada disini, untuk melihatnya <a href='paket'>VISIT</a></p>";
					        	}
					        ?> 
			      		</ul>
	    			</div>
	    		</div>
	    	</div>
	    </main>
	  </div>
    </div>
</body>
</html>