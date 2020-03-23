<?php
	session_start();
	require 'connection.php';
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);

		# HAPUS DARI DATABASE 'absent'
		$A_SQL = "DELETE FROM absent WHERE absent_grup='$grupid';";
		$A_RES = mysqli_query($connection, $A_SQL);
		if ($A_RES) {
			# HAPUS DARI DATABASE 'tugas'
			$T_SQL = "DELETE FROM tugas WHERE tugas_posisi='$grupid';";
			$T_RES = mysqli_query($connection, $T_SQL);
			if ($T_RES) {
				# HAPUS DARI DATABASE 'grup'
				$G_SQL = "DELETE FROM grup WHERE grup_id='$grupid';";
				$G_RES = mysqli_query($connection, $G_SQL);
				if ($G_RES) {
					# HAPUS DARI DATABASE 'grup_pelajaran'
					$GP_SQL = "DELETE FROM grup_pelajaran WHERE pelajaran_grup='$grupid';";
					$GP_RES = mysqli_query($connection, $GP_SQL);
					if ($GP_RES) {
						# HAPUS DARI DATABASE 'invite_grup'
						$IG_SQL = "DELETE FROM invite_grup WHERE invite_to_grup='$grupid';";
						$IG_RES = mysqli_query($connection, $IG_SQL);
						if ($IG_RES) {
							# HAPUS DARI DATABASE 'user_grup'
							$UG_SQL = "DELETE FROM user_grup WHERE grup_id='$grupid';";
							$UG_RES = mysqli_query($connection, $UG_SQL);
							if ($UG_RES) {
								$outcome['success'] = "1";
								$outcome['message'] = "Successfully Deleted...";
								echo json_encode($outcome);
								mysqli_close($connection);
								exit();
							} else {
								$outcome['success'] = "0";
								$outcome['message'] = "user_grup FAILED DELETED!";
								echo json_encode($outcome);
								mysqli_close($connection);
								exit();
							}
						} else {
							$outcome['success'] = "0";
							$outcome['message'] = "invite_grup FAILED DELETED!";
							echo json_encode($outcome);
							mysqli_close($connection);
							exit();
						}
					} else {
						$outcome['success'] = "0";
						$outcome['message'] = "grup_pelajaran FAILED DELETED!";
						echo json_encode($outcome);
						mysqli_close($connection);
						exit();
					} 
				} else {
					$outcome['success'] = "0";
					$outcome['message'] = "grup FAILED DELETED!";
					echo json_encode($outcome);
					mysqli_close($connection);
					exit();
				}
			} else {
				$outcome['success'] = "0";
				$outcome['message'] = "tugas FAILED DELETED!";
				echo json_encode($outcome);
				mysqli_close($connection);
				exit();
			}
		} else {
				$outcome['success'] = "0";
				$outcome['message'] = "absent FAILED DELETED!";
				echo json_encode($outcome);
				mysqli_close($connection);
				exit();
			}

				
	}