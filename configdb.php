<?php
	@session_start();
	$_SESSION['judul'] = 'SPK KONTRASEPSI';
	$_SESSION['welcome'] = 'APLIKASI PENDUKUNG KEPUTUSAN PEMILIHAN ALAT KONTRASEPSI';
	$_SESSION['by'] = 'Adit, S.Kom';
	$mysqli = new mysqli('localhost','root','1717','spk-adit');
	if($mysqli->connect_errno){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
?>