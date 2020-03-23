<?php
	session_start();
	require 'connection.php';
	date_default_timezone_set('Asia/Jakarta');
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$current = $date."-".$month."-".$year."~".$hour.":".$min.":".$sec;
	
	$sekolah = mysqli_real_escape_string($connection, $_POST['sekolah']);
	$token = mysqli_real_escape_string($connection, $_POST['token']);

	$SQL = "SELECT * FROM paket WHERE sekolah='$sekolah' AND id='$token';";
	$RES = mysqli_query($connection, $SQL);
	$ROW = mysqli_num_rows($RES);

	if ($ROW > 0) {
		$FET = mysqli_fetch_assoc($RES);
		$id = $FET['id'];
		$nama = $FET['nama'];
		$pembuat = $FET['pembuat'];
		$sekolah = $FET['sekolah'];
		$butir = $FET['butir'];
		$pilgan = $FET['pilihan_ganda'];
		$uraian = $FET['uraian'];
		$aktif = $FET['aktif'];
		$waktu = $FET['waktu'];
		$kunci = $FET['kunci'];

		$userid = $_SESSION['userid']; // userid
		$UP_SQL_CHECK = "SELECT * FROM user_paket WHERE user_id='$userid' AND paket_id='$id' AND sekolah_id='$sekolah';";
		$UP_RES_CHECK = mysqli_query($connection, $UP_SQL_CHECK);
		$UP_ROW_CHECK = mysqli_num_rows($UP_RES_CHECK);

		if ($UP_ROW_CHECK == 1) {
			$UP_FET_CHECK = mysqli_fetch_assoc($UP_RES_CHECK); // get status data from user_paket database
			$_SESSION['status_user_paket'] = $UP_FET_CHECK['status'];
			$_SESSION['masuk_user_paket'] = $UP_FET_CHECK['masuk'];
			
			// Update cuurent time to database
		 	$UP_SQL = "UPDATE user_paket SET waktu='$current';";
			mysqli_query($connection, $UP_SQL);
		} else {
			$_SESSION['status_user_paket'] = 'INCOMPLETE';
			$_SESSION['masuk_user_paket'] = $current;
			// Insert new riwayat ujian
			$UP_SQL = "INSERT INTO user_paket(user_id, paket_id, sekolah_id, waktu, masuk, status) VALUES('$userid', '$id', '$sekolah', '$current', '$current', 'INCOMPLETE');";
			mysqli_query($connection, $UP_SQL);
		} 

		// Store All info about PAKET
		$_SESSION['id_paket'] = $id;
		$_SESSION['nama_paket'] = $nama;
		$_SESSION['pembuat_paket'] = $pembuat;
		$_SESSION['sekolah_paket'] = $sekolah;
		$_SESSION['butir_paket'] = $butir;
		$_SESSION['pilgan_paket'] = $pilgan;
		$_SESSION['uraian_paket'] = $uraian;
		$_SESSION['aktif_paket'] = $aktif;
		$_SESSION['waktu_paket'] = $waktu;
		$_SESSION['kunci_paket'] = $kunci;
		// Store ID sekolah
		$_SESSION['id_sekolah'] = $sekolah;

		$akunSQL = "SELECT * FROM akun WHERE user_id='$pembuat';";
		$akunRES = mysqli_query($connection, $akunSQL);
		$akunFET = mysqli_fetch_assoc($akunRES);
		$_SESSION['pembuat_paket_nama'] = $akunFET['user_namalengkap'];

		header("Location: ../cbt-dashboard");
		exit();
	} else {
		$_SESSION['cbt-error'] = "Paket Soal tidak Ditemukan!";
		header("Location: ../cbt-error?err=Paket Soal tidak Ditemukan!");
		exit();
	}