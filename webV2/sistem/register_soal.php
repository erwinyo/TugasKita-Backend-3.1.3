<?php
	session_start();
	require 'connection.php';

	$sekolah = $_SESSION['sekolah_id'];
	$paket = $_SESSION['upload_id'];
	
	$id = mysqli_real_escape_string($connection, $_POST['id']);
	$soal = encrypt(mysqli_real_escape_string($connection, $_POST['soal']), $_SESSION['key']);
	$foto = encrypt(ltrim(mysqli_real_escape_string($connection, $_POST['foto']), ','), $_SESSION['key']);
	$A = encrypt(mysqli_real_escape_string($connection, $_POST['A']), $_SESSION['key']);
	$B = encrypt(mysqli_real_escape_string($connection, $_POST['B']), $_SESSION['key']);
	$C =encrypt(mysqli_real_escape_string($connection, $_POST['C']), $_SESSION['key']);
	$D = encrypt(mysqli_real_escape_string($connection, $_POST['D']), $_SESSION['key']);
	$E = encrypt(mysqli_real_escape_string($connection, $_POST['E']), $_SESSION['key']);
	$fotoA = encrypt(ltrim(mysqli_real_escape_string($connection, $_POST['fotoA']), ','), $_SESSION['key']);
	$fotoB = encrypt(ltrim(mysqli_real_escape_string($connection, $_POST['fotoB']), ','), $_SESSION['key']);
	$fotoC = encrypt(ltrim(mysqli_real_escape_string($connection, $_POST['fotoC']), ','), $_SESSION['key']);
	$fotoD = encrypt(ltrim(mysqli_real_escape_string($connection, $_POST['fotoD']), ','), $_SESSION['key']);
	$fotoE = encrypt(ltrim(mysqli_real_escape_string($connection, $_POST['fotoE']), ','), $_SESSION['key']);
	$jawaban = encrypt(mysqli_real_escape_string($connection, $_POST['jawaban']), $_SESSION['key']);
	$type = mysqli_real_escape_string($connection, $_POST['type']);

	$checkSQL = "SELECT * FROM soal WHERE id='$id';";
	$checkRES = mysqli_query($connection, $checkSQL);
	$checkROW = mysqli_num_rows($checkRES);
	if ($checkROW == 1) {
		# UPDATE CURRENT ROW
		$SQL = "UPDATE soal SET soal='$soal', gambar='$foto', a='$A', b='$B', c='$C', d='$D', e='$E', a_gambar='$fotoA', b_gambar='$fotoB', c_gambar='$fotoC', d_gambar='$fotoD', e_gambar='$fotoE', benar='$jawaban' WHERE id='$id';";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			echo "1";
			mysqli_close($connection);
			exit();
		} else {
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	} else {
		# INSERT NEW ROW
		$SQL = "INSERT INTO soal(id, soal, gambar, paket, sekolah, a, b, c, d, e, a_gambar, b_gambar, c_gambar, d_gambar, e_gambar, benar) VALUES('$id', '$soal', '$foto', '$paket', '$sekolah', '$A', '$B', '$C', '$D', '$E', '$fotoA', '$fotoB', '$fotoC', '$fotoD', '$fotoE', '$jawaban');";
		$RES = mysqli_query($connection, $SQL);
		if ($RES) {
			echo "1";
			mysqli_close($connection);
			exit();
		} else {
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	}

	function encrypt($text, $key) {
	      // Store the cipher method 
	      $ciphering = "AES-128-CTR"; 
	      
	      // Use OpenSSl Encryption method 
	      $iv_length = openssl_cipher_iv_length($ciphering); 
	      $options = 0; 
	        
	      // Non-NULL Initialization Vector for encryption 
	      $encryption_iv = '1234567891011121'; 
	        
	      // Store the encryption key 
	      $encryption_key = $key; 
	        
	      // Use openssl_encrypt() function to encrypt the data 
	      $encryption = openssl_encrypt($text, $ciphering, $encryption_key, $options, $encryption_iv);
	      return $encryption;
	}