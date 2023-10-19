<?php
	$nim=$_GET['nim'];
	$query=mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nim='$nim'");
	$tampil=mysqli_fetch_array($query);
	echo '
		<h3>Ubah Data Mahasiswa</h3>
		<form action="?page=mahasiswa&aksi=edit" method="post">
		<div class="input-group tabel-data" style="margin-top:7px">
		  <span class="input-group-addon" id="sizing-addon3">Nomor Induk Mahasiswa</span>
		  <input size="50" type="text" value="'.$tampil['nim'].'" disabled="disabled" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
		  <input type="hidden" name="nim" value="'.$tampil['nim'].'">
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:55px">Nama Mahasiswa</span>
		  <input size="57" type="text" name="nama"  value="'.$tampil['nama'].'" class="form-control" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:78px">Jenis Kelamin</span>';
		  if( $tampil['kelamin'] == "L"){
		  	echo '<span class="input-group-addon"><label><input type="radio" checked name="jk" value="L"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
				<span class="input-group-addon"><label><input type="radio" name="jk" value="P"></span><input type="text" value="Perempuan" readonly class="form-control"></label>';
		  }elseif($tampil['kelamin'] == "P"){
		  	echo '<span class="input-group-addon"><label><input type="radio" name="jk" value="L"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
				<span class="input-group-addon"><label><input type="radio" checked name="jk" value="P"></span><input type="text" value="Perempuan" readonly class="form-control"></label>';
		  }else{
		    echo '<span class="input-group-addon"><label><input type="radio" name="jk" value="L"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
				<span class="input-group-addon"><label><input type="radio" name="jk" value="P"></span><input type="text" value="Perempuan" readonly class="form-control"></label>';
		  }
	echo '			
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
		  <input size="61" type="text" name="tempatLahir" value="'.$tampil['tempatLahir'].'" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:81px">Tangga Lahir</span>
		  <input size="61" type="date" name="tglLahir" value="'.$tampil['tglLahir'].'" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:121px">Alamat</span>
		  <input size="67" type="text" name="alamat" value="'.$tampil['alamat'].'" class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
		  <input size="58" type="text" name="telepon" value="'.$tampil['telepon'].'" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
		  <select name="jurusan" class="form-control">
		  	<option>Pilih jurusan</option>';
		  	if($tampil['kodeJurusan'] =="55"){
		  		echo '
		  	<option value="57">sistem informasi</option>
		  	<option value="55" selected="select">teknik Informatika</option>
		  		';
		  	}elseif($tampil['kodeJurusan'] =="57"){
		  		echo '
		  	<option value="57" selected="select">sistem informasi</option>
		  	<option value="55" >teknik Informatika</option>
		  		';
		  	}else{
		  		echo '
		  	<option value="57" >sistem informasi</option>
		  	<option value="55" >teknik Informatika</option>
		  		';
		  	}
		  echo '
		  </select>
		</div>				  
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:61px">Tahun Angkatan</span>
		  <select name="angkatan" class="form-control">
		  	<option>'.$tampil['angkatan'].'</option>';
		  	$thn=date("Y");
		  	for ($tahun=1970; $thn >= $tahun ; $thn--) { 
		  		$tgl=$thn-1;
		  		echo '
		  			<option value="'.$tgl.'/'.$thn.'">'.$tgl.'/'.$thn.'</option>
		  		';
		  		$kiri=$tgl-1; $kanan=$thn-1;
		  		$ang=$kiri.'/'.$kanan;
		  		if($tampil['angkatan']== $ang){
		  			$thn--;
		  		}
		  	}
		  echo '</select>
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:124px">Status</span>';
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
		    <a href="?page=mahasiswa"><input type="button" class="btn btn-success" value="Batal"></a>
		  </div>
		</div>
	</form>
	';
?>