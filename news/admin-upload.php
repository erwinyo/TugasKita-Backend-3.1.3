<?php
	require 'cloudinary/autoload.php';
	require 'cloudinary/src/Helpers.php'; //optional for using the cl_image_tag and cl_video_tag helper methods
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>ADMIN-UPLOAD</title>
	<link rel="shortcut icon" href="../web/images/logo.ico" />
</head>
<body>
	<?php
		\Cloudinary::config(array( 
		  	"cloud_name" => "dizwvnwu0", 
	  		"api_key" => "844519223851721", 
		  	"api_secret" => "Ru0CeJvwV_L7_WPyZ9QcKboXAMQ", 
		  	"secure" => true
		));
		// SETUP JAVASCRIPT
		echo cloudinary_js_config();

		if (array_key_exists('REQUEST_SCHEME', $_SERVER)) {   
		  	$cors_location = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] .
		    dirname($_SERVER["SCRIPT_NAME"]) . "/cloudinary_cors.html";
		} else {
		  	$cors_location = "https://" . $_SERVER["HTTP_HOST"] . "/cloudinary_cors.html";
		}
	?>

	<button id="upload_widget" class="cloudinary-button">Cloudinary Upload</button>

	<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>

	<script type="text/javascript">
		var myWidget = cloudinary.createUploadWidget({
		  	cloudName: 'dizwvnwu0', 
		  	uploadPreset: 'tugaskita_news',
		  showCompletedButton: true}, (error, result) => { 
		    	if (!error && result && result.event === "success") { 
		      		//alert("hell Success!");
		      		console.log(result.info.public_id);
		    	}

		  	}
		)

		document.getElementById("upload_widget").addEventListener("click", function(){
		    myWidget.open();
		  }, false);
	</script>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>