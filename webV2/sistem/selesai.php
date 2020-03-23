<?php
	session_start();
	require 'connection.php';
	$user = $_SESSION['userid'];
	$paket = $_SESSION['id_paket'];
	$sekolah = $_SESSION['sekolah_paket'];
	$butir = $_SESSION['butir_paket'];
	$nilaiPerSoal = 100/intval($butir);
	# Bersihkan session
	unset($_SESSION['soal']);
	unset($_SESSION['soal_idx']);

	$benar = 0;
	$salah = 0;

	# MENENTUKAN JAWABAN YANG SALAH DAN BENAR
	$S_SQL = "SELECT * FROM soal WHERE paket='$paket' AND sekolah='$sekolah';";
	$S_RES = mysqli_query($connection, $S_SQL);
	while ($S_FET = mysqli_fetch_assoc($S_RES)) {
		$S_ID = $S_FET['id'];
		$S_JAWABAN = $S_FET['benar'];

		$JM_SQL = "SELECT * FROM jawaban_masuk WHERE userid='$user' AND paket='$paket' AND sekolah='$sekolah';";
		$JM_RES = mysqli_query($connection, $JM_SQL);
		while ($JM_FET = mysqli_fetch_assoc($JM_RES)) {
			$JM_ID = $JM_FET['soal'];
			$JM_JAWABAN = $JM_FET['jawaban'];

			if ($S_ID == $JM_ID && $S_JAWABAN == $JM_JAWABAN) {
				# Jawaban benar
				$benar++;
				break;
			} else if ($S_ID == $JM_ID && $S_JAWABAN != $JM_JAWABAN) {
				# Jawaban salah
				$salah++;
				break;
			}
		}
	}

	$nilai = strval($benar*$nilaiPerSoal);
	$_SESSION['nilai'] = $nilai;
	$benar = strval($benar);
	$salah = strval($salah);
	$SQL = "UPDATE user_paket SET status='COMPLETE', benar='$benar', salah='$salah', nilai='$nilai' WHERE user_id='$user' AND paket_id='$paket' AND sekolah_id='$sekolah';";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		header("Location: ../cbt-insight?user=".$user."&paket=".$paket);
		exit();
	} else {
		echo mysqli_error($connection);
	}
?>