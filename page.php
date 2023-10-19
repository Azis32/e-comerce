<?php
	if(isset($_GET['hal'])){
		if($_GET['hal'] == "inbox"){
			include "hal/inbox.php";
		}elseif ($_GET['hal'] == "mahasiswa") {
			include "hal/mahasiswa.data.php";
		}elseif ($_GET['hal'] == "jurusan") {
			include "hal/jurusan.data.php";
		}elseif ($_GET['hal'] == "pengguna") {
			include "hal/pengguna.data.php";
		}else{
			include "hal/utama.php";
		}
	}else{
		include "hal/utama.php";
	}

?>
