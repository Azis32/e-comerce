<?php 
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
					  <a href="?page=jurusan&aksi=hapus&kode='.$rs['username'].'" onclick=""><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"> </span></button></a>
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
?>