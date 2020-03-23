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

	<title>ADMIN</title>
	<link rel="shortcut icon" href="../web/images/logo.ico" />

	<script type="text/javascript">
		var image_upload = "";
	</script>
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

	<div class="container">
		<br><br><br>
		<h3>Powerful Article System</h3>
		<p class="h6 text-danger">Peringatan keras jika kalian masuk segera keluar!</p>
		<br>
		<div class="form-group row">
    		<label for="judul" class="col-sm-2 col-form-label h6">Upload Image</label>
    		<div class="col-sm-10">
      			<button id="upload_widget" class="cloudinary-button">Cloudinary Upload</button><br>
      			<label class="h6" id="status_image_upload"></label>
    		</div>
  		</div>
		<br><br>
		<form action="admin_systems/send_news.php" method="POST">
			<input type="hidden" name="images" id="images">
  			<div class="form-group row">
    			<label for="judul" class="col-sm-2 col-form-label h6">Judul</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="title" id="judul" placeholder="Ketik disini / copy-paste" required>
      				<label class="h6"><span class="text-danger">Remember!</span> Words Capitalize</label>
    			</div>
  			</div>
  			<div class="form-group row">
    			<label for="lokasi" class="col-sm-2 col-form-label h6">Lokasi</label>
    			<div class="col-sm-10">
      				<input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="cth.Gedung IDX, Istana Presiden,..." required>
    			</div>
  			</div>
  			<br><hr><br>
	  		<div class="form-group row">
	    		<label for="paragraph1" class="col-sm-2 col-form-label h6">Paragraph 1</label>
	    		<div class="col-sm-10">
	      			<textarea class="form-control" name="paragraph1" id="paragraph1" placeholder="Ketik disini / copy-paste" rows="6" required></textarea>
	    		</div>
	  		</div>
	  		<div class="form-group row">
	    		<label for="paragraph2" class="col-sm-2 col-form-label h6">Paragraph 2</label>
	    		<div class="col-sm-10">
	      			<textarea class="form-control" name="paragraph2" id="paragraph2" placeholder="Ketik disini / copy-paste" rows="6" required></textarea>
	    		</div>
	  		</div>
	  		<div class="form-group row">
	    		<label for="paragraph3" class="col-sm-2 col-form-label h6">Paragraph 3</label>
	    		<div class="col-sm-10">
	      			<textarea class="form-control" name="paragraph3" id="paragraph3" placeholder="Ketik disini / copy-paste" rows="6" required></textarea>
	    		</div>
	  		</div>
	  		<div class="form-group row">
	    		<label for="paragraph4" class="col-sm-2 col-form-label h6">Paragraph 4</label>
	    		<div class="col-sm-10">
	      			<textarea class="form-control" name="paragraph4" id="paragraph4" placeholder="Ketik disini / copy-paste" rows="6" required></textarea>
	    		</div>
	  		</div>
	  		<div class="form-group row">
	    		<label for="paragraph5" class="col-sm-2 col-form-label h6">Paragraph 5</label>
	    		<div class="col-sm-10">
	      			<textarea class="form-control" name="paragraph5" id="paragraph5" placeholder="Ketik disini / copy-paste" rows="6" required></textarea>
	    		</div>
	  		</div>
	  		<br><br><br>
	  		<fieldset class="form-group">
		    	<div class="row">
		      		<legend class="col-form-label col-sm-2 pt-0 h6">TAG</legend>
		      		<div class="col-sm-4">
		        		<div class="form-check">
			          		<input class="form-check-input" type="radio" name="tag" id="nasional" value="NASIONAL" checked>
			          		<label class="form-check-label" for="nasional">NASIONAL</label>
		        		</div>
		        		<div class="form-check">
			          		<input class="form-check-input" type="radio" name="tag" id="ekonomi" value="EKONOMI">
			          		<label class="form-check-label" for="ekonomi">EKONOMI</label>
		        		</div>
		        		<div class="form-check disabled">
			          		<input class="form-check-input" type="radio" name="tag" id="internasional" value="INTERNASIONAL">
			          		<label class="form-check-label" for="internasional">INTERNASIONAL</label>
		        		</div>
		        		<div class="form-check">
			          		<input class="form-check-input" type="radio" name="tag" id="olahRaga" value="OLAH RAGA">
			          		<label class="form-check-label" for="olahRaga">OLAH RAGA</label>
		        		</div>
		        		
		      		</div>
		      		<div class="col-sm-6">
		      			<div class="form-check">
			          		<input class="form-check-input" type="radio" name="tag" id="teknologi" value="TEKNOLOGI">
			          		<label class="form-check-label" for="teknologi">TEKNOLOGI</label>
		        		</div>
		        		<div class="form-check">
			          		<input class="form-check-input" type="radio" name="tag" id="hiburan" value="HIBURAN">
			          		<label class="form-check-label" for="hiburan">HIBURAN</label>
		        		</div>
		        		<div class="form-check">
			          		<input class="form-check-input" type="radio" name="tag" id="gayaHidup" value="GAYA HIDUP">
			          		<label class="form-check-label" for="gayaHidup">GAYA HIDUP</label>
		        		</div>
		      		</div>
		    	</div>
		  	</fieldset>
		  	<br><br>
			<button class="btn btn-success btn-lg btn-block" type="submit" name="submit">UPLOAD AND NEXT</button>
		</form>
		<br><br>
	</div>


	<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>

	<script type="text/javascript">
		var myWidget = cloudinary.createUploadWidget({
		  	cloudName: 'dizwvnwu0', 
		  	uploadPreset: 'tugaskita_news'}, (error, result) => { 
		    	if (!error && result && result.event === "success") { 
		    		var array_public_id = result.info.public_id.split("/");
		      		image_upload += array_public_id[array_public_id.length-1] + ",";

		      		document.getElementById("status_image_upload").innerHTML = image_upload;
		      		document.getElementById("images").setAttribute("value", image_upload);
		    	}
		    	if (!error && result && result.event === "queues-end") {
		      		alert("Everything Done!");
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