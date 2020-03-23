<?php
	session_start();
	require 'connection.php';

	$paket = mysqli_real_escape_string($connection, $_POST['paket']);

	$SQL = "SELECT * FROM paket WHERE id='$paket';";
	$RES = mysqli_query($connection, $SQL);

	$DSOAL = array();
	$DSOAL['soal'] = array();
	$FET = mysqli_fetch_assoc($RES);

	$soal_array = explode(",", $FET['soal']);
	foreach ($soal_array as $key => $value) {
		# cek jika data id soal di paket ada di table soal
		$S_SQL = "SELECT * FROM soal WHERE id='$value';";
		$S_RES = mysqli_query($connection, $S_SQL);
		$S_ROW = mysqli_num_rows($S_RES);
		if ($S_ROW == 1) {
			# jika ada di table soal
			$soal = mysqli_fetch_assoc($S_RES)['soal'];
			// echo '<a href="cbt-upload-soal?id='.$value.'" class="list-group-item list-group-item-action"><b class="h4 mr-5">'.strval($key+1).'</b>'.formatWords($soal).'</a>';
			$ind['number'] = strval($key+1);
			$ind['id'] = $value;
			$ind['title'] = formatWords(decrypt($soal, $_SESSION['key']));

			array_push($DSOAL['soal'], $ind);
		} else {
			# jika tidak ada di tabel soal
			// echo '<a href="cbt-upload-soal?id='.$value.'" class="list-group-item list-group-item-action"><b class="h4 mr-5">'.strval($key+1).'</b></a>';
			$ind['number'] = strval($key+1);
			$ind['id'] = $value;
			$ind['title'] = "...";

			array_push($DSOAL['soal'], $ind);
		}
	}
	$DSOAL['success'] = "1";
	$DSOAL['message'] = "Berhasil di muat!";
	echo json_encode($DSOAL);
	exit();


	function formatWords($words) {
		if (strlen($words) > 35) {
			return substr($words, 0, 35)."...";
		} else {
			return $words;
		}
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