<?php
echo '
	<h3>Tambah Data Pengguna</h3>
	<form action="?page=pengguna&aksi=tambah" method="post">
	<div class="input-group tabel-data" style="margin-top:7px">
	 <span class="input-group-addon" id="sizing-addon3" Style="padding-right:15px">Username</span>
	  <input size="50" type="text" name="username" class="form-control" placeholder="Username" aria-describedby="sizing-addon3">
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" >Password</span>
	  <input size="57" type="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon3">
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:62px">Level</span>
	  <span class="input-group-addon"><label><input type="radio" name="level" value="1"></span><input type="text" value="Super Admin" readonly class="form-control"></label>
	  <span class="input-group-addon"><label><input type="radio" name="level" value="2"></span><input type="text" value="Admin" readonly class="form-control"></label>
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" >Nama Lengkap</span>
	  <input size="57" type="password" name="nama" class="form-control" placeholder="Nama Lengkap" aria-describedby="sizing-addon3">
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