<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>ADMIN</title>
	<link rel="shortcut icon" href="web/images/logo.ico" />
</head>
<body>

	<div class="container">
		<br><br><br>
		<h3>Powerful Messaging System</h3>
		<p>ID generate automatically</p>
		<form method="POST" action="admin_systems/messaging.sys.php">
			<div class="form-group">
				<input type="text" class="form-control" name="judul" placeholder="Judul" required>
			</div>
			<div class="form-group">
				<input type="date" class="form-control" name="waktu" placeholder="Waktu" required>
			</div>
			<div class="form-group">
				<textarea class="form-control" name="isi" rows="5" cols="20" placeholder="Isi"></textarea>
			</div>
			<button class="btn btn-primary" name="submit" type="submit">Send To All Users</button>
		</form>

		<br><br><br><br>

		<table class="table">
			<thead>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</thead>
			<tbody>
				<td></td>
				<td></td>
				<td></td>
			</tbody>
		</table>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>