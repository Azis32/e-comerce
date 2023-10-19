<?php
	echo '
		<h3>Data Jurusan</h3>
		<a href="?page=jurusan&aksi=tambah"><button class="btn btn-success tombol-tambah" ><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></a>
		<div class="panel panel-default tabel-data tabel-border" style="margin-top:10px">

		  <!-- Table -->
		  <table class="table table-striped table-bordered data datatable-sms ">
		  <thead>
		    <tr>
		    	<th>No</th>
		    	<th>Kode</th>
		    	<th>Nama</th>
		    	<th>status</th>
		    	<th>Aksi</th>
		    </tr>
		  </thead>
		  <tbody>
	';
	$queriDosen=mysqli_query($conn,"SELECT * FROM jurusan");
	$data=mysqli_num_rows($queriDosen);
	if($data>0){
		$no=1;
		while ($rs=mysqli_fetch_array($queriDosen)) {
			echo '
				<tr>
					<td>'.$no++.'</td>
					<td>'.$rs['kodeJurusan'].'</td>
					<td>'.$rs['namaJurusan'].'</td>
					<td>'.$rs['status'].'</td>
					<td style="text-align:center" width="15%"><div class="btn-group" role="group">
					  <a href="?page=jurusan&aksi=edit&kode='.$rs['kodeJurusan'].'"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"> </span></button></a>
					  <a href="?page=jurusan&aksi=hapus&kode='.$rs['kodeJurusan'].'"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"> </span></button></a>
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