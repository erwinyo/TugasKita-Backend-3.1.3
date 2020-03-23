<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_56/v1571068816/tugaskita/assets/ico.png" />
  	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Forgot Password | TugasKita</title>
    <style type="text/css">
    	h1, .h1 {
    		font-family: 'Asap', sans-serif;
    	}
    	p, input {
    		font-family: 'Nunito', sans-serif;
    	}
    </style>
</head>
<body>
	<div class="container"><br>
		<h1><img src="https://res.cloudinary.com/dizwvnwu0/image/upload/c_scale,w_100/v1571068816/tugaskita/assets/ico.png" width="70"> TugasKita</h1><br>
		<h3>Forgot Password</h3>
		<p>Tolong ketik alamat email Anda. Kami akan mengirimkan email perubahan password baru kepada Anda.</p>
		<form action="sistem/send_email_reset_password" method="POST">
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="alamat email Anda" required>
			</div>
			<button class="btn btn-primary" type="submit" name="submit">SEND</button>
		</form>
	</div>
</body>
</html>