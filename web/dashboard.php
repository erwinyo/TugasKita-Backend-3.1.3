<?php
	if(!isset($_SESSION)) 
    	session_start(); 
	require 'sistem/connection.php';
	if (!isset($_SESSION['user_id'])) {
		header("Location: error404-page/404-page-not-found");
		exit();
	}
	date_default_timezone_set('Asia/Jakarta');
    $info = getdate();
    $date = $info['mday'];
    $month = $info['mon'];
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TugasKita Indonesia</title>
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
<!--static chart-->
<script src="js/Chart.min.js"></script>
<!--//charts-->
<!-- geo chart -->
    <script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
    <!--<script src="lib/html5shiv/html5shiv.js"></script>-->
     <!-- Chartinator  -->
    <script src="js/chartinator.js" ></script>
    <script type="text/javascript">
        jQuery(function ($) {

            var chart3 = $('#geoChart').chartinator({
                tableSel: '.geoChart',

                columns: [{role: 'tooltip', type: 'string'}],
         
                colIndexes: [2],
             
                rows: [
                    ['China - 2015'],
                    ['Colombia - 2015'],
                    ['France - 2015'],
                    ['Italy - 2015'],
                    ['Japan - 2015'],
                    ['Kazakhstan - 2015'],
                    ['Mexico - 2015'],
                    ['Poland - 2015'],
                    ['Russia - 2015'],
                    ['Spain - 2015'],
                    ['Tanzania - 2015'],
                    ['Turkey - 2015']],
              
                ignoreCol: [2],
              
                chartType: 'GeoChart',
              
                chartAspectRatio: 1.5,
             
                chartZoom: 1.75,
             
                chartOffset: [-12,0],
             
                chartOptions: {
                  
                    width: null,
                 
                    backgroundColor: '#fff',
                 
                    datalessRegionColor: '#F5F5F5',
               
                    region: 'world',
                  
                    resolution: 'countries',
                 
                    legend: 'none',

                    colorAxis: {
                       
                        colors: ['#679CCA', '#337AB7']
                    },
                    tooltip: {
                     
                        trigger: 'focus',

                        isHtml: true
                    }
                }

               
            });                       
        });
    </script>
<!--geo chart-->

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>	
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									<a href="./"> <h1>TugasKita</h1> 
									<!-- <img id="logo" src="" alt="Logo"/>  -->
								  </a> 								
							</div>
							<div class="clearfix"> </div>
						 </div>
							<div class="profile_details hidden">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
												<div class="user-name">
													<p><?php echo $_SESSION['user_namalengkap']; ?></p>
													<span>ONLINE</span>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
											<li> <a href="sistem/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
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
<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
						<?php
							$countTugas = 0;
			                $cur_userid = $_SESSION['user_id'];
			                # COLLECT JUMLAH TUGAS
			                $ugjt_SQL = "SELECT * FROM user_grup WHERE user_id='$cur_userid';";
			                $ugjt_RES = mysqli_query($connection, $ugjt_SQL);

			                while ($ugjt_FET = mysqli_fetch_assoc($ugjt_RES)) {
			                    $grupid = $ugjt_FET['grup_id'];
			                    $jtSQL = "SELECT * FROM tugas WHERE tugas_posisi='$grupid';";
			                    $jtRES = mysqli_query($connection, $jtSQL);
			                    $jtROW = mysqli_num_rows($jtRES);
			                    while ($jtFET = mysqli_fetch_assoc($jtRES)) {
			                        $dt = strtotime($jtFET['tugas_waktu']);
			                        $dn = strtotime($date."-".$month."-".$year);
			                        $dv = ($dt - $dn) / 86400;
			                        if ($dv >= 0) {
			                            ++$countTugas;
			                        }
			                    }
			                }

			                if ($countTugas == 0) {
			                    $_SESSION['jumlahtugas'] = "0";
			                } else {
			                    $_SESSION['jumlahtugas'] = strval($countTugas);
			                }
						?>
						<h3><?php echo $_SESSION['jumlahtugas'];?></h3>
						<h4>Tugas</h4>
						<p>yang akan datang</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-text-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				 <div class="col-md-8 market-update-left">
					<?php
						$userid = $_SESSION['user_id'];
						$ug_SQL = "SELECT * FROM user_grup WHERE user_id='$userid';";
						$ug_RES = mysqli_query($connection, $ug_SQL);
						$ug_ROW = mysqli_num_rows($ug_RES);
						# SET THE DEFAULT
						$_SESSION['akumulasitugas'] = "0";
						while ($ug_FET = mysqli_fetch_assoc($ug_RES)) {
							$gid = $ug_FET['grup_id'];

							$akumulasi_SQL = "SELECT * FROM grup WHERE grup_id='$gid';";
							$akumulasi_RES = mysqli_query($connection, $akumulasi_SQL);
							$akumulasi_FET = mysqli_fetch_assoc($akumulasi_RES);
							$_SESSION['akumulasitugas'] = $akumulasi_FET['grup_total'];
						}
						
					?>
					<h3><?php echo $_SESSION['akumulasitugas'];?></h3>
					<h4>Akumulasi Tugas</h4>
					<p>selama bergabung</p>
				  </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<?php
							$countUndangan = 0;
							$userid = $_SESSION['user_id'];
							$u_SQL = "SELECT * FROM invite_grup WHERE invite_to='$userid';";
							$u_RES = mysqli_query($connection, $u_SQL);
							$u_ROW = mysqli_num_rows($u_RES);

							$_SESSION['jumlahundangan'] = $u_ROW;
						?>
						<h3><?php echo $_SESSION['jumlahundangan']?></h3>
						<h4>Undangan</h4>
						<p>masuk oleh grup</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>
<!--market updates end here-->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</div>
<!--inner block end here-->
<div class="copyrights">
	 <p>TugasKita Indonesia 2019 | All Rights Reserved</p>
</div>	
</div>
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