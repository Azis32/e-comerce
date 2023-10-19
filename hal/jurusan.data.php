<?php
	//include "./conf/connect.php";
	$crud = new crud("localhost","root","F@ridi23","db_broadcast");
	include "./bootstrap/costum/costum.css";
if(!isset($_GET['aksi'])){
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Jurusan</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=jurusan&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table class="table table-striped table-bordered data datatable-sms ">
				  <thead>
				    <tr>
				    	<th>No</th>
				    	<th>Kode</th>
				    	<th>Nama</th>
				    	<th>status</th>
				    	<th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php
					$data=$crud->num("tjurusan");
					if($data>0){
						$no=1;
						$row=$crud->select("tjurusan");
						foreach ($row as $list) {
							?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$list['kd_jurusan']?></td>
							<td><?=$list['nm_jurusan']?></td>
							<td><?php echo $status = ($list['status']==1) ? "Aktif" : "Nonaktif"; ?></td>
							<td style="text-align:center" width="12%">
							<form method="post" action="?hal=jurusan&aksi">
								<input type="hidden" name="kode" value="<?=$list['kd_jurusan']?>">
								<button type="submit" name="edit" class="btn btn-warning radius"> <span class="glyphicon glyphicon-pencil"></span></button>
								<button type="submit" name="hapus" onClick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-danger radius"> <span class="glyphicon glyphicon-trash"></span></button>
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
<?php
}else{ 
	if (isset($_POST['edit'])) {
		$kd_jurusan=$_POST['kode'];
		$list=$crud->select("tjurusan","kd_jurusan=".$kd_jurusan);
		?>
			<form action="?hal=jurusan&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Jurusan</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success pull-right" id="update" name="update" value="Update">
						</div>
						<div class="col-md-3" style="margin-top:10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:47px">Kode Jurusan</span>
						</div>
						<div class="col-md-9" >
						  	<input type="text" class="form-control" name="kd_jurusan" required value="<?=$list[0]['kd_jurusan']?>" readonly  aria-describedby="sizing-addon3"><input type="hidden" name="kd_jurusan" value="<?=$list[0]['kd_jurusan']?>">
						</div>
						<div class="col-md-3" style="margin-top:10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:41px">Nama Jurusan</span>
						</div >
						<div class="col-md-9" style="margin-top:5px">
						  	<input type="text" name="nm_jurusan" value="<?=$list[0]['nm_jurusan']?>" pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" class="form-control" required placeholder="Nama jurusan" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top:10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:73px">Status</span>
						</div>
						<div class="col-md-9"  style="margin-top:15px">
						  	<?php if( $list[0]['status'] == 1){?>
						  	<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" checked value="1"> Aktif</label>
						  	<label class="col-md-3"><input type="radio" name="status"  value="0"> Nonaktif</label>
							<?php }elseif( $list[0]['status'] == 0){ ?>
							<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" value="1"> Aktif</label>
							<label class="col-md-3"><input type="radio" name="status" checked value="0"> Nonaktif</label>
							<?php }else{ ?>
							<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" value="1"> Aktif</label>
							<label class="col-md-3"><input type="radio" name="status" value="0"> Nonaktif</label>
							<?php }?>
						</div>
	      			</div>
	      		</div>
	      	</div>
	      </form>
	<?php
	}elseif(isset($_POST['update'])){
		$kd_jurusan=$_POST['kd_jurusan'];
		$nm_jurusan=$_POST['nm_jurusan'];
		$status=$_POST['status'];
		$data= array('nm_jurusan'=> $nm_jurusan, 
					'status'=> $status);
		$crud->update("tjurusan",$data, "kd_jurusan='$kd_jurusan'");
		echo '
			<script type="text/javascript">
				document.location="?hal=jurusan";
				alert("berhasil mengupadate!!");
			</script>';

	}elseif (isset($_POST['hapus'])) {
		$kode=$_POST['kode'];
		$crud->delete("tjurusan","kd_jurusan='$kode'");
		echo '
			<script type="text/javascript">
				document.location="?hal=jurusan";
				alert("berhasil terhapus!!");
			</script>';
	}elseif (isset($_POST['tambah'])) {
		?>
			<form action="?hal=jurusan&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tamabh Data Jurusan</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success pull-right" id="simpan" name="simpan" value="Simpan">
						</div>
						<div class="col-md-3" style="margin-top:10px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:47px">Kode Jurusan</span>
						</div>
						<div class="col-md-9" >
						  	<input type="number" class="form-control" name="kd_jurusan" required aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top:10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:41px">Nama Jurusan</span>
						</div >
						<div class="col-md-9" style="margin-top:5px">
						  	<input type="text" name="nm_jurusan" pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" class="form-control" required placeholder="Nama jurusan" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top:10px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:73px">Status</span>
						</div>
						<div class="col-md-9"  style="margin-top:15px">
							<label class="col-md-3" style="padding-left: 1px"><input type="radio" name="status" value="1"> Aktif</label>
							<label class="col-md-3"><input type="radio" name="status" value="0"> Nonaktif</label>
						</div>
	      			</div>
	      		</div>
	      	</div>
	      </form>
	<?php
	}elseif(isset($_POST['simpan'])){
		$kd_jurusan=$_POST['kd_jurusan'];
		$nm_jurusan=$_POST['nm_jurusan'];
		$status=$_POST['status'];
		$data= array('kd_jurusan' => $kd_jurusan, 
					'nm_jurusan'=> $nm_jurusan, 
					'status'=> $status);
		$cek=$crud->num("tjurusan","kd_jurusan=".$kd_jurusan);
		if($cek<1){
			$simpan=$crud->insert("tjurusan",$data);
				echo '
					<script type="text/javascript">
						document.location="?hal=jurusan";
						alert("berhasil menyimpan!!");
					</script>
				';
			
		}else{
			echo '
				<script type="text/javascript">
					alert("Kode jurusan yang anda masukkan sudah ada!!");
				</script>
			';
		}
	}
}
?>