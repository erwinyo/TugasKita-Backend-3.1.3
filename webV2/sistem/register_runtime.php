<?php
	session_start();
	require 'connection.php';

	$userid = $_SESSION['userid'];
	$sekolah = $_SESSION['sekolah_paket'];
	$soal = mysqli_real_escape_string($connection, $_POST['soal']);
	$paket = $_SESSION['paket'];
	$time_spend = mysqli_real_escape_string($connection, $_POST['time_spend']);

	$SQL = "SELECT * FROM user_soal WHERE user='$userid' AND paket='$paket' AND soal='$soal' AND sekolah='$sekolah';";
	$RES = mysqli_query($connection, $SQL);
	$ROW = mysqli_num_rows($RES);
	if ($ROW == 1) {
		// get data from db
		$FET = mysqli_fetch_assoc($RES);
		$db_time_spend = $FET['time_spend'];

		$new_time_spend = intval($db_time_spend) + intval($time_spend);
		$US_SQL = "UPDATE user_soal SET time_spend='$new_time_spend';";
		mysqli_query($connection, $US_SQL);
	} else {
		$id = uniqid();
		$US_SQL = "INSERT INTO user_soal(id, user, paket, sekolah, soal, time_spend) VALUES('$id', '$userid', '$paket', '$sekolah', '$soal', '$time_spend');";
		mysqli_query($connection, $US_SQL);
	}