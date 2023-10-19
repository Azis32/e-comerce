<?php
echo '
		<div class="input-group tabel-data">
		  <h3>Nomor Induk Mahasiswa : '.$rs['nim'].'
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:78px">Jenis Kelamin</span>';
		  if( $rs['kelamin'] == "L"){
		  	echo '<input size="50" type="text" value="Laki-Laki" disabled="disabled" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
					';
		  }elseif($rs['kelamin'] == "P"){
		  	echo '<input size="50" type="text" value="Perempuan" disabled="disabled" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
					';	
		  }else{
		  	echo '<input size="50" type="text" value="-" disabled="disabled" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
					';
		  }
	echo '			
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:55px">Nama Mahasiswa</span>
		  <input size="57" type="text" value="'.$rs['nama'].'" disabled="disabled" class="form-control" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
		  <input size="61" type="text" value="'.$rs['tempatLahir'].'" disabled="disabled" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:81px">Tangga Lahir</span>
		  <input size="61" type="text" value="'.$rs['tglLahir'].'" disabled="disabled" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:121px">Alamat</span>
		  <input size="67" type="text" value="'.$rs['alamat'].'" disabled="disabled" class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
		  <input size="58" type="text" value="'.$rs['telepon'].'" disabled="disabled" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
		  ';
		  	if($rs['kodeJurusan'] =="55"){
		  		echo '
		  	<input size="58" type="text" value="Teknik Informatika" disabled="disabled" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		  		';
		  	}elseif($rs['kodeJurusan'] =="57"){
		  		echo '
		  	<input size="58" type="text" value="Sistem Informasi" disabled="disabled" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		  		';
		  	}else{
		  		echo '
		  	<input size="58" type="text" value="-" disabled="disabled" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		  		';
		  	}
		  echo '
		  </select>
		</div>		
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:61px">Tahun Angkatan</span>
		  <input size="57" type="text" value="'.$rs['angkatan'].'" disabled="disabled" class="form-control" placeholder="Tahun angkatan" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:124px">Status</span>
		  <input size="68" type="text" value="'.$rs['status'].'" disabled="disabled" class="form-control" placeholder="Status" aria-describedby="sizing-addon3">
		</div>
	';
	?>