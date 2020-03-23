<?php
	if(!isset($_SESSION)) 
    	session_start(); 
	require 'sistem/connection.php';
	$data = json_decode($_SESSION['grup']);

	if (!isset($_SESSION['user_id'])) {
		header("Location: error404-page/404-page-not-found");
		exit();
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Tugas | TugasKita Indonesia</title>
<link rel="shortcut icon" href="images/logo.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--button css-->
<link href="css/demo-page.css" rel="stylesheet" media="all">
<link href="css/hover.css" rel="stylesheet" media="all">
<!--//but-->
<style type="text/css">
	.inner-block {
		background-color: #FFF !important;
	}
</style>
</head>
<body>	
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									 <a href="index.html"> <h1>TugasKita</h1> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								  </a> 								
							</div>
							<div class="clearfix"> </div>
						 </div>
						 <div class="header-right hidden">
							<!--notification menu end -->
							<div class="profile_details">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="<?php echo $_SESSION['user_avatar']?>" alt="" width="30" height="30"> </span> 
												<div class="user-name">
													<p><?php echo $_SESSION['user_namalengkap']?></p>
													<span>ONLINE</span>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
											<li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">
	<h3>Pilih salah satu grup <small>(Klik untuk Refresh)</small></h3>
	<br>
	<div class="btn-group">
		<form method="POST" action="sistem/load_tugas">
			<?php
				for ($i=0;$i<count($data->grup);$i++) {
					$grupnama = $data->grup[$i]->namagrup;
					$grupid = $data->grup[$i]->idgrup;
					echo "<button class='btn btn-primary' name='grupid' type='submit' value='".$grupid."'>".$grupnama."</button>";
				}
			?>
		</form>
	</div>
	
	<br><br>
	<?php
		if (isset($_SESSION['grupid'])) {
			echo "<strong>sekarang menampilkan: ".$_SESSION['grupnama']."</strong>";
		}
	?>
	<br><br><br><br><br><br>

	<?php
		if (isset($_SESSION['tugas'])) {
			$data = json_decode($_SESSION['tugas']);

			$today = array();
			$tommorow = array();
			$other = array();

			for ($i=0; $i<count($data->tugas);$i++) { 
				if ($data->tugas[$i]->tugaswaktu_number == 0) {
					# HARI INI
					array_push($today, $data->tugas[$i]);
				} else if ($data->tugas[$i]->tugaswaktu_number == 1) {
					# BESOK
					array_push($tommorow, $data->tugas[$i]);
				} else {
					# LAIN-LAINNYA
					array_push($other, $data->tugas[$i]);
				}
			}
			
			echo '<h3>Hari ini</h3>
		<br><br>
		<div>
			<table class="table">
				<thead>
					<td><strong>AUTHOR</strong></td>
					<td><strong>PELAJARAN</strong></td>			
					<td><strong>TUGAS</strong></td>
					<td><strong>DEADLINE</strong></td>
					<td><strong>PRIORITAS</strong></td>
				</thead>
				<tbody>
					';
						for ($i=0;$i<count($today);$i++) { 
							$author = $today[$i]->tugasauthornama;
							$matapelajaran = $today[$i]->tugaspelajaran;
							$nama = $today[$i]->tugasnama;
							$tugaswaktu = $today[$i]->tugaswaktu_harilagi;
							$tugascerita = $today[$i]->tugascerita;
							$tugasprioritas = $tommorow[$i]->tugasprioritas;
							if ($tugascerita == "") {
								$tugascerita = "tugas ini tidak memiliki penjelasan...";
							}
							echo '<tr>
						<td><strong>'.$author.'</strong></td>
						<td>'.$matapelajaran.'</td>
						<td><strong>'.$nama.'</strong> <br> '.$tugascerita.'</td>
						<td>'.$tugaswaktu.'</td>
						<td><strong>'.strtoupper($tugasprioritas).'</strong></td>
					</tr>';
						}

					echo'
				</tbody>
			</table>        
		</div> 

		<br><br><br>';
	?>
		
	
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<!--climate end here-->
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>TugasKita Indonesia 2019 | All Rights Reserved</p>
</div>	
<!--COPY rights end here-->
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="dashboard"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
		        <li id="menu-comunicacao" ><a href="sistem/load_grup"><i class="fa fa-book nav_icon"></i><span>Tugas</span></a></li>
		        <li><a href="sistem/load_undangan_masuk"><i class="fa fa-envelope"></i><span>Undangan</span></a></li>
		        <li><a href="sistem/load_teman"><i class="fa fa-users"></i><span>Teman</span></a></li>
		        <li><a href="sistem/logout"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>                    