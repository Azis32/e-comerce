<?php
echo '
	<h3>Tambah Data Jurusan</h3>
	<form action="?page=jurusan&aksi=tambah" method="post">
	<div class="input-group tabel-data" style="margin-top:7px">
	 <span class="input-group-addon" id="sizing-addon3" Style="padding-right:15px">Kode Jurusan</span>
	  <input size="50" type="text" name="kodeJurusan" class="form-control" placeholder="Kode Jurusan" aria-describedby="sizing-addon3">
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" >Nama Jurusan</span>
	  <input size="57" type="text" name="namaJurusan" class="form-control" placeholder="Nama Jurusan" aria-describedby="sizing-addon3">
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:62px">Status</span>
	  <span class="input-group-addon"><label><input type="radio" name="status" value="aktif"></span><input type="text" value="Aktif" readonly class="form-control"></label>
	  <span class="input-group-addon"><label><input type="radio" name="status" value="nonaktif"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>
	</div>
	<div class="btn-group btn-group-justified tabel-data" style="width:825px">
	  <div class="btn-group" role="group">
	    <input type="submit" class="btn btn-success" name="simpan" value="Simpan">
	  </div>
	  <div class="btn-group" role="group">
	    <input type="reset" class="btn btn-success" value="Batal">
	  </div>
	</div>
	</form>
			';
			//<a href="?page=mahasiswa&aksi=tambah&tombol=simpan">
?>