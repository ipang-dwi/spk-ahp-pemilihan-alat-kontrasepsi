<?php
	@session_start();
	$_SESSION['judul'] = 'SPK KONTRASEPSI';
	$_SESSION['welcome'] = 'APLIKASI PENDUKUNG KEPUTUSAN PEMILIHAN ALAT KONTRASEPSI';
	$_SESSION['by'] = 'Firstplato.com';
	$mysqli = new mysqli('localhost','root','','spk-ahp');
	if($mysqli->connect_errno){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
?>
