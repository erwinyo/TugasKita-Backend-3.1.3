<?php
	if(!isset($_SESSION)) 
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
	
	$userid = $_SESSION['user_id'];

	$SQL = "SELECT * FROM user_grup WHERE user_id='$userid';";
	$RES = mysqli_query($connection, $SQL);
	$NROW = mysqli_num_rows($RES);
	$list = array();
	$list['grup'] = array();
	# CHECK GROUP AVAIABLE
	# GET DATA
	if ($NROW > 0) {
		$list['success'] = "1";
		$list['message'] = "Successfully Loaded Group!";
		while ($SELECTED = mysqli_fetch_assoc($RES)) {
			$temp_SELECTED = $SELECTED['grup_id'];
			$temp_status = $SELECTED['status'];

			$cSQL = "SELECT * FROM grup WHERE grup_id='$temp_SELECTED';";
			$cRES = mysqli_query($connection, $cSQL);
			while ($cSELECTED = mysqli_fetch_assoc($cRES)) {

				//$temp_SELECTED = $cSELECTED['grup_id'];
				$index['idgrup'] = $cSELECTED['grup_id'];
				$index['namagrup'] = $cSELECTED['grup_nama'];
				$index['deskripsigrup'] = $cSELECTED['grup_cerita'];
				$index['status_in_grup'] = $temp_status;
			
				$avatar = $cSELECTED['grup_avatar'];
				if ($avatar == null) {
					$avatar = "https://res.cloudinary.com/dizwvnwu0/image/upload/v1526631659/icon/conference_call-512.png";
				}
				$index['avatargrup'] = $avatar;
				// Collect jumlahTugas Data
				$jtSQL = "SELECT * FROM tugas WHERE tugas_posisi='$temp_SELECTED';";
				$jtRES = mysqli_query($connection, $jtSQL);
				$jtROW = mysqli_num_rows($jtRES);
				$countTugas = 0;
				while ($jtFET = mysqli_fetch_assoc($jtRES)) {
					$dt = strtotime($jtFET['tugas_waktu']);
					$dn = strtotime($date."-".$month."-".$year);
					$dv = ($dt - $dn) / 86400;
					if ($dv >= 0) {
						++$countTugas;
					}

				}

				if ($countTugas == 0) {
					$index['jumlahtugasgrup'] = "-";
				} else {
					$index['jumlahtugasgrup'] = strval($countTugas)." tugas";
				}

				// Collect jumlahAnggota Data
				$jaSQL = "SELECT * FROM user_grup WHERE grup_id='$temp_SELECTED';";
				$jaRES = mysqli_query($connection, $jaSQL);
				$jaROW = mysqli_num_rows($jaRES);
				if ($jaROW > 0) {
					$index['jumlahanggotagrup'] = strval($jaROW." anggota");
				} else {
					$index['jumlahanggotagrup'] = "-";
				}
					array_push($list['grup'], $index);
			}
		}
		$_SESSION['grup'] = json_encode($list);
		header("Location: ../tugas");
		mysqli_close($connection);
		exit();
	} else {
		$list['success'] = "0";
		$list['message'] = "Kamu belum mempunyai grup apapun ataupun bergabung!";
		$_SESSION['grup'] = json_encode($list);
		header("Location: ../tugas");
		mysqli_close($connection);
		exit();
	}	
