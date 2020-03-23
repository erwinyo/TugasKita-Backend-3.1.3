<?php
	session_start();
	require 'connection.php';

	$nama = mysqli_real_escape_string($connection, $_POST['nama']);
	$alamat = mysqli_real_escape_string($connection, $_POST['alamat']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	$id = uniqid();
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$SQL = "INSERT INTO sekolah(id, nama, alamat, email, password) VALUES('$id', '$nama', '$alamat', '$email', '$hashedPassword');";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		echo "Successfully registered to database!";
		exit();
	} else {
		echo "Error saat mendaftarkan!";
		exit();
	}