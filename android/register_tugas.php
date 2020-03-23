<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$tugasnama = mysqli_real_escape_string($connection, $_POST['tugasnama']);
		$tugaspelajaran = mysqli_real_escape_string($connection, $_POST['tugaspelajaran']);
		$tugaswaktu = mysqli_real_escape_string($connection, $_POST['tugaswaktu']);
		$tugasprioritas = mysqli_real_escape_string($connection, $_POST['tugasprioritas']);
		$tugascerita = mysqli_real_escape_string($connection, $_POST['tugascerita']);
		$tugasposisi = mysqli_real_escape_string($connection, $_POST['tugasposisi']);
		$tugasid = uniqid();
		$SQL = "INSERT INTO tugas (tugas_id, tugas_nama, tugas_pelajaran, tugas_waktu, tugas_prioritas, tugas_author_id, tugas_posisi, tugas_cerita) VALUES ('$tugasid', '$tugasnama', '$tugaspelajaran', '$tugaswaktu', '$tugasprioritas', '$userid', '$tugasposisi', '$tugascerita');";
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
		
			echo json_encode($index);
			mysqli_close($connection);	
			exit();	
		} else {
			$index['success'] = "1";
			$index['message'] = "Failed! Error Creating...";
			echo json_encode($index);
			mysqli_close($connection);	
			exit();
		}
	}