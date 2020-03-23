<?php
	require 'connection.php';
	$t = mysqli_real_escape_string($connection, $_GET['t']);

	if ($t == "insight_write") {
		if (isset($_GET['user'])) {
			if (isset($_GET[''])) {
				# code...
			}
		} else {
			echo "paramater 'user' not included for data!";
			exit();
		}
	}
	