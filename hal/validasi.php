<?php
include "../conf/connect.php";
$crud = new crud("localhost","root","F@ridi23","db_broadcast");

$page = (isset($_GET['v'])) ? $_GET['v'] : '';
if ($page == "nim") {
	$nim = $_POST['nim'];
	$cari = $crud->num("tmahasiswa","nim = '$nim'");
	if ($cari>0) {
		echo "ada";
	}
}elseif($page == "nomor"){
	$telepon = $_POST['nomor'];
	$cari = $crud->num("tmahasiswa","telepon = '$telepon'");
	if ($cari>0) {
		echo "ada";
	}
}elseif($page == "nomoredit"){
	$telepon = $_POST['nomor'];
	$telpawal = $_POST['nomorawal'];
	if($telpawal != $telepon){
		$cari = $crud->num("tmahasiswa","telepon = '$telepon'");
		if ($cari>0) {
			echo "ada";
		}
	}
	
}

?>