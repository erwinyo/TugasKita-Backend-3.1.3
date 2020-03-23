<?php
	require 'connection.php';

	$key = mysqli_real_escape_string($connection, $_POST['key']);
	$paket = mysqli_real_escape_string($connection, $_POST['paket']);
	$sekolah = mysqli_real_escape_string($connection, $_POST['sekolah']);
	$type = mysqli_real_escape_string($connection, $_POST['type']);

	if ($type == "0") {
		$SQL = "UPDATE paket SET kunci='$key' WHERE id='$paket' AND sekolah='$sekolah';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			header("Location: ../sekolah/paket");
			exit();
		} else {
			echo "Terjadi kesalahan saat publikasi paket";
			exit();
		}
	} else if ($type == "1") {
		$SQL = "UPDATE paket SET kunci='' WHERE id='$paket' AND sekolah='$sekolah';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			header("Location: ../sekolah/paket");
			exit();
		} else {
			echo "Terjadi kesalahan saat menghentikan publikasi paket";
			exit();
		}
	}