<?php
	session_start();
	require 'connection.php';
	
	$user = $_SESSION['userid'];
	$soal = $_SESSION['soalid'];
	$paket = $_SESSION['id_paket'];
	$sekolah = $_SESSION['sekolah_paket'];
	$answer = mysqli_real_escape_string($connection, $_GET['q']);
	$type = mysqli_real_escape_string($connection, $_GET['type']);

	// USER_SOAL SISTEM
	if ($type == "timer") {
		// check user_soal
		$SQL = "SELECT * FROM user_soal WHERE user='$user' AND soal='$soal' AND paket='$paket' AND sekolah='$sekolah';";
		$RES = mysqli_query($connection, $SQL);
		$ROW = mysqli_num_rows($RES);
		if ($ROW == 1) {
			// get the latest data from database
			$FET = mysqli_fetch_assoc($RES);
			$db_time_spend = $FET['time_spend'];

			$newest_time_spend = intval($db_time_spend) + intval($answer);
			$UPDATE_SQL = "UPDATE user_soal SET time_spend='$newest_time_spend' WHERE user='$user' AND soal='$soal' AND paket='$paket' AND sekolah='$sekolah';";
			mysqli_query($connection, $UPDATE_SQL);
		} else {
			$id = uniqid();
			$INSERT_SQL = "INSERT INTO user_soal (id, user, paket, sekolah, soal, time_spend) VALUES ('$id', '$user', '$paket', '$sekolah', '$soal', '$answer');";
			mysqli_query($connection, $INSERT_SQL);
		}
	} else {
		// JAWABAN MASUK SISTEM
		// check jawaban_masuk
		$SQL = "SELECT * FROM jawaban_masuk WHERE userid='$user' AND soal='$soal' AND paket='$paket';";
		$RES = mysqli_query($connection, $SQL);
		$ROW = mysqli_num_rows($RES);

		if ($ROW == 1) {
			// check the type
			if ($type == "ragu") {
				$UPDATE_SQL = "UPDATE jawaban_masuk SET ragu='$answer' WHERE userid='$user' AND soal='$soal' AND paket='$paket';";
				mysqli_query($connection, $UPDATE_SQL);
			} else if ($type == "jawaban") {
				$UPDATE_SQL = "UPDATE jawaban_masuk SET jawaban='$answer' WHERE userid='$user' AND soal='$soal' AND paket='$paket';";
				mysqli_query($connection, $UPDATE_SQL);
			}
		} else {
			$id = uniqid();
			// check the type
			if ($type == "ragu") {
				$INSERT_SQL = "INSERT INTO jawaban_masuk (id, userid, soal, sekolah, paket, ragu) VALUES ('$id', '$user', '$soal', '$sekolah', '$paket', '$answer');";
				mysqli_query($connection, $INSERT_SQL);
			} else if ($type == "jawaban") {
				$INSERT_SQL = "INSERT INTO jawaban_masuk (id, userid, soal, sekolah, paket, jawaban) VALUES ('$id', '$user', '$soal', '$sekolah', '$paket', '$answer');";
				mysqli_query($connection, $INSERT_SQL);
			}
			
		}
	}