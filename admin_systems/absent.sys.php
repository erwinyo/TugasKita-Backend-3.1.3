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
	
	$grupid = $_SESSION['grupid_absent'];
	$month = mysqli_real_escape_string($connection, $_GET['month']);
	$_SESSION['month'] = $month;
	$_SESSION['year'] = $year;

	$data = array();

	$UG_SQL = "SELECT * FROM user_grup WHERE grup_id='$grupid';";
	$UG_RES = mysqli_query($connection, $UG_SQL);
	while ($UG_FET = mysqli_fetch_assoc($UG_RES)) {
		$userid = $UG_FET['user_id'];
		$absented = 0;
		$special = 0;
		$not_absented = 0;

		$A_SQL = "SELECT * FROM akun WHERE user_id='$userid';";
		$A_RES = mysqli_query($connection, $A_SQL);
		$A_FET = mysqli_fetch_assoc($A_RES);
		
		$nama = $A_FET['user_namalengkap'];
		$ind['nama'] = $nama;

		$AB_SQL = "SELECT * FROM absent WHERE absent_user='$userid';";
		
		if ($month == 1) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 2) {
			for ($i=1; $i <= 29; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 3) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 4) {
			for ($i=1; $i <= 30; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 5) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 6) {
			for ($i=1; $i <= 30; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 7) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 8) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;

			array_push($data, $ind);
			$ind = null;
		} else if ($month == 9) {
			for ($i=1; $i <= 30; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 10) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;
			
			array_push($data, $ind);
			$ind = null;
		} else if ($month == 11) {
			for ($i=1; $i <= 30; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;

			array_push($data, $ind);
			$ind = null;
		} else if ($month == 12) {
			for ($i=1; $i <= 31; $i++) { 
				$pass = false;
				$tempTanggal = str_pad($i, 2, "0", STR_PAD_LEFT)."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".$year;
				$tempType = "";
				$AB_RES = mysqli_query($connection, $AB_SQL);
				while ($AB_FET = mysqli_fetch_assoc($AB_RES)) {
					$tanggalDatabase = $AB_FET['absent_date'];
					if ($tanggalDatabase == $tempTanggal) {
						$tempType = $AB_FET['absent_type'];
						$pass = true;
						break;
					}
				}

				if ($pass) {
					// MEMBEDAKAN MANA YANG MASUK, IJIN, SAKIT, ALPHA
					if ($tempType == "MASUK") {
						$absented++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "OK~".$tempType;
					} else {
						$special++;
						$ind['tanggal'][formatMonth($tempTanggal)] = "SPECIAL~".$tempType;
					}
				} else { 
					$not_absented++;
					$ind['tanggal'][formatMonth($tempTanggal)] = "N/A~-";
				}
			}

			$ind['absented'] = $absented;
			$ind['special'] = $special;
			$ind['not_absented'] = $not_absented;

			array_push($data, $ind);
			$ind = null;
		}
	}

	//unset($_SESSION['absent-data']);
	$_SESSION['absent-data'] = $data;
	header("Location: ../absent");
	exit();


	function formatMonth($date) {
		$result = "empty";
		$dateArray = explode("-", $date);
		$hari = $dateArray[0];
		$bulan = $dateArray[1];
		$tahun = $dateArray[2];
		switch ($bulan) {
			case 1: $bulan = "JAN"; break;
			case 2: $bulan = "FEB"; break;
			case 3: $bulan = "MAR"; break;
			case 4: $bulan = "APR"; break;
			case 5: $bulan = "MEI"; break;
			case 6: $bulan = "JUNI"; break;
			case 7: $bulan = "JULI"; break;
			case 8: $bulan = "AGT"; break;
			case 9: $bulan = "SEPT"; break;
			case 10: $bulan = "OKT"; break;
			case 11: $bulan = "NOV"; break;
			case 12: $bulan = "DES"; break;
		}
		$result = $hari." ".$bulan." ".$tahun;
		return $result;
	}