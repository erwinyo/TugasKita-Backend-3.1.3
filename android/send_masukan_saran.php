<?php
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$from = mysqli_real_escape_string($connection, $_POST['from']);
		$content = mysqli_real_escape_string($connection, $_POST['content']);
		$result = array();
		# INSERT DATA BASE
		$SQL = "INSERT INTO masukan_saran (dari, isi) VALUES ('$from', '$content');";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$result['success'] = "1";
			$result['message'] = "Pesan Terkirim";
			echo json_encode($result);
			mysqli_close($connection);
			exit();
		} else {
			$result['success'] = "0";
			$result['message'] = "Pesan Tidak Terkirim";
			echo json_encode($result);
			mysqli_close($connection);
			exit();
		}
	}