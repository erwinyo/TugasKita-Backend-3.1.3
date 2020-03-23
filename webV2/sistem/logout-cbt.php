<?php
	session_start();
	unset($_SESSION['id_paket']);
	unset($_SESSION['nama_paket']);
	unset($_SESSION['pembuat_paket']);
	unset($_SESSION['sekolah_paket']);
	unset($_SESSION['butir_paket']);
	unset($_SESSION['pilgan_paket']);
	unset($_SESSION['uraian_paket']);
	unset($_SESSION['aktif_paket']);
	unset($_SESSION['waktu_paket']);
	unset($_SESSION['id_sekolah']);
	
	// echo $_SESSION['userid'];
	header("Location: ../cbt-start");
	exit();