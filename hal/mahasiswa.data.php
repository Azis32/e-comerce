<?php
	//include "./conf/conn.php";
	//include "./conf/connect.php";
	$crud = new crud("localhost","root","F@ridi23","db_broadcast");
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Mahasiswa</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=mahasiswa&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table id="dt-mahasiswa" class="table table-striped table-bordered data">
				  <thead>
				    <tr>
				    	<th></th>
				    	<th>NIM</th>
				    	<th>Nama</th>
				    	<th>Prodi</th>
				    	<th>Angkatan</th>
				    	<th>Alamat</th>
				    	<th width="100">Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
			<?php
			$no=1;
			$row=$crud->select("tmahasiswa");
			foreach ($row as $list) {
				$tampil=$crud->select("tjurusan", "kd_jurusan='".$list['kd_jurusan']."'");
				?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$list['nim']?></td>
						<td><?=$list['nama']?></td>
						<td><?=$tampil[0]['nm_jurusan']?></td>
						<td><?=$list['thn_masuk']?></td>
						<td><?=$list['alamat']?></td>
						
						<td style="text-align:center"><div class="btn-group" role="group">
						  <form action="?hal=mahasiswa&aksi" method="post">
						  <input type="hidden" name="kode" value="<?=$list['nim']?>">
						  	<button type="button" class="btn btn-success radius" data-toggle="modal" data-target="#my<?=$list['nim']?>"><span class="glyphicon glyphicon-eye-open tombol"> </span></button>
						  	<button type="submit" name="edit" class="btn btn-warning radius"><span class="glyphicon glyphicon-pencil"> </span></button>
						  	<button type="submit" name="hapus" class="btn btn-danger radius" onClick="return confirm('Yakin ingin menghapus data ini?');"><span class="glyphicon glyphicon-trash"> </span></button> 
						  </form>
						</td>
					</tr>
					<!--modal lihat-->
					<div class="modal fade" id="my<?=$list['nim']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document" >
					    <div class="modal-content" style="background-color: rgb(242, 253, 242)">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h5 class="modal-title" id="myModalLabel" style="color:green"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"> </span> Biodata Mahasiswa (<small>nim: <?=$list['nim']?></small>)</h5>
					      </div>
					      <div class="modal-body">
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:55px">Nama Mahasiswa</span>
							  <input size="57" type="text" value="<?=$list['nama']?>" readonly class="form-control" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
							</div>
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
							  <input size="61" type="text" value="<?=$list['tmp_lahir']?>" readonly class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
							</div>
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:81px">Tangga Lahir</span>
							  <input size="61" type="text" value="<?=$list['tgl_lahir']?>" readonly class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
							</div>
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:78px">Jenis Kelamin</span>
							  <?php
							  if( $list['kelamin'] == "l"){
							  	echo '<input size="50" type="text" value="Laki-Laki" readonly class="form-control" aria-describedby="sizing-addon3">
										';
							  }elseif($list['kelamin'] == "p"){
							  	echo '<input size="50" type="text" value="Perempuan" readonly class="form-control"aria-describedby="sizing-addon3">
										';	
							  }else{
							  	echo '<input size="50" type="text" value="-" readonly class="form-control"aria-describedby="sizing-addon3">
										';
							  }?>			
							</div>
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:121px">Alamat</span>
							  <input size="67" type="text" value="<?=$list['alamat']?>" readonly class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
							</div>
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
							  <input size="58" type="text" value="<?=$list['telepon']?>" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							</div>
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
							  	<?php
							  	if($list['kd_jurusan'] =="55"){
							  		echo '
							  	<input size="58" type="text" value="Teknik Informatika" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							  		';
							  	}elseif($list['kd_jurusan'] =="57"){
							  		echo '
							  	<input size="58" type="text" value="Sistem Informasi" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							  		';
							  	}else{
							  		echo '
							  	<input size="58" type="text" value="-" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							  		';
							  	}?>
							  </select>
							</div>

							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:126px">Kelas</span>
							  <input size="67" type="text" value="<?=$list['kelas']?>" readonly class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
							</div>		
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:83px">Tahun Masuk</span>
							  <input size="57" type="text" value="<?=$list['thn_masuk']?>" readonly class="form-control" placeholder="Tahun angkatan" aria-describedby="sizing-addon3">
							</div>
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:122px">Status</span>
							  <?php
							  if( $list['status'] == "aktif"){
							  	echo '<input size="50" type="text" value="aktif" readonly class="form-control" aria-describedby="sizing-addon3">
										';
							  }elseif($list['status'] == "cuti"){
							  	echo '<input size="50" type="text" value="non aktif" readonly class="form-control" aria-describedby="sizing-addon3">
										';	
							  }else{
							  	echo '<input size="50" type="text" value="-" readonly class="form-control" aria-describedby="sizing-addon3">
										';
							  }
							  ?>
					      </div>
					      <div class="modal-footer">
					      <form action="?hal=mahasiswa&aksi" method="post">
					      	<input type="hidden" name="nim" class="form-control" value="<?=$list['no_reg']?>">
					        <button type="submit" name="reset" class="btn btn-primary">Reset PIN</button>			
					        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					      </form>		        
					      </div>
					    </div>
					  </div>
					</div>
			<?php
			}
			?>
				  </tbody>
				  </table>
				</div>
			
			</div>
		</div>
		<?php
}else{
	if (isset($_POST['tambah'])) {
		?>
			<form action="?hal=mahasiswa&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tambah Data Mahasiswa</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success pull-right" id="simpan" name="simpan" value="simpan">
						</div>
						<div class="col-md-3" style="padding-top: 5px;">
							<span class="input-group-addon pull-left" id="sizing-addon3">Nomor Induk Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nim" id="nim" class="form-control" required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3" data-toggle="popover" data-trigger="focus" title="Nomor Induk Mahasiswa">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:57px">Nama Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nama" id="nama" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:65px">Jenis Kelamin</span>
						</div>
						<div class="col-md-9" style="padding-top: 10px; padding-left: 1px">
							<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" value="l"> Laki-Laki</label>
						  	<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" value="p"> Perempuan</label>
						</div>
						<div class="col-md-3" style="padding-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input type="text" name="tmp_lahir" id="tempat_lahir" pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" class="form-control" required placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
						</div>
						
						<div class="col-md-3" style="padding-top: 10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Tanggal Lahir</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input type="date" name="tgl_lahir" id="tanggal_lahir" required class="form-control"  placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
						</div>

						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Jurusan</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="kd_jurusan" id="jurusan" class="form-control" onchange="setData(this.value)">
							  	<option>Pilih jurusan</option>
							  	<option value="57">sistem informasi</option>
							  	<option value="55">teknik Informatika</option>
							</select>
						</div>
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Kelas</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="kelas" id="kelas" class="form-control">
							  	<option>Pilih Kelas</option>
							</select>
						</div>
						
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:67px">Nomor Telepon</span>	
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input size="58" type="text" name="telepon" id="nomor" required pattern="^[0-9]{5,18}$" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>

						<div class="col-md-3" style="padding-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:61px">Tahun Masuk</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="thn_masuk" id="tahun" class="form-control">
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

						<div class="col-md-3" style="padding-top: 15px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Alamat</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<textarea name="alamat" class="form-control" id="alamat" required  aria-describedby="sizing-addon3"></textarea>
						</div>
						
						<div class="col-md-3" style="padding-top: 10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:104px">Status</span>
						</div>
						<div class="col-md-9" style="padding-top: 15px">
							<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" id="status" value="aktif"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status" id="status" value="cuti"> Cuti</label>
						</div>			
					</div>
				</div>
			</div>
			</form>
		
	<?php
		
	}elseif (isset($_POST['edit'])) {
		$nim=$_POST['kode'];
		$list=$crud->select("tmahasiswa","nim=".$nim);
		?>
			<form action="?hal=mahasiswa&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Mahasiswa</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" name="update" class="btn btn-success pull-right" id="update" value="update">
						</div>
						<div class="col-md-3" style="padding-top: 5px;">
							<span class="input-group-addon pull-left" id="sizing-addon3">Nomor Induk Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nim" id="no_reg" readonly value="<?=$list[0]['nim']?>" class="form-control" required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="Nim ini sudah terdaftar?">
							<input type="hidden" name="nim" value="<?=$list[0]['nim']?>">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:57px">Nama Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nama" id="nama" value="<?=$list[0]['nama']?>" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:65px">Jenis Kelamin</span>
						</div>
						<div class="col-md-9" style="padding-top: 10px; padding-left: 1px">
							<?php
							if( $list[0]['kelamin'] == "l"){
						  	?>
							<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" checked value="l"> Laki-Laki</label>
						  	<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" value="p"> Perempuan</label>
							<?php 
							}elseif($list[0]['kelamin'] == "p"){
							?>
							<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" value="l"> Laki-Laki</label>
						  	<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" checked value="p"> Perempuan</label>
						  	<?php
						  	}else{
						  	?>
						  	<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" value="l"> Laki-Laki</label>
						  	<label class="col-md-3"><input type="radio" name="kelamin" id="kelamin" value="p"> Perempuan</label>
						  	<?php }?>
						</div>
						<div class="col-md-3" style="padding-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input type="text" name="tmp_lahir" value="<?=$list[0]['tmp_lahir']?>" id="tempat_lahir" pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" class="form-control" required placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
						</div>
						
						<div class="col-md-3" style="padding-top: 10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Tanggal Lahir</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input type="date" name="tgl_lahir" id="tanggal_lahir" value="<?=$list[0]['tgl_lahir']?>" required class="form-control"  placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
						</div>

						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Jurusan</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="kd_jurusan" id="jurusan" data-jurusan="<?=$list[0]['kd_jurusan']?>" class="form-control jurusan" onchange="setData(this.value)">
							  	<option>Pilih jurusan</option>
							  	<option value="57">sistem informasi</option>
							  	<option value="55">teknik Informatika</option>
							</select>
						</div>
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Kelas</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="kelas" id="kelas" data-kelas="<?=$list[0]['kelas']?>"" class="form-control">
							  	<option>Pilih Kelas</option>
							</select>
						</div>
						
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:67px">Nomor Telepon</span>	
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input size="58" type="text" name="telepon" id="nomor" value="<?=$list[0]['telepon']?>" data-nomor="<?=$list[0]['telepon']?>" required pattern="^[0-9]{5,18}$" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>

						<div class="col-md-3" style="padding-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:61px">Tahun Masuk</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="thn_masuk" id="tahun" data-tahun="<?=$list[0]['thn_masuk']?>" class="form-control tahun">
							  	<option>Pilih Tahun</option>';
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

						<div class="col-md-3" style="padding-top: 15px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Alamat</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<textarea name="alamat" class="form-control" id="alamat" required  aria-describedby="sizing-addon3"><?=$list[0]['alamat']?></textarea>
						</div>
						<div class="col-md-3" style="padding-top: 10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:104px">Status</span>
						</div>
						<div class="col-md-9" style="padding-top: 15px">
							<?php if( $list[0]['status'] == "aktif"){?>
								<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" id="status" checked value="aktif"> Aktif</label>
							  	<label class="col-md-3"><input type="radio" name="status" id="status" value="cuti"> Cuti</label>
						  	<?php }elseif ($list[0]['status'] == "cuti") {?>
							  	<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" id="status" value="aktif"> Aktif</label>
							  	<label class="col-md-3"><input type="radio" name="status" id="status" checked value="cuti"> Cuti</label>
						  	<?php }else{?>
							  	<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" id="status" value="aktif"> Aktif</label>
							  	<label class="col-md-3"><input type="radio" name="status" id="status" value="cuti"> Cuti</label>
						  	<?php }?>
						</div>			
					</div>
				</div>
			</div>
			</form>
			<script type="text/javascript">
				
			</script>
	<?php
	}elseif (isset($_POST['hapus'])) {
		$nim=$_POST['kode'];
		$crud->delete("tmahasiswa","nim='$nim'");
		echo '
			<script type="text/javascript">
				document.location="?hal=mahasiswa";
				alert("Data berhasil terhapus!!");
			</script>';
	}elseif(isset($_POST['simpan'])){
		$nim=$_POST['nim'];
		$nama=$_POST['nama'];
		$kelamin=$_POST['kelamin'];
		$tempat_lahir=$_POST['tmp_lahir'];
		$tanggal_lahir=$_POST['tgl_lahir'];
		$alamat=$_POST['alamat'];
		$telepon=$_POST['telepon'];
		$kd_jurusan=$_POST['kd_jurusan'];
		$kelas = $_POST['kelas'];
		$thn_akademik=$_POST['thn_masuk'];
		$status=$_POST['status'];
		$data= array('nim' => $nim, 
					'nama'=> $nama, 
					'kelamin'=> $kelamin, 
					'tmp_lahir'=> $tempat_lahir, 
					'tgl_lahir'=> $tanggal_lahir,
					'alamat'=> $alamat,
					'kelas' => $kelas,
					'telepon'=> $telepon,
					'kd_jurusan'=> $kd_jurusan,
					'thn_masuk'=> $thn_akademik,
					'status'=> $status);
		$cek=$crud->num("tmahasiswa","nim =".$nim);
		if($cek<1){
			$simpan=$crud->insert("tmahasiswa",$data);
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
		$nim=$_POST['nim'];
		$nama=$_POST['nama'];
		$kelamin=$_POST['kelamin'];
		$tempat_lahir=$_POST['tmp_lahir'];
		$tanggal_lahir=$_POST['tgl_lahir'];
		$alamat=$_POST['alamat'];
		$telepon=$_POST['telepon'];
		$kd_jurusan=$_POST['kd_jurusan'];
		$kelas = $_POST['kelas'];
		$thn_akademik=$_POST['thn_masuk'];
		$status=$_POST['status'];
		$data= array('nama'=> $nama, 
					'kelas'=> $kelas,
					'kelamin'=> $kelamin, 
					'tmp_lahir'=> $tempat_lahir, 
					'tgl_lahir'=> $tanggal_lahir,
					'alamat'=> $alamat,
					'telepon'=> $telepon,
					'kd_jurusan'=> $kd_jurusan,
					'thn_masuk'=> $thn_akademik,
					'status'=> $status);
		$crud->update("tmahasiswa",$data, "nim='$nim'");
		echo '
			<script type="text/javascript">
				document.location="?hal=mahasiswa";
				alert("berhasil mengupadate!!");
			</script>';
	}elseif (isset($_POST['reset'])) {
		$nim = $_POST['nim'];
		$crud->updateSingel("tmahasiswa","pin='1234'","nim = '$nim'");
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
}
?>
<script type="text/javascript">
	function setData(val){
		$.ajax({
	  		type: "POST",
	  		url: "hal/simpanjadwal.php",
	  		data: "kd_jurusan="+val,
	  		success: function(data){
	  			$('#kelas').html(data);
	  		}
	  	});
	}
	var jurusan = $('#jurusan').data("jurusan");
	var tahun = $('#tahun').data("tahun");
	var kelas = $('#kelas').data("kelas");
	$('.jurusan').val(jurusan);
	$('.tahun').val(tahun);
	var val = $('#jurusan').val();
	$.ajax({
  		type: "POST",
  		url: "hal/simpanjadwal.php",
  		data: "kd_jurusan="+val,
  		success: function(data){
  			$('#kelas').html(data);
		  	if(undefined != val) $('#kelas').val(kelas);
  		}
  	});
	
	$('#nim').on('blur',function(){
		var nim = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'hal/validasi.php?v=nim',
			data: "nim="+nim,
			success: function(data){
				if(data == "ada"){
					$('#simpan').prop('disabled', true);
					$('#nomor').prop('disabled', true);
					alert("Nomor Induk Mahasiswa ini sudah terdaftar");
				}else{
					$('#simpan').prop('disabled', false);
					$('#nomor').prop('disabled', false);
				}
				
			}

		})
	})
	if($('#update').val() == 'update'){
		$('#nomor').on('blur',function(){
		var nomor = $(this).val();
		var nomorawal = $(this).data('nomor');
			$.ajax({
				type: 'POST',
				url: 'hal/validasi.php?v=nomoredit',
				data: "nomor="+nomor+"&nomorawal="+nomorawal,
				success: function(data){
					if(data == "ada"){
						$('#update').prop('disabled', true);
						alert("Nomor telepon sudah terdaftar !");
					}else{
						$('#update').prop('disabled', false);
					}
					
				}

			})
		})
	}
	if($('#simpan').val() == 'simpan'){	
		$('#nomor').on('blur',function(){
		var nomor = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'hal/validasi.php?v=nomor',
			data: "nomor="+nomor,
			success: function(data){
				if(data == "ada"){
					$('#simpan').prop('disabled', true);
					$('#nim').prop('disabled', true);
					alert("Nomor telepon sudah terdaftar");
				}else{
					$('#simpan').prop('disabled', false);
					$('#nim').prop('disabled', false);
				}
				
			}

		})
		})
	}
</script>
