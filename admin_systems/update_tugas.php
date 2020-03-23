<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$tugasid = mysqli_real_escape_string($connection, $_POST['tugasid']);
		$tugasnama = mysqli_real_escape_string($connection, $_POST['tugasnama']);
		$tugaspelajaran = mysqli_real_escape_string($connection, $_POST['tugaspelajaran']);
		$tugaswaktu = mysqli_real_escape_string($connection, $_POST['tugaswaktu']);
		$tugaswaktuArray = explode("-", $tugaswaktu);
		$tugaswaktu = $tugaswaktuArray[2]."-".$tugaswaktuArray[1]."-".$tugaswaktuArray[0];
		$tugascerita = mysqli_real_escape_string($connection, $_POST['tugascerita']);
		$tugasprioritas = mysqli_real_escape_string($connection, $_POST['tugasprioritas']);
		
		$SQL = "UPDATE tugas SET tugas_nama='$tugasnama', tugas_pelajaran='$tugaspelajaran', tugas_waktu='$tugaswaktu', tugas_prioritas='$tugasprioritas', tugas_cerita='$tugascerita' WHERE tugas_id='$tugasid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "Successfully Updated";
			header("Location: load_tugas");
			mysqli_close($connection);
			exit();
		} else {
			$ind['success'] = "0";
			$ind['message'] = "Failed Updated";
			echo json_encode($ind);
			mysqli_close($connection);
			exit();
		}
	}

	