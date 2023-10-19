<?php
	include "./conf/conn.php";
	include "./bootstrap/costum/costum.css";

if(isset($_GET['aksi'])){
	switch ($_GET['aksi']) {
		case 'tambah':
			if(isset($_POST['simpan'])){
				$nim=$_POST['nim'];
				$nama=$_POST['nama'];
				$jk=isset($_POST['jk'])?$_POST['jk']:"";
				$tempatLahir=$_POST['tempatLahir'];
				$tglLahir=$_POST['tglLahir'];
				$alamat=$_POST['alamat'];
				$telepon=$_POST['telepon'];
				$jurusan=$_POST['jurusan'];
				$angkatan=$_POST['angkatan'];
				$status=isset($_POST['status'])?$_POST['status']:"";
				$query=mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nim='$nim'");
				$cek=mysqli_num_rows($query);
				if($cek>0){
					echo '
						<h3>Gagal</h3>
						<script type="text/javascript">
							alert("NIM yang anda masukkan sudah ada !");
							document.location.back();
						</script>
					';
				}else{
					$simpan=mysqli_query($conn,"INSERT INTO `mahasiswa`(`nim`, `nama`, `kelamin`, `tempatLahir`, `tglLahir`, 
										`alamat`, `telepon`, `kodeJurusan`, `angkatan`, `status`) VALUES 
										('$nim','$nama','$jk','$tempatLahir','$tglLahir','$alamat','$telepon',
										'$jurusan','$angkatan','$status')");
					echo '
						<h3>Sukses</h3>
						<script type="text/javascript">
							alert("Data berhasil di tambah !");
							document.location.href="?page=mahasiswa";
						</script>
					';
				}
			}else{
				include "form-tambah.php";
			}
			
			break;

		case 'edit':
			if(isset($_POST['update'])){
				$nim=$_POST['nim'];
				$nama=$_POST['nama'];
				$jk=isset($_POST['jk'])?$_POST['jk']:"";
				$tempatLahir=$_POST['tempatLahir'];
				$tglLahir=$_POST['tglLahir'];
				$alamat=$_POST['alamat'];
				$telepon=$_POST['telepon'];
				$jurusan=$_POST['jurusan'];
				$angkatan=$_POST['angkatan'];
				$status=isset($_POST['status'])?$_POST['status']:"";
				$simpan=mysqli_query($conn,"UPDATE mahasiswa SET `nama`='$nama', `kelamin`='$jk', 
									`tempatLahir`='$tempatLahir', `tglLahir`='$tglLahir',`alamat`='$alamat', 
									`telepon`='$telepon', `kodeJurusan`='$jurusan', `angkatan`='$angkatan', 
									`status`='$status' WHERE `nim`='$nim'");
				if($simpan == true){
					echo '
						<h3>Sukses</h3>
						<script type="text/javascript">
							alert("Data berhasil terupdate !");
							document.location.href="?page=mahasiswa";
						</script>
					';
				}else{
					echo '
						<h3>Gagal</h3>
						<script type="text/javascript">
							alert("Data gagal terupdate !");
							document.location.href="?page=mahasiswa";
						</script>
					';					
				}
			}else{
				include "form-edit.php";
			}
			break;
		case 'hapus':
			echo '
				<h3>Proses Menghapus</h3>
				<script type="text/javascript">
					var pesan;
					pesan = confirm("Apakah Anda yakin Ingin menghapus data ini !");
					if(pesan==yes){
						';
						$nim=$_GET['nim'];
						mysqli_query($conn,"DELETE FROM `mahasiswa` WHERE nim='$nim'");
			echo '
					}elseif(pesan==no){
						document.location.href="?page=mahasiswa";
					}
				</script>
			';
			break;
		case 'lihat':
			$nim=$_GET['nim'];
			$query=mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nim='$nim'");
			$tampil=mysqli_fetch_array($query);
			echo '
				<h3>Biodata Mahasiswa</h3>
				<a href="?page=mahasiswa"><button class="btn btn-success tombol-tambah" ><span class="glyphicon glyphicon-arrow-left"> </span> Kembali </button></a>
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3">Nomor Induk Mahasiswa</span>
				  <input size="50" type="text" value="'.$tampil['nim'].'" disabled="disabled" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
				</div>

				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:78px">Jenis Kelamin</span>';
				  if( $tampil['kelamin'] == "L"){
				  	echo '<input size="50" type="text" value="Laki-Laki" disabled="disabled" class="form-control" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3">
							';
				  }elseif($tampil['kelamin'] == "P"){
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
				  <input size="57" type="text" value="'.$tampil['nama'].'" disabled="disabled" class="form-control" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
				</div>
				
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:82px">Tempat Lahir</span>
				  <input size="61" type="text" value="'.$tampil['tempatLahir'].'" disabled="disabled" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
				</div>
				
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:81px">Tangga Lahir</span>
				  <input size="61" type="text" value="'.$tampil['tglLahir'].'" disabled="disabled" class="form-control" placeholder="Tempat Lahir" aria-describedby="sizing-addon3">
				</div>
				
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:121px">Alamat</span>
				  <input size="67" type="text" value="'.$tampil['alamat'].'" disabled="disabled" class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
				</div>
				
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
				  <input size="58" type="text" value="'.$tampil['telepon'].'" disabled="disabled" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
				</div>
				
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
				  ';
				  	if($tampil['kodeJurusan'] =="55"){
				  		echo '
				  	<input size="58" type="text" value="Teknik Informatika" disabled="disabled" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
				  		';
				  	}elseif($tampil['kodeJurusan'] =="57"){
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
				  <input size="57" type="text" value="'.$tampil['angkatan'].'" disabled="disabled" class="form-control" placeholder="Tahun angkatan" aria-describedby="sizing-addon3">
				</div>
				
				<div class="input-group tabel-data">
				  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:124px">Status</span>
				  <input size="68" type="text" value="'.$tampil['status'].'" disabled="disabled" class="form-control" placeholder="Status" aria-describedby="sizing-addon3">
				</div>
			';
			break;
	}

}else{
	include "form-data.php";
}
?>