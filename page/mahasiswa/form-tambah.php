<?php
echo '
	<h3>Tambah Data Mahasiswa</h3>
	<form action="?page=mahasiswa&aksi=tambah" method="post">
	<div class="input-group tabel-data" style="margin-top:7px">
	 <span class="input-group-addon" id="sizing-addon3">Nomor Induk Mahasiswa</span>
	  <input size="50" type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:55px">Nama Mahasiswa</span>
	  <input size="57" type="text" name="nama" class="form-control" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
	</div>

	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:78px">Jenis Kelamin</span>
	  <span class="input-group-addon"><label><input type="radio" name="jk" value="L"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
	  <span class="input-group-addon"><label><input type="radio" name="jk" value="P"></span><input type="text" value="Perempuan" readonly class="form-control"></label>
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
	  <input size="61" type="text" name="tempatLahir" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:81px">Tangga Lahir</span>
	  <input size="61" type="date" name="tglLahir" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:121px">Alamat</span>
	  <input size="67" type="text" name="alamat" class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
	  <input size="58" type="text" name="telepon" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
	  <select name="jurusan" class="form-control">
	  	<option>Pilih jurusan</option>
	  	<option value="57">sistem informasi</option>
	  	<option value="55">teknik Informatika</option>
	  </select>
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:61px">Tahun Angkatan</span>
	  <select name="angkatan" class="form-control">
	  	<option>Pilih Tahun Angkatan</option>';
	  	$thn=date("Y");
	  	for ($tahun=1970; $thn >= $tahun ; $thn--) { 
	  		$tgl=$thn-1;
	  		echo '
	  			<option value="'.$tgl.'/'.$thn.'">'.$tgl.'/'.$thn.'</option>
	  		';
	  	}
	  echo '</select>
	</div>
	
	<div class="input-group tabel-data">
	  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:124px">Status</span>
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