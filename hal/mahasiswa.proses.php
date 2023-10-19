<?php
if (isset($_POST['tambah'])) {
	?>
		<form action="?hal=mahasiswa&aksi" method="post">
		<h4>
		<div class="row tabel-data">
			<div class="col-md-9">
				<span>Tambah Data Mahasiswa</span>
			</div>
			<div class="col-md-3 pull-right ">
				<input type="submit" class="btn btn-success" id="simpan" name="simpan" value="Simpan">
			</div>
		</div>
		</h4>
		<div class="form-data">
		<div class="input-group tabel-data" style="margin-top:7px">
		 <span class="input-group-addon" id="sizing-addon3">Nomor Induk Mahasiswa</span>
		  <input type="text" name="no_reg" id="nim" class="form-control" required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="Nim ini sudah terdaftar?">
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:57px">Nama Mahasiswa</span>
		  <input type="text" name="nama" id="nama" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:65px">Jenis Kelamin</span>
		  <span class="input-group-addon"><label><input type="radio" name="kelamin" id="kelamin" value="l"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" name="kelamin" id="kelamin" value="p"></span><input type="text" value="Perempuan" readonly class="form-control"></label>
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
		  <input type="text" name="tempat_lahir" id="tempat_lahir" pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" class="form-control" required placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tanggal Lahir</span>
		  <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="form-control"  placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:115px">Alamat</span>
		  <textarea name="alamat" class="form-control" id="alamat" required  aria-describedby="sizing-addon3"></textarea>
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:67px">Nomor Telepon</span>
		  <input size="58" type="text" name="telepon" required pattern="^[0-9]{5,18}$" id="telp" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:110px">Jurusan</span>
		  <select name="kd_jurusan" id="jurusan" class="form-control">
		  	<option>Pilih jurusan</option>
		  	<option value="57">sistem informasi</option>
		  	<option value="55">teknik Informatika</option>
		  </select>
		</div>
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:61px">Tahun Angkatan</span>
		  <select name="thn_akademik" id="tahun" class="form-control">
		  	<option>Pilih Tahun Angkatan</option>';
		<?php  	
		  	$thn=date("Y");
		  	for ($tahun=1970; $thn >= $tahun ; $thn--) { 
		  		$tgl=$thn-1;
		  		echo '
		  			<option value="'.$tgl.'/'.$thn.'">'.$tgl.'/'.$thn.'</option>
		  		';
		  	}
		?>
		  </select>
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:104px">Status</span>
		  <span class="input-group-addon"><label><input type="radio" name="status" id="status" value="1"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" name="status" id="status" value="0"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>
		</div>
		</div>
		</form>
<?php
	
}elseif (isset($_POST['edit'])) {
	$no_reg=$_POST['kode'];
	$list=$crud->fetch("tpengguna","no_reg=".$no_reg);
	echo '
		<form action="?hal=mahasiswa&aksi" method="post">
		<h4>
		<div class="row tabel-data">
			<div class="col-md-9">
				<span>Edit Data Mahasiswa</span>
			</div>
			<div class="col-md-3 pull-right ">
				<input type="submit" class="btn btn-success" name="update" id="update" value="Update">
			</div>
		</div>
		</h4>
		<div class="form-data">
		<div class="input-group tabel-data" style="margin-top:7px">
		 <span class="input-group-addon" id="sizing-addon3">Nomor Induk Mahasiswa</span>
		  <input type="text" name="no_reg" value="'.$list[0]['no_reg'].'" readonly  aria-describedby="sizing-addon3">
		  <input type="hidden" name="no_reg" value="'.$list[0]['no_reg'].'">
		</div>

		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:57px">Nama Mahasiswa</span>
		  <input type="text" name="nama" value="'.$list[0]['nama'].'" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
		</div>
		<div class="input-group tabel-data" >
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:65px">Jenis Kelamin</span>';
		  if( $list[0]['kelamin'] == "l"){
		  	echo '
	  	 		<span class="input-group-addon"><label><input type="radio" name="kelamin" checked value="l"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
	  			<span class="input-group-addon"><label><input type="radio" name="kelamin" value="p"></span><input type="text" value="Perempuan" readonly class="form-control"></label>
			';
		  }elseif($list[0]['kelamin'] == "p"){
		  	echo '
	  	 		<span class="input-group-addon"><label><input type="radio" name="kelamin" value="l"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
	  			<span class="input-group-addon"><label><input type="radio" name="kelamin" checked value="p"></span><input type="text" value="Perempuan" readonly class="form-control"></label>
			';	
		  }else{
		  	echo '
	  	 		<span class="input-group-addon"><label><input type="radio" name="kelamin" value="l"></span><input type="text" value="Laki-Laki" readonly class="form-control"></label>
	  			<span class="input-group-addon"><label><input type="radio" name="kelamin" value="p"></span><input type="text" value="Perempuan" readonly class="form-control"></label>
			';
		  }
		echo '			
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
		  <input size="61" type="text" name="tempat_lahir" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" value="'.$list[0]['tempat_lahir'].'" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tangga Lahir</span>
		  <input size="61" type="text" name="tanggal_lahir" required value="'.$list[0]['tanggal_lahir'].'"  class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:117px">Alamat</span>
		  <textarea name="alamat" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" aria-describedby="sizing-addon3">'.$list[0]['alamat'].'</textarea>
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
		  <input size="58" type="text" id="nomor" name="telepon" pattern="^[0-9]{5,18}$" required value="'.$list[0]['telepon'].'" data-nomor="'.$list[0]['telepon'].'" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
		  <select name="kd_jurusan" class="form-control">
		  	<option>Pilih jurusan</option>';
		  	if($list[0]['kd_jurusan'] =="55"){
		  		echo '
		  	<option value="57">sistem informasi</option>
		  	<option value="55" selected="select">teknik Informatika</option>
		  		';
		  	}elseif($list[0]['kd_jurusan'] =="57"){
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
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:64px">Tahun Angkatan</span>
		  <select name="thn_akademik" class="form-control">
		  	<option>'.$list[0]['thn_akademik'].'</option>';
		  	$thn=date("Y");
		  	for ($tahun=1970; $thn >= $tahun ; $thn--) { 
		  		$tgl=$thn-1;
		  		echo '
		  			<option value="'.$tgl.'/'.$thn.'">'.$tgl.'/'.$thn.'</option>
		  		';
		  		$kiri=$tgl-1; $kanan=$thn-1;
		  		$ang=$kiri.'/'.$kanan;
		  		if($list[0]['thn_akademik']== $ang){
		  			$thn--;
		  		}
		  	}
		  echo '</select>
		</div>
		
		<div class="input-group tabel-data">
		  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:108px">Status</span>';
		  if( $list[0]['status'] == 1){
		  	echo '<span class="input-group-addon"><label><input type="radio" checked name="status" value="1"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" name="status" value="0"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>';
		  }elseif( $list[0]['status'] == 0){
		  	echo '<span class="input-group-addon"><label><input type="radio" name="status" value="1"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" checked name="status" value="0"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>';
		  }else{
		  	echo '<span class="input-group-addon"><label><input type="radio" name="status" value="1"></span><input type="text" value="Aktif" readonly class="form-control"></label>
		  <span class="input-group-addon"><label><input type="radio" name="status" value="0"></span><input type="text" value="Nonaktif" readonly class="form-control"></label>';
		  }
		echo '</div>
      </div>
      </form>';
}elseif (isset($_POST['hapus'])) {
	$kode=$_POST['kode'];
	$crud->delete("tpengguna","no_reg='$kode'");
	echo '
		<script type="text/javascript">
			document.location="?hal=mahasiswa";
			alert("Data berhasil terhapus!!");
		</script>';
}elseif(isset($_POST['simpan'])){
	$no_reg=$_POST['no_reg'];
	$nama=$_POST['nama'];
	$kelamin=$_POST['kelamin'];
	$tempat_lahir=$_POST['tempat_lahir'];
	$tanggal_lahir=$_POST['tanggal_lahir'];
	$alamat=$_POST['alamat'];
	$telepon=$_POST['telepon'];
	$kd_jurusan=$_POST['kd_jurusan'];
	$thn_akademik=$_POST['thn_akademik'];
	$status=$_POST['status'];
	$data= array('no_reg' => $no_reg, 
				'nama'=> $nama, 
				'kelamin'=> $kelamin, 
				'tempat_lahir'=> $tempat_lahir, 
				'tanggal_lahir'=> $tanggal_lahir,
				'alamat'=> $alamat,
				'telepon'=> $telepon,
				'kd_jurusan'=> $kd_jurusan,
				'thn_akademik'=> $thn_akademik,
				'status'=> $status,
				'jabatan'=> "mahasiswa");
	$cek=$crud->num("tpengguna","no_reg=".$no_reg);
	if($cek<1){
		$simpan=$crud->insert("tpengguna",$data);
			echo '
				<script type="text/javascript">
					document.location="?hal=mahasiswa";
					alert("Data berhasil tersimpan!!");
				</script>
			';
		
	}else{
		echo '
			<script type="text/javascript">
				alert("NIM yang anda masukkan sudah ada!!");
			</script>
		';
	}
}elseif(isset($_POST['update'])){
	$no_reg=$_POST['no_reg'];
	$nama=$_POST['nama'];
	$kelamin=$_POST['kelamin'];
	$tempat_lahir=$_POST['tempat_lahir'];
	$tanggal_lahir=$_POST['tanggal_lahir'];
	$alamat=$_POST['alamat'];
	$telepon=$_POST['telepon'];
	$kd_jurusan=$_POST['kd_jurusan'];
	$thn_akademik=$_POST['thn_akademik'];
	$status=$_POST['status'];
	$data= array('nama'=> $nama, 
				'kelamin'=> $kelamin, 
				'tempat_lahir'=> $tempat_lahir, 
				'tanggal_lahir'=> $tanggal_lahir,
				'alamat'=> $alamat,
				'telepon'=> $telepon,
				'kd_jurusan'=> $kd_jurusan,
				'thn_akademik'=> $thn_akademik,
				'status'=> $status,
				'pin'=> '1234',
				'jabatan'=> "mahasiswa");
	$crud->update("tpengguna",$data, "no_reg='$no_reg'");
	echo '
		<script type="text/javascript">
			document.location="?hal=mahasiswa";
			alert("berhasil mengupadate!!");
		</script>';
}elseif (isset($_POST['reset'])) {
	$nim = $_POST['nim'];
	$crud->jadwal("tpengguna","pin='1234'","no_reg = '$nim'");
	echo '
		<script type="text/javascript">
			document.location="?hal=mahasiswa";
			alert("PIN berhasil direset");
		</script>';
}else{
	echo '
		<script type="text/javascript">
			document.location="?hal=mahasiswa";
		</script>';
}
?>