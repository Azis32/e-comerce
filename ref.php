<?php
	include "conf/connect.php";
	$crud = new crud("localhost","root","","db_broadcast");
	for ($i=1; $i < 5; $i++) { 
		for ($a=1; $a < 9; $a++) { 
		$crud->jadwal("tjadwal", "kd_md=NULL");
		}
	}
?>