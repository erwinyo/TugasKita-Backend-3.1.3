<?php
	if(!isset($_SESSION)) 
    	session_start(); 
	require 'sistem/connection.php';
	$data = json_decode($_SESSION['undangan_masuk']);

	if (!isset($_SESSION['user_id'])) {
		header("Location: error404-page/404-page-not-found");
		exit();
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Undangan Masuk | TugasKita Indonesia</title>
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
												<span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
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
											<li> <a href="sistem/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
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
    <div class="inbox">
    	  <h2>Inbox</h2>
    	 <div class="col-md-4 compose">   	 	
    	 	<div class="mail-profile">
    	 		<div class="mail-pic">
    	 			<a href="#"><img src="<?php echo $_SESSION['user_avatar'];?>" alt="" width="70"></a>
    	 		</div>
    	 		<div class="mailer-name"> 			
    	 				<h5><a href="#"><?php echo $_SESSION['user_namalengkap'];?></a></h5>  	 				
    	 			     <h6><a><?php echo $_SESSION['user_email'];?></a></h6>   
    	 		</div>
    	 	    <div class="clearfix"> </div>
    	 	</div>
    	 	<div class="compose-bottom">
    	 		  <nav class="nav-sidebar">
					<ul class="nav tabs">
			          <li><a href="undangan-masuk" data-toggle="tab"><i class="fa fa-inbox"></i>Inbox</a></li>
					</ul>
				</nav>
    	 	</div>
    	 </div>
    	 <div class="col-md-8 mailbox-content  tab-content tab-content-in">
    	 	<div class="tab-pane active text-style" id="tab1">
	    	 	<div class="mailbox-border">
	               <div class="mail-toolbar clearfix">
	               	<strong>Undangan masuk</strong><br><br>
	               	<?php
	               		if (count($data->listofinvitation) == 0) {
	                		echo "Tidak ada undangan masuk!";
	                	}
	               	?>
	               </div>
	                <table class="table tab-border">
	                    <tbody> 
	                    	<?php
	                    		for($i=0;$i<count($data->listofinvitation);$i++) {
	                    			$invite_from = $data->listofinvitation[$i]->invite_from;
	                    			$invite_from_id = $data->listofinvitation[$i]->invite_from_id;
	                    			$invite_to_grup = $data->listofinvitation[$i]->invite_to_grup;
	                    			$invite_to_grup_id = $data->listofinvitation[$i]->invite_to_grup_id;
	                    			$as_status = $data->listofinvitation[$i]->as_status;
	                    			$text = $invite_from." mengundang kamu bergabung di ".$invite_to_grup." sebagai <strong>".$as_status."</strong>";

		                    		echo '<tr class="unread checked">
		                            <td class="hidden-xs">
		                                <i class="fa fa-star icon-state-warning"> </i>
		                            </td>
		                            <td class="hidden-xs">
		                                '.$invite_from.'
		                            </td>
		                            <td>
		                                '.$text.'
		                            </td>
		                            <td>
		                            	<form method="POST" action="sistem/accept_undangan">
		                            		<input type="hidden" name="grupid" value="'.$invite_to_grup_id.'" >
		                            		<input type="hidden" name="as_status" value="'.$as_status.'" >
		                                	<button type="submit" class="btn btn-success">TERIMA</button>
		                                </form>
		                            	<br>
		                                <form method="POST" action="sistem/delete_undangan">
		                            		<input type="hidden" name="fromid" value="'.$invite_from_id.'">
		                            		<input type="hidden" name="grupid" value="'.$invite_to_grup_id.'">
		                            		<button type="submit" class="btn btn-danger">TOLAK</button>
		                            	</form>
		                            	<br>
		                            </td>
		                        </tr>';
	                    		}
	                    	?>
	                    </tbody>
	                </table>
	               </div>   
               </div>
            </div>
          <div class="clearfix"> </div>         
   </div>

   <br><br><br><br><br><br><br>
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


                      
						
