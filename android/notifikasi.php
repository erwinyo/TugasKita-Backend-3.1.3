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

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);
		$list = array();
		$list['today'] = array();
		$list['tomorrow'] = array();

		# CHECK userid ALLOCATED IN grup
		$UG_SQL = "SELECT * FROM user_grup WHERE user_id='$userid';";
		$UG_RES = mysqli_query($connection, $UG_SQL);
		if ($UG_RES) {
			while ($UG_FET = mysqli_fetch_assoc($UG_RES)) {
				$grupid = $UG_FET['grup_id'];
				# GATHER INFORMATION tugas DATABASE
				$T_SQL = "SELECT * FROM tugas WHERE tugas_posisi='$grupid';";
				$T_RES = mysqli_query($connection, $T_SQL);
				if ($T_RES) {
					while ($T_FET = mysqli_fetch_assoc($T_RES)) {
						$timeResult = 0;
						$timeDatabase = strtotime($T_FET['tugas_waktu']);
						$timeNow = strtotime($date."-".$month."-".$year);
						$timeAverage = $timeDatabase - $timeNow;
						# Check if negative
						if ($timeAverage < 0) {
							continue;
						} else {
							$timeResult = $timeAverage / 86400;
							if ($timeResult == 0) {
								# HARI INI
								$ind['tugas_id'] = $T_FET['tugas_id'];
								$ind['tugas_nama'] = $T_FET['tugas_nama'];
								$ind['tugas_pelajaran'] = $T_FET['tugas_pelajaran'];
								$ind['tugas_waktu'] = $T_FET['tugas_waktu'];
								$ind['tugas_waktu_huruf'] = "Hari ini";
								$ind['tugas_prioritas'] = $T_FET['tugas_prioritas'];
								$ind['tugas_author_id'] = $T_FET['tugas_author_id'];
								$ind['tugas_author_nama'] = toUserNamaLengkap($T_FET['tugas_author_id'], $connection);
								$ind['tugas_posisi_id'] = $T_FET['tugas_posisi'];
								$ind['tugas_posisi_nama'] = toGrupNama($T_FET['tugas_posisi'], $connection);
								$ind['tugas_cerita'] = $T_FET['tugas_cerita'];
								array_push($list['today'], $ind);
							} else if ($timeResult == 1) {
								# BESOK
								$ind['tugas_id'] = $T_FET['tugas_id'];
								$ind['tugas_nama'] = $T_FET['tugas_nama'];
								$ind['tugas_pelajaran'] = $T_FET['tugas_pelajaran'];
								$ind['tugas_waktu'] = $T_FET['tugas_waktu'];
								$ind['tugas_waktu_huruf'] = "Besok";
								$ind['tugas_prioritas'] = $T_FET['tugas_prioritas'];
								$ind['tugas_author_id'] = $T_FET['tugas_author_id'];
								$ind['tugas_author_nama'] = toUserNamaLengkap($T_FET['tugas_author_id'], $connection);
								$ind['tugas_posisi_id'] = $T_FET['tugas_posisi'];
								$ind['tuga_posisi_nama'] = toGrupNama($T_FET['tugas_posisi'], $connection);
								$ind['tugas_cerita'] = $T_FET['tugas_cerita'];
								array_push($list['tomorrow'], $ind);
							}
						}
					}
					$list['success'] = "1";
					$list['message'] = "SUCCESSFULLY LOADED!";
					echo json_encode($list);
					mysqli_close($connection);
					exit();
				} else {
					$list['success'] = "0";
					$list['message'] = "TUGAS SQL COMMAND ERROR!";
					echo json_encode($list);
					mysqli_close($connection);
					exit();
				}
			}
		} else {
			$list['success'] = "0";
			$list['message'] = "USER_GRUP SQL COMMAND ERROR!";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		}
	}
	function toGrupNama($grupid, $connection) {
		$SQL = "SELECT * FROM grup WHERE grup_id='$grupid';";
		$RES = mysqli_query($connection, $SQL);
		$FET = mysqli_fetch_assoc($RES);
		return $FET['grup_nama'];
	}
	function toUserNamaLengkap($userid, $connection) {
		$SQL = "SELECT * FROM akun WHERE user_id='$userid';";
		$RES = mysqli_query($connection, $SQL);
		$FET = mysqli_fetch_assoc($RES);
		return $FET['user_namalengkap'];
	}