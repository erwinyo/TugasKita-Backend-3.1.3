<?php
	require 'connection.php';

	if ($_SERVER['REQUEST_METHOD']=='GET') {
		$sekolah = mysqli_real_escape_string($connection, $_GET['sekolah']);
		$paket = mysqli_real_escape_string($connection, $_GET['paket']);
		$public = mysqli_real_escape_string($connection, $_GET['public']);
	} else {
		$sekolah = mysqli_real_escape_string($connection, $_POST['sekolah']);
		$paket = mysqli_real_escape_string($connection, $_POST['paket']);
		$public = mysqli_real_escape_string($connection, $_POST['public']);
	}

	if ($public == "1") {
		$P_SQL = "UPDATE paket SET aktif='1' WHERE id='$paket' AND sekolah='$sekolah';";
	} else {
		$P_SQL = "UPDATE paket SET aktif='0' WHERE id='$paket' AND sekolah='$sekolah';";
	}
	$P_RES = mysqli_query($connection, $P_SQL);
	if ($P_RES) {
		echo "1";
		exit();
	} else {
		echo "Terjadi Kesalahan!";
		exit();
	}