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
	$formatTime = str_pad($date, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".str_pad($year, 4, "0", STR_PAD_LEFT);
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = "SMAK STELLA MARIS";
		$tugasnama = mysqli_real_escape_string($connection, $_POST['tugasnama']);
		$tugaspelajaran = mysqli_real_escape_string($connection, $_POST['tugaspelajaran']);
		$tugasdibuat = $formatTime;
		$tugaswaktu = mysqli_real_escape_string($connection, $_POST['tugaswaktu']);
		$tugaswaktuArray = explode("-", $tugaswaktu);
		$tugaswaktu = $tugaswaktuArray[2]."-".$tugaswaktuArray[1]."-".$tugaswaktuArray[0];
		$tugasprioritas = mysqli_real_escape_string($connection, $_POST['tugasprioritas']);
		$tugascerita = mysqli_real_escape_string($connection, $_POST['tugascerita']);
		$tugasposisi = mysqli_real_escape_string($connection, $_POST['tugaslokasi']);
		$tugasid = uniqid();
		$SQL = "INSERT INTO tugas (tugas_id, tugas_nama, tugas_pelajaran, tugas_dibuat, tugas_waktu, tugas_prioritas, tugas_author_id, tugas_posisi, tugas_cerita) VALUES ('$tugasid', '$tugasnama', '$tugaspelajaran', '$tugasdibuat', '$tugaswaktu', '$tugasprioritas', '$userid', '$tugasposisi', '$tugascerita');";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$index['success'] = "1";
			$index['message'] = "Success! Tugas has been added...";
			# UPDATE grup_total - akumulasi tugas
			$get_akumulasi_tugas_SQL = "SELECT * FROM grup WHERE grup_id='$tugasposisi';";
			$get_akumulasi_tugas_RES = mysqli_query($connection, $get_akumulasi_tugas_SQL);
			$get_akumulasi_tugas_FET = mysqli_fetch_assoc($get_akumulasi_tugas_RES);
			$akumulasi_tugas_database = $get_akumulasi_tugas_FET['grup_total'];

			$updated = $akumulasi_tugas_database + 1;
			$update_akumulasi_tugas_SQL = "UPDATE grup SET grup_total = '$updated' WHERE grup_id='$tugasposisi';";
			$update_akumulasi_tugas_RES = mysqli_query($connection, $update_akumulasi_tugas_SQL);
		
			$_SESSION['tambah_tugas_status'] = $index;
			mysqli_close($connection);	
			header("Location: load_tugas");
			exit();	
		} else {
			$index['success'] = "1";
			$index['message'] = "Failed! Error Creating...";
			$_SESSION['tambah_tugas_status'] = $index;
			mysqli_close($connection);	
			header("Location: ../dashboard");
			exit();
		}
	}