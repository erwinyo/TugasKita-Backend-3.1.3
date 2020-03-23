<?php 
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$userid = mysqli_real_escape_string($connection, $_POST['userid']);

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
				$ind['invite_from_image_url'] = "https://res.cloudinary.com/dizwvnwu0/image/upload/w_1000,c_fill,ar_1:1,g_auto,r_max/v1563118542/tugaskita/profile/".$akunFET['user_avatar'].".png";
				$ind['invite_from_image_url_alternative'] = $akunFET['user_avatar_alternative'];
				$avatar = "https://res.cloudinary.com/dizwvnwu0/image/upload/w_1000,c_fill,ar_1:1,g_auto,r_max/v1563118542/tugaskita/grup_profile/".$grupFET['grup_avatar'].".png";
				$ind['invite_to_grup_image_url'] = $avatar;
				$ind['as_status'] = $FET['as_status'];
				array_push($list['listofinvitation'], $ind);
			}
			$list['success'] = "1";
			$list['message'] = "Successfully loaded";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		} else {
			$list['success'] = "0";
			$list['message'] = "Error SQL";
			echo json_encode($list);
			mysqli_close($connection);
			exit();
		}
	}