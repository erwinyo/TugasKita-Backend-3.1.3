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
	//if ($_SERVER['REQUEST_METHOD']=='POST') {
		$tugasposisi = mysqli_real_escape_string($connection, $_GET['grupid']);

		$SQL = "SELECT * FROM tugas WHERE tugas_posisi='$tugasposisi';";
		$RES = mysqli_query($connection, $SQL);
		$NROW = mysqli_num_rows($RES);
		$result = array();
		$result['tugas'] = array();
		if ($NROW > 0) {
			$i = 0;
			while ($SELECTED = mysqli_fetch_assoc($RES)) {
				$uid = $SELECTED['tugas_author_id'];

				$akunSQL = "SELECT * FROM akun WHERE user_id='$uid';";
				$akunRES = mysqli_query($connection, $akunSQL);
				$akunFET = mysqli_fetch_assoc($akunRES);
				$avatar = "https://res.cloudinary.com/dizwvnwu0/image/upload/c_lfill,h_500,w_500/v1525499092/tugaskita/profile/".$akunFET['user_avatar'].".png";

				$dg = 0;
				$dt = strtotime($SELECTED['tugas_waktu']);
				$dn = strtotime($date."-".$month."-".$year);
				$dv = $dt - $dn;
				# Check if negative
				if ($dv < 0) {
					continue;
				} else {
					$dg = $dv / 86400;
					if ($dg == 0) {
						$dshow = "Hari ini";
					} else if ($dg == 1) {
						$dshow = "Besok";
					} else {
						$dshow = $dg." hari lagi";
					}
				}

				$endResult['tugasnama'] = $SELECTED['tugas_nama'];
				$endResult['tugaspelajaran'] = $SELECTED['tugas_pelajaran'];
				$endResult['tugaswaktu'] = $SELECTED['tugas_waktu'];
				$endResult['tugaswaktu_harilagi'] = $dshow;
				$endResult['tugaswaktu_number'] = strval($dg);
				$endResult['tugasprioritas'] = $SELECTED['tugas_prioritas'];
				$endResult['tugasauthorid'] = $SELECTED['tugas_author_id'];
				$endResult['tugasauthornama'] = $akunFET['user_namalengkap'];
				$endResult['tugasposisi'] = $SELECTED['tugas_posisi'];
				$endResult['tugasauthorpic'] = $avatar;
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
	//}