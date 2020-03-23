<?php
	session_start();
	require 'connection.php';

	$isNotDone = false;
	$isNotRagu = false;
	$currentidx = $_SESSION['soal_idx'];
	$user = $_SESSION['userid'];
	$paket = $_SESSION['id_paket'];
	for ($i=0; $i < count($_SESSION['soal']); $i++) {

		$soal_id_database = $_SESSION['soal'][$i]['id'];
		$check_answerSQL = "SELECT * FROM jawaban_masuk WHERE userid='$user' AND soal='$soal_id_database' AND paket='$paket';";
		$check_answerRES = mysqli_query($connection, $check_answerSQL);
		$check_answerROW = mysqli_num_rows($check_answerRES);
		$check_answerFET = mysqli_fetch_assoc($check_answerRES);
		if ($check_answerFET['ragu'] == 1) {
			// ragu-ragu
			// echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-warning sendTimer">'.($i+1).'</button>&nbsp';
			$isNotRagu = true;
		} else if (!($check_answerROW == 1 && $check_answerFET['jawaban'] != "")) {
			// not answered default button style
			// echo '<button type="submit" name="new_soal_idx" value="'.$i.'" class="btn btn-outline-secondary sendTimer">'.($i+1).'</button>&nbsp';
			$isNotDone = true;
		}
	}
	if (!$isNotDone && (!$isNotRagu)) {
		echo "1";
	} else if (!$isNotDone && $isNotRagu) {
		echo "2";
	} else {
		echo "0"; 
	}