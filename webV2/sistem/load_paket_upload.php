<?php
	session_start();
	require 'connection.php';

	$sekolah = mysqli_real_escape_string($connection, $_GET['sekolah']);
	$paket = mysqli_real_escape_string($connection, $_GET['paket']);
	$key = mysqli_real_escape_string($connection, $_GET['key']);

	$_SESSION['key'] = $key;

	$SQL = "SELECT * FROM paket WHERE id='$paket' AND sekolah='$sekolah';";
	$RES = mysqli_query($connection, $SQL);
	$FET = mysqli_fetch_assoc($RES);

	$id = $FET['id'];
	$nama = $FET['nama'];
	$sekolah = $FET['sekolah'];
	$pilgan = $FET['pilihan_ganda'];
	$uraian = $FET['uraian'];
	$waktu = $FET['waktu'];
	$butir = $FET['butir'];
	$soal = $FET['soal'];

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

	header("Location: ../cbt-upload-soal");
	exit();