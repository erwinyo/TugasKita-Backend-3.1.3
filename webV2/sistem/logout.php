<?php
	session_start();
	

	if (isset($_POST['type']) && $_POST['type'] == "cbt") {
		session_unset();
		session_destroy();
		header("Location: ../cbt");
	} else if (isset($_GET['type']) && $_GET['type'] == "sekolah") {
		session_unset();
		session_destroy();
		header("Location: ../cbt-sekolah");
	} else if (isset($_GET['type']) && $_GET['type'] == "upload") {
		header("Location: ../sekolah/paket");
	}  else {
		session_unset();
		session_destroy();
		header("Location: ../login-register");
	}