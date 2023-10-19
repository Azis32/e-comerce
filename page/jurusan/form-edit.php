<?php
	$kodeJurusan=$_GET['kode'];
	$query=mysqli_query($conn,"SELECT * FROM jurusan WHERE kodeJurusan='$kodeJurusan'");
	$tampil=mysqli_fetch_array($query);
	echo '
		<h3>Ubah Data Mahasiswa</h3>
		<form action="?page=jurusan&aksi=edit" method="post">
		<div class="input-group tabel-data" style="margin-top:7px">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:15px">Kode Jurusan</span>
		  <input size="50" type="text" value="'.$tampil['kodeJurusan'].'" disabled="disabled" class="form-control" placeholder="Kode Jurusan" aria-describedby="sizing-addon3">
		  <input type="hidden" name="kodeJurusan" value="'.$tampil['kodeJurusan'].'">
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" >Nama Jurusan</span>
		  <input size="57" type="text" name="jurusan"  value="'.$tampil['namaJurusan'].'" class="form-control" placeholder="Nama jurusan" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:62px">Status</span>';
		  if( $tampil['status'] == "aktif"){
		  	echo '<span class="input-group-addon"><label><input type="radio" checked name="status" value="aktif"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" name="status" value="nonaktif"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>';
		  }elseif( $tampil['status'] == "nonaktif"){
		  	echo '<span class="input-group-addon"><label><input type="radio" name="status" value="aktif"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" checked name="status" value="nonaktif"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>';
		  }else{
		  	echo '<span class="input-group-addon"><label><input type="radio" name="status" value="aktif"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" name="status" value="nonaktif"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>';
		  }
		echo '</div>
		<div class="btn-group btn-group-justified tabel-data" style="width:825px">
		  <div class="btn-group" role="group">
		    <input type="submit" class="btn btn-success" name="update" value="Update">
		  </div>
		  <div class="btn-group" role="group">
		    <a href="?page=jurusan"><input type="button" class="btn btn-success" value="Batal"></a>
		  </div>
		</div>
	</form>
	';
?>