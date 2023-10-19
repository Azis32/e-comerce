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
	echo '
		<h3>Data Pengguna</h3>
		<a href="?page=pengguna&aksi=tambah"><button class="btn btn-success tombol-tambah" ><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></a>
		<div class="panel panel-default tabel-data tabel-border" style="margin-top:10px">

		  <!-- Table -->
		  <table class="table table-striped table-bordered data datatable-sms ">
		  <thead>
		    <tr>
		    	<th>No</th>
		    	<th>Username</th>
		    	<th>Nama Lengkap</th>
		    	<th>Level</th>
		    	<th>Aksi</th>
		    </tr>
		  </thead>
		  <tbody>
	';
	$queriDosen=mysqli_query($conn,"SELECT * FROM user");
	$data=mysqli_num_rows($queriDosen);
	if($data>0){
		$no=1;
		while ($rs=mysqli_fetch_array($queriDosen)) {
			echo '
				<tr>
					<td>'.$no++.'</td>
					<td>'.$rs['username'].'</td>
					<td>'.$rs['namaLengkap'].'</td>
					<td>'.$rs['level'].'</td>
					<td style="text-align:center" width="15%"><div class="btn-group" role="group">
					  <a href="?page=jurusan&aksi=edit&kode='.$rs['username'].'"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"> </span></button></a>
					  <a href="?page=jurusan&aksi=hapus&kode='.$rs['username'].'"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"> </span></button></a>
					</td>
				</tr>
			';
		}
	}
	echo '
		  </tbody>
		  </table>
		</div>
	';
}
?>