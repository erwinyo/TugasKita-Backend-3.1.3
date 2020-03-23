<?php
	require 'connection.php';
	$paket = mysqli_real_escape_string($connection, $_GET['paket']);
	$sekolah = mysqli_real_escape_string($connection, $_GET['sekolah']);

	$US_SQL = "DELETE FROM user_soal WHERE paket='$paket' AND sekolah='$sekolah';";
	$US_RES = mysqli_query($connection, $US_SQL);
	if ($US_RES) {
		$UP_SQL = "DELETE FROM user_paket WHERE paket_id='$paket' AND sekolah_id='$sekolah';";
		$UP_RES = mysqli_query($connection, $UP_SQL);
		if ($UP_RES) {
			$JM_SQL = "DELETE FROM jawaban_masuk WHERE paket='$paket' AND sekolah='$sekolah';";
			$JM_RES = mysqli_query($connection, $JM_SQL);
			if ($JM_RES) {
				$S_SQL = "DELETE FROM soal WHERE paket='$paket' AND sekolah='$sekolah';";
				$S_RES = mysqli_query($connection, $S_SQL);
				if ($S_RES) {
					$P_SQL = "DELETE FROM paket WHERE id='$paket' AND sekolah='$sekolah';";
					$P_RES = mysqli_query($connection, $P_SQL);
					if ($P_RES) {
						header("Location: ../sekolah/paket");
						exit();
					} else {
						echo "Gagal menghapus paket";
						exit();
					}
				} else {
					echo "Gagal menghapus soal";
					exit();
				}
			}
		}
	}