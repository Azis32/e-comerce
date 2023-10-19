<?php
	require __DIR__ . '/connect.php';
 	$crud = new crud("localhost","root","F@ridi23","db_broadcast");
	session_start();

 	if (isset($_POST['login'])) {
 		$user = $_POST['username'];
 		$pass = $_POST['password'];
 		$cek = $crud->num("tpegawai", "nip = '$user' AND password = '$pass' AND status = 'aktif'");
 		if ($cek > 0) {
 			$data = $crud->select("tpegawai", "nip = '$user' AND password = '$pass' AND status = 'aktif'");
 			$_SESSION['level'] = $data[0]['jabatan'];
 			$_SESSION['id'] = $data[0]['nip'];
 			?>
 			<script type="text/javascript">
 				window.location = "../";
 			</script>
 			<?php
 		} else {
 			?>
 			<script type="text/javascript">
 				alert("Maaf, username atau password yang anda masukkan salah !");
 				document.location = "../";
 			</script>
 			<?php
 		}
 	} elseif (isset($_GET['logout'])){
 		session_destroy();
 		?>
		<script type="text/javascript">
			window.location = "../";
		</script>
		<?php
 	}

?>