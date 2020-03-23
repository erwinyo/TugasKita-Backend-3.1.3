<?php
	session_start();
	require '../connection.php';
	date_default_timezone_set('Asia/Jakarta');
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$tugasposisi = mysqli_real_escape_string($connection, $_POST['grupid']);
		$SQL = "SELECT * FROM tugas WHERE tugas_posisi='$tugasposisi';";
		$RES = mysqli_query($connection, $SQL);
		$NROW = mysqli_num_rows($RES);
		$result = array();
		$result['riwayat'] = array();
		if ($NROW > 0) {
			$i = 0;
			while ($SELECTED = mysqli_fetch_assoc($RES)) {
				$uid = $SELECTED['tugas_author_id'];
				$dg = 0;
				$dt = strtotime($SELECTED['tugas_waktu']);
				$dn = strtotime($date."-".$month."-".$year);
				$dv = ($dt - $dn) / 86400;

				if ($dv < 0) {
					$endResult['tugasid'] = $SELECTED['tugas_id'];
					$endResult['tugasnama'] = $SELECTED['tugas_nama'];
					$endResult['tugaspelajaran'] = $SELECTED['tugas_pelajaran'];
					$endResult['tugaswaktu'] = $SELECTED['tugas_waktu'];
					$endResult['tugasprioritas'] = $SELECTED['tugas_prioritas'];
					$endResult['tugascerita'] = $SELECTED['tugas_cerita'];
					// Add each tugas
					array_push($result['riwayat'], $endResult);
				}			
			}
			$result['success'] = "1";
	        $result['message'] = "success";
			mysqli_close($connection);
	        echo json_encode($result);
			exit();
		} else {
			$result['success'] = "0";
	        $result['message'] = "This Group don't have tugas yet...";
			mysqli_close($connection);
	        echo json_encode($result);
			exit();
		}
	}