<?php
	require '../connection.php';

	$SQL = "SELECT * FROM news";
	$RES = mysqli_query($connection, $SQL);

	$data = array();
	$data['news'] = array();

	$howmuch = 0;

	if ($RES) {
		$row = mysqli_num_rows($RES);
		while ($FET = mysqli_fetch_assoc($RES)) {
			if ($howmuch < 5) {

				$random = rand(0, $row);
				if ($random > $row/2) {
					$ind['news_id'] = $FET['news_id'];
					$ind['news_title'] = $FET['news_title'];
					$ind['news_content'] = $FET['news_content'];
					$ind['news_date'] = $FET['news_date'];
					$ind['news_modified'] = $FET['news_modified'];
					$ind['news_author'] = $FET['news_author'];
					$ind['news_image'] = $FET['news_image'];
					$ind['news_source'] = $FET['news_source'];
					array_push($data['news'], $ind);
					$howmuch++;
				}
			}
		}
		$data['success'] = "1";
		$data['message'] = "Success to load news";
		mysqli_close($connection);
		echo json_encode($data);
		exit();
	} else {
		$data['success'] = "0";
		$data['message'] = "Failed to load news";
		mysqli_close($connection);
		echo json_encode($data);
		exit();
	}