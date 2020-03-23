<?php
	require 'connection.php';

	$sekolah = mysqli_real_escape_string($connection, $_POST['sekolah']);
	$paket = mysqli_real_escape_string($connection, $_POST['paket']);

	$P_SQL = "SELECT * FROM paket WHERE id='$paket' AND sekolah='$sekolah';";
	$P_RES = mysqli_query($connection, $P_SQL);
	$P_ROW = mysqli_num_rows($P_RES);
	if ($P_ROW == 1) {
		$P_FET = mysqli_fetch_assoc($P_RES);
		$P_SOAL = explode(",", $P_FET['soal']);
		// ambil data dari database 'soal'
		$S_SQL = "SELECT * FROM soal WHERE paket='$paket';";
		$S_RES = mysqli_query($connection, $S_SQL);
		$S_ROW = mysqli_num_rows($S_RES);

		// cek baris dan jumlah kolom 'soal' yang dipilih
		if ($S_ROW == count($P_SOAL)) {
			echo "1";
			exit();
		} else {
			echo "0";
			exit();
		}
	} else {
		echo "Terjadi Kesalahan!";
		exit();
	}
	

