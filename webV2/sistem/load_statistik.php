<?php
	session_start();
	require 'connection.php';
	$paket = mysqli_real_escape_string($connection, $_POST['paket']);
	$sekolah = mysqli_real_escape_string($connection, $_POST['sekolah']);
	
	$P_SQL = "SELECT * FROM paket WHERE sekolah='$sekolah' AND id='$paket';";
	$P_RES = mysqli_query($connection, $P_SQL);
	$P_FET = mysqli_fetch_assoc($P_RES);
	$P_FET_KUNCI = $P_FET['kunci'];

	$tempSpendTime = 0;
	$tempStarRate = 0;
	$arr = array();
	$arr['data'] = array();
	$S_SQL = "SELECT * FROM soal WHERE paket='$paket' AND sekolah='$sekolah';";
	$S_RES = mysqli_query($connection, $S_SQL);
	if ($S_RES) {
		$S_ROW = mysqli_num_rows($S_RES);
		if ($S_ROW > 0) {
			while ($S_FET = mysqli_fetch_assoc($S_RES)) {
				$soalid = $S_FET['id'];
				if ($P_FET_KUNCI != "") {
					$soalnama = decrypt($S_FET['soal'], $P_FET_KUNCI);
				} else {
					$soalnama = $S_FET['soal'];
				}
				$US_SQL = "SELECT * FROM user_soal WHERE paket='$paket' AND sekolah='$sekolah' AND soal='$soalid';";
				$US_RES = mysqli_query($connection, $US_SQL);
				if ($US_RES) {
					$US_ROW = mysqli_num_rows($US_RES);
					if ($US_ROW > 0) {
						while ($US_FET = mysqli_fetch_assoc($US_RES)) {
							 $tempSpendTime += intval($US_FET['time_spend']);
						}

						# GET INSIGHT START RATING
						$I_SQL = "SELECT * FROM insight WHERE paket='$paket'";
						$I_RES = mysqli_query($connection, $I_SQL);
						$I_ROW = mysqli_num_rows($I_RES);
						if ($I_ROW > 0) {
							while ($I_FET = mysqli_fetch_assoc($I_RES)) {
								$tempStarRate += intval($I_FET['bintang']);
							}
							# MENGHITUNG RATA-RATA RATING BINTANG
							$tempStarRate = $tempStarRate/intval($I_ROW);
						}

						array_push($arr['data'], $soalid."~".$soalnama."~".strval($tempSpendTime)."~".strval($tempStarRate));
						$tempSpendTime = 0;
						$tempStarRate = 0;
					}
				} else {
					$arr['success'] = "0";
					$arr['message'] = "Terjadi Kesalahan!";
					$arr['error'] = mysqli_error($connection);
					mysqli_close($connection);
					echo json_encode($arr);
					exit();
				}
			}
			$arr['success'] = "1";
			$arr['message'] = "Berhasil dimuat!";
			$arr['error'] = mysqli_error($connection);
			mysqli_close($connection);
			echo json_encode($arr);
			exit();
		} else {
			$arr['success'] = "2";
			$arr['message'] = "Data soal tidak tersedia!";
			$arr['error'] = mysqli_error($connection);
			mysqli_close($connection);
			echo json_encode($arr);
			exit();
		}
	} else {
		$arr['success'] = "0";
		$arr['message'] = "Terjadi Kesalahan!";
		$arr['error'] = mysqli_error($connection);
		mysqli_close($connection);
		echo json_encode($arr);
		exit();
	}

	function decrypt($text, $key) {
		// Store the cipher method 
	    $ciphering = "AES-128-CTR"; 
		$options = 0;
		// Non-NULL Initialization Vector for decryption 
      	$decryption_iv = '1234567891011121'; 
        
      	// Store the decryption key 
      	$decryption_key = $key; 
        
      	// Use openssl_decrypt() function to decrypt the data 
      	$decryption=openssl_decrypt ($text, $ciphering, $decryption_key, $options, $decryption_iv); 
      	return $decryption;
	}