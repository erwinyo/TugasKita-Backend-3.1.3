<?php
	require 'connection.php';
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
		$tugasauthorid = mysqli_real_escape_string($connection, $_POST['userid']);

		$SQL = "SELECT * FROM tugas WHERE tugas_posisi='$tugasposisi' AND tugas_author_id='$tugasauthorid';";
		$RES = mysqli_query($connection, $SQL);
		$NROW = mysqli_num_rows($RES);
		$result = array();
		$result['tugas'] = array();
		if ($NROW > 0) {
			$i = 0;
			while ($SELECTED = mysqli_fetch_assoc($RES)) {
				$uid = $SELECTED['tugas_author_id'];
				$dg = 0;
				$dt = strtotime($SELECTED['tugas_waktu']);
				$dn = strtotime($date."-".$month."-".$year);
				$dv = ($dt - $dn) / 86400;

				$endResult['tugasid'] = $SELECTED['tugas_id'];
				$endResult['tugasnama'] = $SELECTED['tugas_nama'];
				$endResult['tugaspelajaran'] = $SELECTED['tugas_pelajaran'];
				$endResult['tugaswaktu'] = $SELECTED['tugas_waktu'];
				if ($dv < 0) {
					$endResult['tugaswaktuexpired'] = strval(abs($dv)." hari lalu expired");
				} else if ($dv == 0) {
					$endResult['tugaswaktuexpired'] = "hari ini";
				} else {
					$endResult['tugaswaktuexpired'] = strval(abs($dv)." hari lagi");
				}
				$endResult['tugaswaktudesimal'] = $dv;
				$endResult['tugasprioritas'] = $SELECTED['tugas_prioritas'];
				$endResult['tugascerita'] = $SELECTED['tugas_cerita'];
				// Add each tugas
				array_push($result['tugas'], $endResult);		
			}
			$result['success'] = "1";
	        $result['message'] = "success";
	        echo json_encode($result);
			mysqli_close($connection);
			exit();
		} else {
			$result['success'] = "0";
	        $result['message'] = "This Group don't have tugas yet...";
	        echo json_encode($result);
			mysqli_close($connection);
			exit();
		}
	}