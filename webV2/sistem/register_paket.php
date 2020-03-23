<?php
	session_start();
	require 'connection.php';
	$nama = mysqli_real_escape_string($connection, $_POST['nama']);
	$sekolah = mysqli_real_escape_string($connection, $_POST['sekolah']);
	$pilgan = mysqli_real_escape_string($connection, $_POST['pilgan']);
	$uraian = mysqli_real_escape_string($connection, $_POST['uraian']);
	$waktu = mysqli_real_escape_string($connection, $_POST['waktu']);
	$butir = strval(intval($pilgan)+intval($uraian));

	$id = "";
	for ($i=0; $i < 4; $i++) { 
		$id = $id.strval(mt_rand(0, 9));
	}

	$soal = "";
	for ($i=0; $i < intval($butir); $i++) { 
		$length = 21;
		$id2 = bin2hex(openssl_random_pseudo_bytes($length));
		# cek buat id akhir agar tidak ditambahi koma belakangnya
		if ($i == intval($butir)-1) {
			$soal = $soal.$id2;
		} else {
			$soal = $soal.$id2.",";
		}
	}

	$SQL = "INSERT INTO paket(id, nama, sekolah, butir, pilihan_ganda, uraian, waktu, soal) VALUES('$id', '$nama', '$sekolah', '$butir', '$pilgan', '$uraian', '$waktu', '$soal');";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		# SESSION CATCHER
		$_SESSION['upload_id'] = $id;
		$_SESSION['upload_nama'] = $nama;
		$_SESSION['upload_sekolah'] = $sekolah;
		$_SESSION['upload_pilgan'] = $pilgan;
		$_SESSION['upload_uraian'] = $uraian;
		$_SESSION['upload_waktu'] = $waktu;
		$_SESSION['upload_butir'] = $butir;
		$_SESSION['upload_soal'] = $soal;
		$_SESSION['upload_soal_array'] = explode(",", $soal);
		$_SESSION['upload_soal_array_index'] = 0;
		echo "1";
		mysqli_close($connection);
		exit();
	} else {
		echo mysqli_error($connection);
		mysqli_close($connection);
		exit();
	}