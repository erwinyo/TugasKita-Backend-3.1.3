<?php
	require 'connection.php';

	if (isset($_POST['submit'])) {
		$judul = mysqli_real_escape_string($connection, $_POST['judul']);
		$isi = mysqli_real_escape_string($connection, $_POST['isi']);
		$waktu = formatDateStripe(mysqli_real_escape_string($connection, $_POST['waktu']));
		$id = uniqid();

		$SQL = "INSERT INTO tugaskita(id, waktu, judul, isi) VALUES('$id', '$waktu', '$judul', '$isi');";
		$RES =  mysqli_query($connection, $SQL);

		if ($RES) {
			header("Location: admin");
			echo "success";
			exit();
		} else {
			echo "Error";
			exit();
		}
	}

	function formatDateStripe($date) {
		$arr = explode("-", $date);
		$day = $arr[2];
		$month = $arr[1];
		$year = $arr[0];
		return $day."-".$month."-".$year;
	}