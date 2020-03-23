<?php
	require 'sistem/connection.php';
	$email = mysqli_real_escape_string($connection, $_GET['email']);	
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Change Password</title>
</head>
<body>

	<div class="container">
		<br>
		<h4>Change Password</h4>
		<p>Perhatikan huruf besar dan kecil sebagai pengganti password lama. Pastikan semua terkeetik secara benar.</p>
		<br>
		<form action="sistem/change_password.php" method="POST"> 
			<div class="form-group">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="password" name="newpassword" placeholder="New Password" class="form-control">
			</div>
			<button class="btn btn-primary" type="submit" name="submit">Submit</button>
		</form>
		<br><br>
		<small>security by <b>TugasKita Indonesia</b></small>
	</div>


	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</body>
</html>