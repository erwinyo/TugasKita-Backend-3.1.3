<?php
session_start();

if (isset($_GET['new_soal_idx'])) {
	$_SESSION['soal_idx'] = $_GET['new_soal_idx'];
	header("Location: ../cbt-run");
} else if (isset($_GET['analisis_kata_kunci'])) {
	$_SESSION['analisis_kata_kunci'] = $_GET['analisis_kata_kunci'];
	header("Location: ../sekolah/paket");
}
?>