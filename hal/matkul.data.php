<?php 
	//include "./conf/connect.php";
	$crud = new crud("localhost","root","F@ridi23","db_broadcast");
	include "./bootstrap/costum/costum.css";
if(!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Mata Kuliah</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=matkul&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table class="table table-striped table-bordered data datatable-sms">
				  <thead>
				    <tr>
				    	<th></th>
				    	<th>Kode </th>
				    	<th>Nama</th>
				    	<th>SKS</th>
				    	<th>Smtr</th>
				    	<th>Jurusan</th>
				    	<th>Status</th>
				    	<th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				<?php
				$data=$crud->num("tmatkul");
				if($data>0){
					$no=1;
					$row=$crud->select("tmatkul");
					foreach ($row as $list) {
						?>
							<tr>
								<td width="5%"><?=$no++?></td>
								<td><?=$list['kd_matkul']?></td>
								<td><?=$list['nm_matkul']?></td>
								<td width="5%"><?=$list['sks']?></td>
								<td><?=$list['semester']?></td>
								<?php
								$jur=$list['kd_jurusan'];
								$tampil=$crud->select("tjurusan","kd_jurusan='$jur'");
								?>
								<td><?=$tampil[0]['nm_jurusan']?></td>
								<?php
								$status=($list['status']=="1")?"Aktif":"Nonaktif";?>
								<td ><?=$status?></td>
								<td style="text-align:center;" width="13%">
								<form method="post" action="?hal=matkul&aksi">
									<input type="hidden" name="kode" value="<?=$list['kd_matkul']?>">
									<button type="submit" name="edit" class="btn btn-warning radius"><span class="glyphicon glyphicon-pencil"> </span></button>	
									<button type="submit" name="hapus" onClick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-danger radius"><span class="glyphicon glyphicon-trash "> </span></button>
								</form>
								</td>
							</tr>
				<?php
					}
				}?>
					  </tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
<?php
}else{
	if (isset($_POST['tambah'])) {
		?>
			<form action="?hal=matkul&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tambah Data Mata Kuliah</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success pull-right" id="simpan" name="simpan" value="Simpan">
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:30px;">Kode Mata Kuliah</span>	
						</div>
						<div class="col-md-9">
						  <input type="number" name="kd_matkul" class="form-control" required placeholder="Kode mata kuliah" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:25px">Nama Mata Kuliah</span>
						</div>
						<div class="col-md-9">
						  	<input type="text" name="nm_matkul" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama mata kuliah" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Sistem Kredit Semester</span>
						</div>
						<div class="col-md-9">
							<select name="sks" class="form-control">
							  	<option>Pilih SKS</option>
							  	<?php
							  	for ($no=1; $no <= 6 ; $no++) { 
							  	?>
							  		<option value="<?=$no?>"><?=$no?></option>
							  	<?php
							  	}
							  	?>
							</select>
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:85px">Semester</span>
						</div>
						<div class="col-md-9">
						  	<select name="semester" class="form-control">
							  	<option>Pilih Semester</option>
							  	<?php
							  	for ($no=1; $no <= 8 ; $no++) { 
							  	?>
							  		<option value="<?=$no?>"><?=$no?></option>
							  	<?php
							  	}
							  	?>
						  	</select>
						</div>

						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:85px">Jurusan</span>
						</div>
						<div class="col-md-9">
						  <select name="kd_jurusan" class="form-control">
						  	<option>Pilih jurusan</option>
						  	<?php
						  	$jurusan=$crud->select("tjurusan");
						  	foreach ($jurusan as $data) {
						  	?>
						  			<option value="<?=$data['kd_jurusan']?>"><?=$data['nm_jurusan']?></option>
						  	<?php
						  	}
						  	?>
						  </select>
						</div>
			
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:79px">Status</span>
						</div>
						<div class="col-md-9" style="margin-top: 15px">
						  	<label class="col-md-3 pull-left" style="padding-left: 1px"><input type="radio" name="status" value="1"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status" value="0"> Nonaktif</label>
						</div>
					</div>
				</div>
			</div>
			</form>
	<?php		
	}elseif(isset($_POST['simpan'])){
		$kd_matkul=$_POST['kd_matkul'];
		$nm_matkul=$_POST['nm_matkul'];
		$sks=$_POST['sks'];
		$semester=$_POST['semester'];
		$kd_jurusan=$_POST['kd_jurusan'];
		$status=$_POST['status'];
		$data= array('kd_matkul' => $kd_matkul,  
					'nm_matkul'=> $nm_matkul, 
					'sks'=> $sks, 
					'semester' => $semester,
					'kd_jurusan'=> $kd_jurusan,
					'status'=> $status);
		$cek=$crud->num("tmatkul","kd_matkul=".$kd_matkul);
		if($cek<1){
			$simpan=$crud->insert("tmatkul",$data);
				echo '
					<script type="text/javascript">
						document.location="?hal=matkul";
						alert("berhasil menyimpan!!");
					</script>
				';
			
		}else{
			echo '
				<script type="text/javascript">
					alert("Kode matkul yang anda masukkan sudah ada!!");
				</script>
			';
		}
	} elseif (isset($_POST['edit'])) {
		$kode=$_POST['kode'];
		$list=$crud->select("tmatkul","kd_matkul=".$kode);
		?>
		<form action="?hal=matkul&aksi" method="post">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Mata Kuliah</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-warning pull-right" id="update" name="update" value="Update">
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:30px;">Kode Mata Kuliah</span>
						</div>
						<div class="col-md-9">
						  <input type="number" class="form-control" value="<?=$list[0]['kd_matkul']?>" required readonly aria-describedby="sizing-addon3">
						  <input type="hidden" name="kd_matkul" value="<?=$list[0]['kd_matkul']?>">
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:25px">Nama Mata Kuliah</span>
						</div>
						<div class="col-md-9">
						  	<input type="text" name="nm_matkul" value="<?=$list[0]['nm_matkul']?>" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama mata kuliah" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Sistem Kredit Semester</span>
						</div>
						<div class="col-md-9">
							<select name="sks" id="sks" class="form-control" data-sks="<?=$list[0]['sks']?>">
							  	<option>Pilih SKS</option>
							  	<?php
							  	for ($no=1; $no <= 6 ; $no++) { 
							  	?>
							  		<option value="<?=$no?>"><?=$no?></option>
							  	<?php
							  	}
							  	?>
							</select>
						</div>
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:85px">Semester</span>
						</div>
						<div class="col-md-9">
						  	<select name="semester" id="semester" class="form-control" data-semester="<?=$list[0]['semester']?>">
							  	<option>Pilih Semester</option>
							  	<?php
							  	for ($no=1; $no <= 8 ; $no++) { 
							  	?>
							  		<option value="<?=$no?>"><?=$no?></option>
							  	<?php
							  	}
							  	?>
						  	</select>
						</div>

						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:85px">Jurusan</span>
						</div>
						<div class="col-md-9">
						  <select name="kd_jurusan" id="jurusan" class="form-control" data-jurusan="<?=$list[0]['kd_jurusan']?>">
						  	<option>Pilih jurusan</option>
						  	<?php
						  	$jurusan=$crud->select("tjurusan");
						  	foreach ($jurusan as $data) {
						  	?>
						  			<option value="<?=$data['kd_jurusan']?>"><?=$data['nm_jurusan']?></option>
						  	<?php
						  	}
						  	?>
						  </select>
						</div>
			
						<div class="col-md-3" style="margin-top: 10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:79px">Status</span>
						</div>
						<div class="col-md-9" style="margin-top: 15px">
							<?php if ($list[0]['status'] == '1') { ?>
							  	<label class="col-md-3 pull-left" style="padding-left: 1px"><input type="radio" name="status" checked value="1"> Aktif</label>
							  	<label class="col-md-3"><input type="radio" name="status" value="0"> Nonaktif</label>
						  	<?php }elseif ($list[0]['status'] == '1'){ ?>
							  	<label class="col-md-3 pull-left" style="padding-left: 1px"><input type="radio" name="status" value="1"> Aktif</label>
							  	<label class="col-md-3"><input type="radio" name="status" checked value="0"> Nonaktif</label>
						  	<?php }else{?>
							  	<label class="col-md-3 pull-left" style="padding-left: 1px"><input type="radio" name="status" value="1"> Aktif</label>
							  	<label class="col-md-3"><input type="radio" name="status" value="0"> Nonaktif</label>
						  	<?php }?>
						</div>
					</div>
				</div>
			</div>
		</form>
		<script type="text/javascript">
			$(document).ready(function(){
				var sks = $('#sks').data('sks');
				var jurusan = $('#jurusan').data('jurusan');
				var semester = $('#semester').data('semester');
				$('#sks').val(sks);
				$('#jurusan').val(jurusan);
				$('#semester').val(semester);
			})
		</script>
	<?php		
	} elseif (isset($_POST['update'])){
		$kd_matkul=$_POST['kd_matkul'];
		$nm_matkul=$_POST['nm_matkul'];
		$sks=$_POST['sks'];
		$semester=$_POST['semester'];
		$kd_jurusan=$_POST['kd_jurusan'];
		$status=$_POST['status'];
		$data= array('nm_matkul'=> $nm_matkul, 
					'sks'=> $sks, 
					'semester'=> $semester, 
					'kd_jurusan'=> $kd_jurusan,
					'status'=> $status);
		$crud->update("tmatkul",$data, "kd_matkul='$kd_matkul'");
		echo '
			<script type="text/javascript">
				document.location="?hal=matkul";
				alert("berhasil mengupadate!!");
			</script>';
	} elseif (isset($_POST['hapus'])) {
		$kode=$_POST['kode'];
		$crud->delete("tmatkul","kd_matkul='$kode'");
		echo '
			<script type="text/javascript">
				document.location="?hal=matkul";
				alert("berhasil terhapus!!");
			</script>';
	}
			
}
?>