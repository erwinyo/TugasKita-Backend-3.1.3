<?php
	session_start();
	require 'connection.php';

	$SQL = "SELECT * FROM information";
	$RES = mysqli_query($connection, $SQL);

	while ($FET = mysqli_fetch_assoc($RES)) {
		$active = $FET['active'];
		$nama = $FET['nama'];
		$pesan = $FET['pesan'];
		$id = $FET['id'];
		$version = $FET['version'];
		$versioncode = $FET['versioncode'];

		if ($active != 0) {
			$ind['success'] = "1";
			$ind['message'] = $pesan;
			$ind['nama'] = $nama;
			$ind['id'] = $id;
			$ind['version'] = $version;
			$ind['versioncode'] = $versioncode;
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		} 
	}

	$ind['success'] = "0";
	$ind['message'] = "Welcome to TugasKita";
	echo json_encode($ind);
	mysqli_close($connection);
	exit();