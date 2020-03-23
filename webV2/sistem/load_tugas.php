<?php
	session_start();
	require 'connection.php';
	date_default_timezone_set('Asia/Jakarta');
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];
	
	if (isset($_POST['grupid'])) {
		$tugasposisi = mysqli_real_escape_string($connection, $_POST['grupid']);
	} else {
		$tugasposisi = $_SESSION['grup'];
	}

	$SQL = "SELECT * FROM tugas WHERE tugas_posisi='$tugasposisi';";
	$RES = mysqli_query($connection, $SQL);
	$NROW = mysqli_num_rows($RES);
	$result = array();
	$temp = array();
	$result['tugas_today'] = array();
	$result['tugas_tommorow'] = array();
	$result['tugas_others'] = array();
	if ($NROW > 0) {
		$i = 0;
		while ($SELECTED = mysqli_fetch_assoc($RES)) {
			$uid = $SELECTED['tugas_author_id'];

			$akunSQL = "SELECT * FROM akun WHERE user_id='$uid';";
			$akunRES = mysqli_query($connection, $akunSQL);
			$akunFET = mysqli_fetch_assoc($akunRES);
			$avatar = $akunFET['user_avatar'].".png";

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
					$endResult['tugasid'] = $SELECTED['tugas_id'];
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
					array_push($result['tugas_today'], $endResult);
				} else if ($dg == 1) {
					$dshow = "Besok";
					$endResult['tugasid'] = $SELECTED['tugas_id'];
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
					array_push($result['tugas_tommorow'], $endResult);
				} else {
					$dshow = $dg." hari lagi";
					$endResult['tugasid'] = $SELECTED['tugas_id'];
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
					array_push($result['tugas_others'], $endResult);
				}
			}
		}
		$result['success'] = "1";
        $result['message'] = "success";
		mysqli_close($connection);
		$_SESSION['tugas'] = $result;
		$_SESSION['grup'] = $tugasposisi;
		header("Location: ../dashboard");
		exit();
	} else {
		$result['success'] = "0";
        $result['message'] = "This Group don't have tugas yet...";
        mysqli_close($connection);
		$_SESSION['tugas'] = $result;
		$_SESSION['grup'] = $tugasposisi;
		header("Location: ../dashboard");
		exit();
	}
	