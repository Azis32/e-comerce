<?php
	echo '
		<h3>Data Mahasiswa</h3>
		<a href="?page=mahasiswa&aksi=tambah"><button class="btn btn-success tombol-tambah" ><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></a>
		<div class="panel panel-default tabel-data tabel-border" style="margin-top:10px">

		  <!-- Table -->
		  <table id="dt-mahasiswa" class="table table-striped table-bordered data">
		  <thead>
		    <tr>
		    	<th></th>
		    	<th>NIM</th>
		    	<th>Nama</th>
		    	<th>Alamat</th>
		    	<th>Aktif</th>
		    	<th width="18%">Aksi</th>
		    </tr>
		  </thead>
		  <tbody>
	';
	$queriMhs=mysqli_query($conn,"SELECT * FROM `mahasiswa`");
	$data=mysqli_num_rows($queriMhs);
	if($data>0){
		$no=1;
		while ($rs=mysqli_fetch_array($queriMhs)) {
			echo '
				<tr>
					<td>'.$no++.'</td>
					<td>'.$rs['nim'].'</td>
					<td>'.$rs['nama'].'</td>
					<td>'.$rs['alamat'].'</td>
					<td style="text-align:center;">';
					if($rs['status']=="aktif"){
						echo '
							<input type="checkbox" title="Status aktif" checked="checked" disabled="disabled">
						';
					}else{
						echo '
							<input type="checkbox" title="Status nonktif" disabled="disabled">
						';
					}
					echo '</td>
					<td style="text-align:center"><div class="btn-group" role="group">
					  <a href="#"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#my'.$rs['nim'].'"><span class="glyphicon glyphicon-eye-open tombol"> </span></button></a>
					  <a href="?page=mahasiswa&aksi=edit&nim='.$rs['nim'].'"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil"> </span></button></a>
					  <a href="?page=mahasiswa&aksi=hapus&nim='.$rs['nim'].'"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"> </span></button></a>
					</td>
				</tr>
			';
			echo '
				<!--modal lihat-->
				<div class="modal fade" id="my'.$rs['nim'].'"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document" >
				    <div class="modal-content" style="background-color: rgb(242, 253, 242)">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel" style="color:green"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"> </span> Biodata Mahasiswa</h4>
				      </div>
				      <div class="modal-body">';
				      include "lihat.php";
			echo '
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>				        
				      </div>
				    </div>
				  </div>
				</div>
			';
		}
	}else{
		echo '
			<tr>
				<td colspan="3">Data tidak ditemukan</td>
				<td><a href="?page=mahasiswa&aksi=tambah"><button class="btn btn-success"><span class="glyphicon glyphicon glyphicon-plus"> </span> </button></td></a>
			</tr>
		';
	}
	echo '
		  </tbody>
		  </table>
		</div>
	';
?>