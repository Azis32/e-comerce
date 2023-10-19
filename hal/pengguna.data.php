<?php 
	//	include "./conf/connect.php";
	$crud = new crud("localhost","root","F@ridi23","db_broadcast");
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Dosen</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=pengguna&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table class="table table-striped table-bordered data datatable-sms ">
				  <thead>
				    <tr>
				    	<th>No</th>
				    	<th>NIP</th>
				    	<th>Nama</th>
				    	<th>Alamat</th>
				    	<th>telepon</th>
				    	<th>Jabatan</th>
				    	<th>Status</th>
				    	<th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
			<?php
			$data=$crud->num("tpegawai");
			if($data>0){
				$no=1;
				$row=$crud->select("tpegawai");
				foreach ($row as $list) {
					?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$list['nip']?></td>
						<td><?=$list['nama']?></td>
						<td><?=$list['alamat']?></td>
						<td><?=$list['telepon']?></td>
						<td><?=$list['jabatan']?></td>
						<td><?=$list['status']?></td>
						<td style="text-align:center" width="15%">
							<form action="?hal=pengguna&aksi" method="post">
								<input type="hidden" value="<?=$list['nip']?>" name="kode">
								<button type="submit" name="edit" class="btn btn-warning radius"><span class="glyphicon glyphicon-pencil"> </span></button> 
								<button type="submit" name="hapus" onClick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-danger radius"><span class="glyphicon glyphicon-trash"> </span></button>
							</form>
						</td>
					</tr>
					<?php
				}
			}
			?>
				  </tbody>
				  </table>
				</div>
			</div>
		</div>
	</div>
