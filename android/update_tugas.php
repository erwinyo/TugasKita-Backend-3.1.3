<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$tugasid = mysqli_real_escape_string($connection, $_POST['tugasid']);
		$newnamatugas = mysqli_real_escape_string($connection, $_POST['newnamatugas']);
		$newmatapelajarantugas = mysqli_real_escape_string($connection, $_POST['newmatapelajarantugas']);
		$newwaktutugas = mysqli_real_escape_string($connection, $_POST['newwaktutugas']);
		$newceritatugas = mysqli_real_escape_string($connection, $_POST['newceritatugas']);
		$newprioritastugas = mysqli_real_escape_string($connection, $_POST['newprioritastugas']);
		
		$SQL = "UPDATE tugas SET tugas_nama='$newnamatugas', tugas_pelajaran='$newmatapelajarantugas', tugas_waktu='$newwaktutugas', tugas_prioritas='$newprioritastugas', tugas_cerita='$newceritatugas' WHERE tugas_id='$tugasid';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$ind['success'] = "1";
			$ind['message'] = "Successfully Updated";
			echo json_encode($ind);
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