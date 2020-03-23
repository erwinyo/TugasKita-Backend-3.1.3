<?php
	session_start();
	require 'connection.php';

	$userid = $_SESSION['userid'];
	$grupid = mysqli_real_escape_string($connection, $_POST['grupid']);
	$as_status = mysqli_real_escape_string($connection, $_POST['as_status']);

	$SQL = "INSERT INTO user_grup (user_id, grup_id, status) VALUES ('$userid', '$grupid', '$as_status');";
	$RES = mysqli_query($connection, $SQL);
	if ($RES) {
		# DELETE
		$DEL_SQL = "DELETE FROM invite_grup WHERE invite_to='$userid' AND invite_to_grup='$grupid' AND as_status='$as_status';";
		$DEL_RES = mysqli_query($connection, $DEL_SQL);

		if ($DEL_RES) {
			$index['success'] = "1";
			$index['message'] = "Successfully Accepted!";
			header("Location: load_undangan_masuk");
			mysqli_close($connection);
			exit();
		} else {
			echo "Query Error!";
			mysqli_close($connection);
			exit();
		}	
	} else {
		echo "Error Occured!";
		mysqli_close($connection);
		exit();
 	}
	