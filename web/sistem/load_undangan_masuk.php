<?php 
	session_start();
	require 'connection.php';
	
	$userid = $_SESSION['user_id'];

	$SQL = "SELECT * FROM invite_grup WHERE invite_to='$userid';";
	$RES = mysqli_query($connection, $SQL);
	$list = array();
	$list['listofinvitation'] = array();
	if ($RES) {
		while ($FET = mysqli_fetch_assoc($RES)) {
			$getInviteFrom = $FET['invite_from'];
			$akunSQL = "SELECT * FROM akun WHERE user_id='$getInviteFrom';";
			$akunRES = mysqli_query($connection, $akunSQL);
			$akunFET = mysqli_fetch_assoc($akunRES);

			$getInviteToGrup = $FET['invite_to_grup'];
			$grupSQL = "SELECT * FROM grup WHERE grup_id='$getInviteToGrup';";
			$grupRES = mysqli_query($connection, $grupSQL);
			$grupFET = mysqli_fetch_assoc($grupRES);

			$ind['invite_from'] = $akunFET['user_namalengkap'];
			$ind['invite_from_id'] = $akunFET['user_id'];
			$ind['invite_to_grup'] = $grupFET['grup_nama'];
			$ind['invite_to_grup_id'] = $grupFET['grup_id'];
			$ind['invite_from_image_url'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/v1526631659/icon/conference_call-512.png";
			# CHECK user AVATAR
			if ($akunFET['user_avatar'] != null) {
				$ind['invite_from_image_url'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/c_lfill,h_500,w_500/v1525499092/tugaskita/profile/".$akunFET['user_avatar'].".png";
			}

			$avatar = $grupFET['grup_avatar'];
			if ($avatar == null) {
				$avatar = "https://res.cloudinary.com/dizwvnwu0/image/upload/v1526631659/icon/conference_call-512.png";
			}
			$ind['invite_to_grup_image_url'] = $avatar;
			$ind['as_status'] = $FET['as_status'];
			array_push($list['listofinvitation'], $ind);
		}
		$list['success'] = "1";
		$list['message'] = "Successfully loaded";
		
		$_SESSION['undangan_masuk'] = json_encode($list);
		header("Location: ../undangan-masuk");
		mysqli_close($connection);
		exit();
	} else {
		echo "Error SQL Command!";
		mysqli_close($connection);
		exit();
	}
	