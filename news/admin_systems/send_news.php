<?php
	session_start();
	require 'connection.php';
	require '../cloudinary/autoload.php';
	require '../cloudinary/src/Helpers.php'; //optional for using the cl_image_tag and cl_video_tag helper methods	
	date_default_timezone_set('Asia/Jakarta');
    $info = getdate(date("U"));
    $date = $info['mday']; // 2
    $date_n = $info['weekday']; // TUESDAY
    $month = $info['mon']; // 1
    $month_n = $info['month']; // JANUARY
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];

    \Cloudinary::config(array( 
	  	"cloud_name" => "dizwvnwu0", 
  		"api_key" => "844519223851721", 
	  	"api_secret" => "Ru0CeJvwV_L7_WPyZ9QcKboXAMQ", 
	  	"secure" => true
	));


    $userid = $_SESSION['user_id'];
	$images = mysqli_real_escape_string($connection, $_POST['images']);;
	$title = mysqli_real_escape_string($connection, $_POST['title']);;
	$paragraph1 = mysqli_real_escape_string($connection, $_POST['paragraph1']);
	$paragraph2 = mysqli_real_escape_string($connection, $_POST['paragraph2']);
	$paragraph3 = mysqli_real_escape_string($connection, $_POST['paragraph3']);
	$paragraph4 = mysqli_real_escape_string($connection, $_POST['paragraph4']);
	$paragraph5 = mysqli_real_escape_string($connection, $_POST['paragraph5']);
	$tag = strtoupper(mysqli_real_escape_string($connection, $_POST['tag']));
	$lokasi = mysqli_real_escape_string($connection, $_POST['lokasi']);

	$title = ucwords($title);
	$titleformated = str_replace(" ", "+", $title);
	$filename = $titleformated.".php";
	$paragraph = $paragraph1."~".$paragraph2."~".$paragraph3."~".$paragraph4."~".$paragraph5;

	$date = str_pad($date, 2, "0", STR_PAD_LEFT);
	$curDate = "Senin ".$date." ".formatMonthToText($month)." ".formatTime($hour, $min, $sec);

	$images_array = explode(",", $images);
	$text = '<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<title>'.$title.' | TugasKita News</title>
	<link rel="shortcut icon" href="../web/images/logo.ico" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">

	<style>
		p {
			font-family: "Nunito", sans-serif;
		}
	</style>
</head>
<body>
	<div class="container">
		<br>
		<div class="row">
			<h1>'.$title.'</h1>
		</div>
		<div class="row">
			<p>'.$lokasi.' - <span class="text-info">'.$curDate.'</span> | <span class="text-danger">'.$tag.'</span></p>
		</div>
		<br>
		<div class="row">
			<p>'.$paragraph1.'</p>
		</div>
		<br>
		<div class="row">
			<p>'.$paragraph2.'</p>
		</div>
		<br>
		<div class="row">';
			$text = $text.cl_image_tag("tugaskita/news/".$images_array[0].".jpg", array("class"=>"img-fluid", "secure"=>true, "width"=>1280, "height"=>720,"crop"=>"mpad"));
			$text = $text.'<p><span class="text-muted">image of news</span></p>
		</div>
		<br>
		<div class="row">
			<p>'.$paragraph3.'</p>
		</div>
		<br>
		<div class="row">';
		for ($i=1; $i < count($images_array)-2; $i++) { 
			$text = $text.'<div class="col-md-3 col-sm-12">';
			$text = $text.cl_image_tag("tugaskita/news/".$images_array[$i].".jpg", array("class"=>"img-fluid", "secure"=>true, "width"=>1280, "height"=>720,"crop"=>"mfit"));
			$text = $text.'<p><span class="text-muted">image of news</span></div>';
		};
		$text = $text.'</div>
		<br>
		<div class="row">
			<p>'.$paragraph4.'</p>
		</div>
		<br>
		<div class="row">';
			$text = $text.cl_image_tag("tugaskita/news/".$images_array[count($images_array)-2].".jpg", array("class"=>"img-fluid", "secure"=>true, "width"=>1280, "height"=>720, "crop"=>"mpad"));
			$text = $text.'<p><span class="text-muted">image of news</span></p>
		</div>
		<br>
		<div class="row">
			<p>'.$paragraph5.'</p>
		</div>
		<br><br><br><br>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>';

	$current = $date."-".$month."-".$year;
	$newsid = uniqid();
	$SQL = "INSERT INTO news(news_id, news_title, news_content, news_date, news_modified, news_author, news_image, news_source) VALUES('$newsid', '$title', '$paragraph', '$current', '$current', '$userid', '$images', '$titleformated');";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		$file = fopen("../".$filename, "w") or die("Unable to open file!");;
		fwrite($file, $text);
		fclose($file);
		header("Location: ../admin");
		exit();
	} else {
		echo mysqli_errno($connection);
	}

	function formatMonthToText($month) {
		$result = "";
		switch ($month) {
			case 1:$result = "Januari";break;
			case 2:$result = "Februari";break;
			case 3:$result = "Maret";break;
			case 4:$result = "April";break;
			case 5:$result = "Mei";break;
			case 6:$result = "Juni";break;
			case 7:$result = "Juli";break;
			case 8:$result = "Agustus";break;
			case 9:$result = "September";break;
			case 10:$result = "Oktober";break;
			case 11:$result = "November";break;
			case 12:$result = "Desember";break;
		}
		return $result;
	}

	function formatTime($hour, $minute, $second) {
		$hour = str_pad($hour, 2, "0", STR_PAD_LEFT);
		$minute = str_pad($minute, 2, "0", STR_PAD_LEFT);
		$second = str_pad($second, 2, "0", STR_PAD_LEFT);

		return $hour.":".$minute.":".$second;
	}
