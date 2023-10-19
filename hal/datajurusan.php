<?php
if (isset($_POST['kd_jurusan'])) {
	$data = '<option>Pilih Kelas</option>';
	if ($_POST['kd_jurusan']=="55") {
		$data .='
			  	<option value="A">A</option>
			  	<option value="B">B</option>
			  	<option value="C">C</option>
			  	<option value="D">D</option>
			  	<option value="E">E</option>';
	}elseif($_POST['kd_jurusan']=="57"){
		$data .='
			  	<option value="A">A</option>
			  	<option value="B">B</option>';
	}
	echo $data;
}
?>