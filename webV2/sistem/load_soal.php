<?php
	session_start();
	require 'connection.php';

	$sekolah = $_SESSION['id_sekolah'];
	$paket = $_SESSION['id_paket'];

	$P_SQL = "SELECT * FROM paket WHERE id='$paket' AND sekolah='$sekolah';";
	$P_RES = mysqli_query($connection, $P_SQL);
	$P_ROW = mysqli_num_rows($P_RES);
	if ($P_ROW == 1) {
		$P_FET = mysqli_fetch_assoc($P_RES);

		$paket = $P_FET['id'];
		$S_SQL = "SELECT * FROM soal WHERE paket='$paket';";
		$S_RES = mysqli_query($connection, $S_SQL);
		$_SESSION['soal'] = array();
		$i = 0;
		while ($S_FET = mysqli_fetch_assoc($S_RES)) {
			$_SESSION['soal'][$i] = $S_FET;
			$i++;
		}
		shuffle($_SESSION['soal']); // Randomize Array Place Index

		mysqli_close($connection);
		$_SESSION['soal_idx'] = 0;
		header("Location: ../cbt-run");
		exit();
	} else {
		header("Location: ../cbt-error?err=Paket%20belum%20memiliki%soal");
		exit();
	}
