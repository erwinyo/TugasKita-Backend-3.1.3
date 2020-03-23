<?php
	session_start();
	require 'connection.php';

	$email = $_SESSION['useremail'];
	$namapaket = $_SESSION['nama_paket'];
	$nilai = $_SESSION['nilai'];

	if (isset($_POST['bintang'])) {
		$_SESSION['user-insight'] = $_POST['user'];
		$_SESSION['paket-insight'] = $_POST['paket'];
		$_SESSION['bintang-insight'] = $_POST['bintang'];
		header("Location: ../cbt-insight-comment");
	} else if (isset($_POST['comment'])) {
		// get information about paket
		$paket = $_SESSION['paket-insight'];
		$P_SQL = "SELECT * FROM paket WHERE id='$paket';";
		$P_RES = mysqli_query($connection, $P_SQL);
		$P_FET = mysqli_fetch_assoc($P_RES);
		$guru_paket = $P_FET['pembuat'];
		$sekolah_paket = $P_FET['sekolah'];
		$komentar = mysqli_real_escape_string($connection, $_POST['comment']);

		$id = uniqid();
		$user = $_SESSION['user-insight'];		
		$bintang = $_SESSION['bintang-insight'];		
		$SQL = "INSERT INTO insight (id, user, paket, bintang, komentar) VALUES('$id', '$user', '$paket', '$bintang', '$komentar');";
		$RES = mysqli_query($connection, $SQL);

		header("Location: ../cbt-dashboard");
		// header("Location: send_email_nilai?email=".$email."&namapaket=".urlencode($namapaket)."&nilai=".$nilai);
		exit();
	}