<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);
		$newNamaGrup = mysqli_real_escape_string($connection, $_POST['newNamaGrup']);
		$newCeritaGrup = mysqli_real_escape_string($connection, $_POST['newCeritaGrup']);
		$newGrupAvatar = mysqli_real_escape_string($connection, $_POST['newAvatarGrup']);

		if ($newGrupAvatar == "") {
			$SQL = "UPDATE grup SET grup_nama='$newNamaGrup', grup_cerita='$newCeritaGrup' WHERE grup_id='$grupid';";
			$list['upload'] = "0";
		} else {
			$SQL = "UPDATE grup SET grup_nama='$newNamaGrup', grup_cerita='$newCeritaGrup', grup_avatar='$newGrupAvatar' WHERE grup_id='$grupid';";
			$list['upload'] = "1";
		}

		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			$list['success'] = "1";
			$list['message'] = "Successfully Changed!";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		} else {
			$list['success'] = "0";
			$list['message'] = "Failed Changed!";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		}
	}