<?php
} else {
	if(isset($_POST['edit'])) {
		$nip=$_POST['kode'];
		$list=$crud->select("tpegawai","nip=".$nip);
		?>
			<form action="?hal=pengguna&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Pengguna</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-8">
						</div>
						<div class="col-md-4" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success col-lg-6" style="padding-left: 5px" id="reset" name="reset" value="Reset PIN"> 
							<input type="submit" class="btn btn-success col-md-6 pull-right" id="update" name="update" value="Update">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">Nomor Induk Pegawai</span>
						</div>
						<div class="col-md-9">
						  	<input type="number" class="form-control" value="<?=$list[0]['nip']?>" readonly required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Pegawai" aria-describedby="sizing-addon3">
						  	<input type="hidden" name="nip" value="<?=$list[0]['nip']?>">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Nama Pegawai</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nama" class="form-control" value="<?=$list[0]['nama']?>" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Pegawai" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Telepon</span>
						  
						</div>
						<div class="col-md-9">
							<input type="text" name="telepon" class="form-control" value="<?=$list[0]['telepon']?>" required placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>

						<div class="col-md-3" style="margin-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Password</span>
						  
						</div>
						<div class="col-md-9">
							<input type="text" name="pass" class="form-control" value="<?=$list[0]['password']?>" required placeholder="Kata Sandi" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Jabatan</span>
						  
						</div>
						<div class="col-md-9">
							<input type="text" name="jabatan" class="form-control" readonly value="<?=$list[0]['jabatan']?>" required placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">							 
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Alamat</span>
						</div>
						<div class="col-md-9">
							<textarea name="alamat" class="form-control" required aria-describedby="sizing-addon3"><?=$list[0]['alamat']?> </textarea>
						</div>
						<div class="col-md-3" style="margin-top: 10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:104px">Status</span>
						</div>
						<div class="col-md-9" style="margin-top: 15px; padding-left: 1px">
							<?php if ($list[0]['status'] == "aktif") {?>
							<label class="col-md-3"><input type="radio" name="status" checked value="aktif"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status" value="cuti"> Cuti</label>
						  	<?php }elseif ($list[0]['status'] == "cuti") {?>
							<label class="col-md-3"><input type="radio" name="status" value="aktif"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status" checked value="cuti"> Cuti</label>
						  	<?php }else {?>
							<label class="col-md-3"><input type="radio" name="status" value="aktif"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status" value="cuti"> Cuti</label>
						  	<?php }?>
						</div>
					</div>
				</div>
			</div>
			</form>
	<?php
	}elseif (isset($_POST['hapus'])) {
		$kode=$_POST['kode'];
		$crud->delete("tpegawai","nip='$kode'");
		echo '
			<script type="text/javascript">
				document.location="?hal=pengguna";
			</script>';
	}elseif (isset($_POST['tambah'])) {
		?>
			<form action="?hal=pengguna&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tambah Data Pegawai</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-8">
						</div>
						<div class="col-md-4" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success col-md-6 pull-right" id="simpan" name="simpan" value="Simpan">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">Nomor Induk Pegawai</span>
						</div>
						<div class="col-md-9">
						  	<input type="number" class="form-control" name="nip" required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Pegawai" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Nama Pegawai</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nama" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Pegawai" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Telepon</span>
						  
						</div>
						<div class="col-md-9">
							<input type="text" name="telepon" class="form-control" required placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Password</span>
						  
						</div>
						<div class="col-md-9">
							<input type="text" name="pass" class="form-control" required placeholder="Kata sandi" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  <span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:82px">Jabatan</span>
						  
						</div>
						<div class="col-md-9">
							<input type="text" name="jabatan" class="form-control" readonly value="moderator" required placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">							 
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Alamat</span>
						</div>
						<div class="col-md-9">
							<textarea name="alamat" class="form-control" required aria-describedby="sizing-addon3"> </textarea>
						</div>
						<div class="col-md-3" style="margin-top: 10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:104px">Status</span>
						</div>
						<div class="col-md-9" style="margin-top: 15px; padding-left: 1px">
							<label class="col-md-3"><input type="radio" name="status" value="aktif"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status" value="cuti"> Cuti</label>
						</div>
						
					</div>
				</div>
			</div>
			</form>
	<?php
		
	}elseif(isset($_POST['simpan'])){
		$nip=$_POST['nip'];
		$pass=$_POST['pass'];
		$nama=$_POST['nama'];
		$telepon=$_POST['telepon'];
		$alamat=$_POST['alamat'];
		$status = $_POST['status'];
		$cek=$crud->num("tpegawai","telepon = '$telepon'");
		if ($cek<1){
			$data= array('nip'=>$nip,
						'password'=> $pass, 
						'nama'=> $nama, 
						'telepon'=>$telepon,
						'alamat'=> $alamat, 
						'jabatan'=> "moderator");
			$cek=$crud->num("tpegawai","nip='$nip'");
			if($cek<1){
				$simpan=$crud->insert("tpegawai",$data);
					echo '
						<script type="text/javascript">
							document.location="?hal=pengguna";
							alert("berhasil menyimpan!!");
						</script>
					';
				
			}else{
				echo '
					<script type="text/javascript">
						alert("username yang anda masukkan sudah ada!!");
					</script>
				';
			}
		} else {
			?>
			<script type="text/javascript">
				alert("Nomor telepon sudah terdaftar!");
			</script>
			<?php
		}
	}elseif(isset($_POST['update'])){
		$nip=$_POST['nip'];
		$pass=$_POST['pass'];
		$nama=$_POST['nama'];
		$telepon=$_POST['telepon'];
		$alamat=$_POST['alamat'];
		$status = $_POST['status'];
		$cek=$crud->num("tpegawai","telepon = '$telepon'");
		$data= array('nip'=>$nip,
					'password'=> $pass, 
					'nama'=> $nama, 
					'telepon'=>$telepon,
					'alamat'=> $alamat,
					'status'=> $status);
		$simpan=$crud->update("tpegawai",$data,"nip='$nip'");
			echo '
				<script type="text/javascript">
					document.location="?hal=pengguna";
					alert("berhasil mengupdate!!");
				</script>
			';
	}

}
?>