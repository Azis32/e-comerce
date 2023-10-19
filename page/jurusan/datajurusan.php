<?php
	include "./conf/conn.php";
	include "./bootstrap/costum/costum.css";
if(isset($_GET['aksi'])){
	switch ($_GET['aksi']) {
		case 'tambah':
			if(isset($_POST['simpan'])){
				$kodeJurusan=$_POST['kodeJurusan'];
				$namaJurusan=$_POST['namaJurusan'];
				$status=isset($_POST['status'])?$_POST['status']:"";
				$query=mysqli_query($conn,"SELECT * FROM jurusan WHERE kodeJurusan='$kodeJurusan'");
				$cek=mysqli_num_rows($query);
				if($cek>0){
					echo '
						<h3>Gagal</h3>
						<script type="text/javascript">
							alert("Kode Jurusan yang anda masukkan sudah ada !");
							document.location.href="?page=jurusan";
						</script>
					';
				}else{
					$simpan=mysqli_query($conn,"INSERT INTO `jurusan`(`kodeJurusan`, `namaJurusan`, `status`) VALUES 
										('$kodeJurusan','$namaJurusan','$status')");
					echo '
						<h3>Sukses</h3>
						<script type="text/javascript">
							alert("Data Jurusan berhasil di tambah !");
							document.location.href="?page=jurusan";
						</script>
					';
				}
			}else{
				include "form-tambah.php";
			}
			break;

		case 'edit':
			if(isset($_POST['update'])){
				$kodeJurusan=$_POST['kodeJurusan'];
				$jurusan=$_POST['jurusan'];
				$status=isset($_POST['status'])?$_POST['status']:"";
				$simpan=mysqli_query($conn,"UPDATE `jurusan` SET `namaJurusan`='$jurusan', `status`='$status' WHERE 
									`kodeJurusan`='$kodeJurusan'");
				if($simpan == true){
					echo '
						<h3>Sukses</h3>
						<script type="text/javascript">
							alert("Data berhasil terupdate !");
							document.location.href="?page=jurusan";
						</script>
					';
				}else{
					echo '
						<h3>Gagal</h3>
						<script type="text/javascript">
							alert("Data gagal terupdate !");
							document.location.href="?page=jurusan";
						</script>
					';					
				}
			}else{
				include "form-edit.php";
			}
			break;
		case 'hapus':
			echo '
				<h3>Proses Menghapus</h3>
				<script type="text/javascript">
					var pesan;
					pesan = confirm("Apakah Anda yakin Ingin menghapus data ini !");
					if(pesan==yes){
						';
						$kodeJurusan=$_GET['kode'];
						mysqli_query($conn,"DELETE FROM `jurusan` WHERE kodeJurusan='$kodeJurusan'");
			echo '
					}elseif(pesan==no){
						document.location.href="?page=jurusan";
					}
				</script>
			';
			break;
		
		default:
			
			break;
	}

}else{
	include "form-data.php";
}
?>