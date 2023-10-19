<?php
include "../conf/connect.php";
$crud = new crud("localhost","root","F@ridi23","db_broadcast");

if (isset($_GET['s'])) {
	if ($_GET['s'] == "add") {
		$matkul = $_POST['matkul'];
		$dosen = $_POST['dosen'];
		$jurusan = $_POST['jurusan'];
		$jam = $_POST['jam'];
		$hari = $_POST['hari'];
		$semester = $_POST['semester'];
		$kelas = $_POST['kelas'];
		$caridata = $crud->select("tdosenmatkul","kd_matkul='$matkul' AND nid='$dosen'");
		$kd_dm = $caridata[0]['kd_dm'];
		$cek = $crud->num("tjadwal","jurusan='$jurusan' AND jam='$jam' AND hari='$hari' AND semester='$semester' AND kd_dm='$kd_dm'");
		if ($cek>0) {
			echo "Maaf mata kuliah sudah memiliki jadwal pada jam yang sama";
		}else{
			$crud->updateSingel("tjadwal", "kd_dm='$kd_dm'", "jurusan='$jurusan' AND jam='$jam' AND hari='$hari' AND kelas='$kelas' AND semester='$semester'");
		}
	} elseif($_GET['s'] == "reset") {
		$jurusan = $_POST['jurusan'];
		$jam = $_POST['jam'];
		$hari = $_POST['hari']; 
		$semester = $_POST['semester'];
		$kelas = $_POST['kelas'];
		$crud->updateSingel("tjadwal", "kd_dm=NULL", "jurusan='$jurusan' AND jam='$jam' AND hari='$hari' AND kelas='$kelas' AND semester='$semester'");
	}
} 
if (isset($_POST['kd_matkul'])){
		$matkul=$_POST['kd_matkul'];
	  	$jurusan=$crud->select("tdosenmatkul", "kd_matkul='$matkul'");
	  	$output = '<option value="">Pilih Dosen</option>';
	  	foreach ($jurusan as $data) {
	  		$nama=$crud->select("tdosen","nid=".$data["nid"]);
	  		foreach ($nama as $key) {
		  		$output .= '<option value="'.$data["nid"].'">'.$key["nama"].'</option>';	
	  		}
	  		
	  	}
	  	echo $output;
}elseif (isset($_POST['kd_jurusan'])) {
	$jurusan=$_POST['kd_jurusan'];
  	$output = '<option value="">Pilih Kelas</option>';
	if ($jurusan == "55") {
		$output .= '<option value="A">A</option>';
		$output .= '<option value="B">B</option>';
		$output .= '<option value="C">C</option>';
		$output .= '<option value="D">D</option>';
		$output .= '<option value="E">E</option>';
	}elseif ($jurusan == "57") {
		$output .= '<option value="A">A</option>';
		$output .= '<option value="B">B</option>';
	}
  	echo $output;
}
?>