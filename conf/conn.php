<?php
	$conn = mysqli_connect("localhost","root","","broadcast_db");
	if ($tabel==false) {
		header('location:page/error.php');
	}
?>