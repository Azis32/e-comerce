
<?php
session_start();
if (isset($_SESSION['level'])) {
	if ($_SESSION['level'] == "admin") {

?>
<title>Halaman serverSms</title>
<meta http-equiv="refresh" content="3;url=serverSms.php">
<h1>Server SMS Running..., jangan di tutup!</h1>

<?php		
require __DIR__ . '/conf/connect.php';

//===menangambil data isi pesan,noPengirim, dari inbox dengan field Processed bernilai false, yang menandakan bahwa pesan masuk belum diproses====
$crud = new crud("localhost","root","F@ridi23","db_broadcast");
$pesan = $crud->select("inbox", " Processed = 'false' ");
$ide = "";
$replyPesan = "";
$nomor = "";
$pesanAwal="";
if (count($pesan)>0) {
	foreach ($pesan as $list) {
		//---------------------------untu melihat apakah pengirim apakah operator atau nomor biasa ---------------------------------------
		$SenderNumber = "0".substr($list['SenderNumber'],3);
		if (is_numeric($SenderNumber)) {
			$cek_pgw = $crud->num("tpegawai","telepon = '$SenderNumber' AND status='aktif'");
			$cek_pin_pgw = $crud->select("tpegawai","telepon = '$SenderNumber'");
			$cek_dsn = $crud->num("tdosen","telepon = '$SenderNumber' AND status='aktif'");
			$cek_pin_dsn = $crud->select("tdosen","telepon = '$SenderNumber'");
			$isi = $list['TextDecoded'];
			$bagi = explode("#", $isi);
			//---------------------prose untuk mengecek pengirim apakah sebagai pegawai -------------------------------------------------
			if ($cek_pgw>0) {
				if (count($bagi) == 1) {
					//-------------------untuk balasan mengecek format pesan ------------------------------------------------------------
					if (strtolower($bagi[0]) == "cek") {
						$replyPesan .= "INFO#DOSEN#pin#text, ";
						$replyPesan .= "INFO#MHS#pin#text, ";
						$replyPesan .= "CH#pinbaru#pinlama -> Ganti pin";
						$ide = $list['ID'];
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
						$ide = $list['ID'];
					}
					//--------------------------penutup balasan mengecek format pesan---------------------------------------------------
				} elseif (count($bagi) == 3){
					//--------------------------untuk balasan mengganti PIN ------------------------------------------------------------
					if (strtolower($bagi[0]) == "ch") {
						$pin = $bagi[2];
						$pinbaru = $bagi[1];
						if ($pin == $cek_pin_pgw[0]['pin']) {
							$ubah = $crud->updateSingel("tpegawai","pin = '$pinbaru'", "telepon = '$SenderNumber'");
							if ($ubah) {
								$replyPesan .= "Proses ubah PIN berhasil. PIN Baru: ".$pinbaru;
								$ide = $list['ID'];
							} else {
								$replyPesan .= "Proses ubah PIN saat ini tidak dapat dilakukan";
								$ide = $list['ID'];
							}
						}else{
							$replyPesan .= "Pin lama yang anda masukkan salah !";
							$ide = $list['ID'];
						}
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
						$ide = $list['ID'];
					}
					//--------------------------penutup balasan mangecek format pesan --------------------------------------------------
				}elseif(count($bagi) == 4){
					//--------------------------untuk balasan mengirim pesan ke Dosen --------------------------------------------------
					if ((strtolower($bagi[0]) == "info") AND (strtolower($bagi[1]) == "dosen")) {
						if ($cek_pin_pgw[0]['pin'] == $bagi[2]) {
							$data_dosen = $crud->select("tdosen","status = 'aktif'");
							foreach ($data_dosen as $value) {
								$pesan = "Info Akademik: ".$bagi[3]." ttd. Bag Akademik";
								$row = array('DestinationNumber' => $value['telepon'], 'TextDecoded' => $pesan);
								$crud->insert("outbox", $row);
								$simpan = array('penerima' => $value['telepon'], 'text' => $pesan, 'tanggal'=> date("d-m-Y"));
								$crud->insert("tem_broadcast", $simpan);
							}
							$replyPesan .= "Pesan Telah di Broadcast Ke Dosen";
							$ide = $list['ID'];
						}else{
							$replyPesan .= "Pin anda masukkan salah !";
							$ide = $list['ID'];
						}
					//--------------------------untuk balasan mengirim pesan ke mahasiswa --------------------------------------------------
					}elseif((strtolower($bagi[0]) == "info") AND (strtolower($bagi[1]) == "mhs")){
						if ($cek_pin_pgw[0]['pin'] == $bagi[2]) {
							$data_dosen = $crud->select("tmahasiswa","status = 'aktif'");
							foreach ($data_dosen as $value) {
								$pesan = "Info Akademik: ".$bagi[3]." ttd. Bag Akademik";
								$row = array('DestinationNumber' => $value['telepon'], 'TextDecoded' => $pesan);
								$crud->insert("outbox", $row);
								$simpan = array('penerima' => $value['telepon'], 'text' => $pesan, 'tanggal'=> date("d-m-Y"));
								$crud->insert("tem_broadcast", $simpan);
							}
							$replyPesan .= "Pesan Telah di Broadcast Ke Mahasiswa";
							$ide = $list['ID'];
						}else{
							$replyPesan .= "Pin anda masukkan salah !";
							$ide = $list['ID'];
						}
					} elseif (strtolower($bagi[0]) == "daftar") {
						$nim = $bagi[1];
						$no = $bagi[2];
						$pin = $bagi[3];
						if ($pin == $cek_pin_pgw[0]['pin']) {
							$cari = $crud->num('tmahasiswa',"telepon = '$no' OR nim='$nim'");
							if ($cari>0) {
								$replyPesan .= "NIM atau Nomor Telepon Sudah Terdaftar !";
								$ide = $list['ID'];
							}else{
								$data = array('nim' => $nim, 'nama' => 'test', 'tmp_lahir' => 'test', 'tgl_lahir' => '2000-12-01','kd_jurusan' => '55','kelamin'=>'l','kelas' => 'A','thn_masuk' => '2015/2016', 'alamat' => 'test', 'status' => 'aktif','telepon' => $no, 'pin' => '1234');
								$crud->insert('tmahasiswa',$data);
								$kirim = array('DestinationNumber' => $no, 'TextDecoded' => "Nomor Anda telah aktif dengan username $nim dan password $no");
								$crud->insert('outbox',$kirim);
								$replyPesan .= "Tambah Mahasiswa Berhasil !";
								$ide = $list['ID'];
							}
						}else{
							$replyPesan .= "Pin anda masukkan salah !";
							$ide = $list['ID'];
						}
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server".$bagi[0]."-".$bagi[1];
						$ide = $list['ID'];
					}
				}else{
					$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
					$ide = $list['ID'];
				}
			//--------------------------untuk melihat mengirim apakah dosen --------------------------------------------------------------
			} elseif($cek_dsn>0){
				if (count($bagi) == 1) {
					//-------------------untuk balasan mengecek format pesan ------------------------------------------------------------
					if (strtolower($bagi[0]) == "cek") {
						$replyPesan .= "CEKMK#pin->Cek kode Matkul, ";
						$replyPesan .= "INFO#kodematkul#kelas#pin#text->Pesan ke mahasiswa, ";
						$replyPesan .= "CH#Kodematkul#kelas#hari#jam#pin->Pindah jam kuliah, ";
						$replyPesan .= "CH#pinbaru#pinlama";
						$ide = $list['ID'];
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
						$ide = $list['ID'];
					}
					//-------------------penutup untuk balasan mengecek format pesan ---------------------------------------------------
				}elseif(count($bagi) == 2){
					//-------------------untuk mengecek mata kuliah yang di ampu -------------------------------------------------------
					$pin = $bagi[1];
					if($cek_pin_dsn[0]['pin']  == $pin){
						$nid = $cek_pin_dsn[0]['nid'];
						$cekmk = $crud->num("tdosenmatkul", "nid = '$nid'");
						if ($cekmk > 0) {
							$mk = $crud->selectDistinct("kd_matkul","tdosenmatkul", "nid = '$nid' AND tahun ='".date('Y')."'");
							$cekmk = $crud->num("tdosenmatkul", "nid = '$nid' AND tahun ='".date('Y')."'");
							if ($cekmk>0) {
								$no = (date('m')>=8) ? 1 : 0 ;
								foreach ($mk as $kd_mk) {
									$matkul = $crud->select("tmatkul","kd_matkul='".$kd_mk['kd_matkul']."'");
									if (($matkul[0]['semester'] % 2) == $no) {
										$replyPesan .= $matkul[0]['kd_matkul']."->".$matkul[0]['nm_matkul'].", ";
										$ide = $list['ID'];
									}else{
										$replyPesan .= "Anda belum memiliki Mata kuliah yang anda ampu pada TA.".date("Y");
										$ide = $list['ID'];
									}
								}
							}else{
								$replyPesan .= "Anda belum memiliki Mata kuliah yang anda ampu pada TA.".date("Y");
								$ide = $list['ID'];
							}
						}else{
							$replyPesan .= "Tidak ada Mata kuliah yang anda ampu";
							$ide = $list['ID'];
						}
					}else{
						$replyPesan .= "PIN yang anda masukkan salah";
						$ide = $list['ID'];
					}
					//-------------------penutup mengecek mata kuliah yang di ampu ---------------------------------------------------
				}elseif(count($bagi) == 3){
					//-------------------untuk mengganti pin -------------------------------------------------------------------------
					if (strtolower($bagi[0]) == "ch") {
						$pin = $bagi[2];
						$pinbaru = $bagi[1];
						if ($pin == $cek_pin_dsn[0]['pin']) {
							$ubah = $crud->updateSingel("tdosen","pin = '$pinbaru'", "telepon = '$SenderNumber'");
							if ($ubah) {
								$replyPesan .= "Proses ubah PIN berhasil. PIN Baru: ".$pinbaru;
								$ide = $list['ID'];
							} else {
								$replyPesan .= "Proses ubah PIN saat ini tidak dapat dilakukan";
								$ide = $list['ID'];
							}
						}else{
							$replyPesan .= "Pin lama yang anda masukkan salah !";
							$ide = $list['ID'];
						}
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
						$ide = $list['ID'];
					}
					//-------------------penutup mengganti pin --------------------------------------------------------------------
				}elseif(count($bagi) == 5){
					//-------------------untuk meririm informasi perkuliahan oleh dosen -------------------------------------------
					if (strtolower($bagi[0]) == "info") {
						if ($bagi[3]  == $cek_pin_dsn[0]['pin']) {
							$kd_mk = $bagi[1]; 	
							$kd_jurusan = substr($kd_mk, 0,2);
							$kelas = strtoupper($bagi[2]);
							$nid = $cek_pin_dsn[0]['nid'];		//Kode dosen
							$dtmtkul=$crud->num("tdosenmatkul","nid='$nid' AND kd_matkul='$kd_mk'");
							$kddm = ($dtmtkul>0) ? $crud->select("tdosenmatkul","nid='$nid' AND kd_matkul='$kd_mk'") : "" ;
							$cek = $crud->select("tmatkul","kd_matkul='$kd_mk'");
							$kd_dm = $kddm[0]['kd_dm'];
							$semester = $cek[0]['semester'];
							$tahun = date("Y");
							$bulan = date("m");
							$nil = (($semester%2) == 1) ? ($semester+1)/2 : $semester/2 ;
							$ang = "";
							if ($bulan>=2 && $bulan<=7) {
								$angka = $tahun-$nil;
								$ang = $angka."/".$angka+1;
							}elseif($bulan == 1 || $bulan >= 8){
								$angka = $tahun-$nil+1;
								$ang = $angka."/".$angka+1;
							}
							if (!$dtmtkul > 0) {
								$replyPesan .= "Maaf sepertinya kode mata kuliah yang  anda masukkan salah";
								$ide = $list['ID'];
							}else{
								$cekjadwal = $crud->num("tjadwal", "kd_dm = '$kd_dm' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
								if ($cekjadwal>0) {
										$data = $crud->select("tkrs tk LEFT JOIN tmahasiswa tm ON tk.nim = tm.nim","tk.kd_dm = '$kd_dm' AND tm.kelas = '$kelas' AND tk.semester= '$semester' AND tm.kd_jurusan = '$kd_jurusan'");
										foreach ($data as $value) {
											$pesan = "INFO (".$cek[0]['nm_matkul']."): ".$bagi[4]." ttd.". $cek_pin_dsn[0]['nama'];
											$kirim = array('DestinationNumber' => $value['telepon'], 'TextDecoded' => $pesan);
											$crud->insert("outbox", $kirim);
											$simpan = array('penerima' => $value['telepon'], 'text' => $pesan, 'tanggal'=> date("d-m-Y"));
											$crud->insert("tem_broadcast", $simpan);
										}
										//--------------------------- dikrim ke mahasiswa selain semester yang dituju ---------------------
										$data = $crud->select("tkrs tk LEFT JOIN tmahasiswa tm ON tk.nim = tm.nim","tk.kd_dm = '$kd_dm' AND tm.kelas = '$kelas' AND tk.semester <> '$semester' AND tm.kd_jurusan = '$kd_jurusan'");
										foreach ($data as $value) {
											$pesan = "INFO (".$cek[0]['nm_matkul'].") smstr ".$semester."-".$kelas." : ".$bagi[4]." ttd.". $cek_pin_dsn[0]['nama'];
											$kirim = array('DestinationNumber' => $value['telepon'], 'TextDecoded' => $pesan);
											$crud->insert("outbox", $kirim);
											$simpan = array('penerima' => $value['telepon'], 'text' => $pesan, 'tanggal'=> date("d-m-Y"));
											$crud->insert("tem_broadcast", $simpan);
										}
										$replyPesan .= "Pesan Telah di Broadcast Ke Mahasiswa";
										$ide = $list['ID'];
								}else{
									$replyPesan .= "Maaf anda belum memiliki jadwal pada semester".$semester."-".$kelas;
									$ide = $list['ID'];
								}
							}
						}else{
							$replyPesan .= "Pin anda salah";
							$ide = $list['ID'];
						}
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
						$ide = $list['ID'];
					}
					//-------------------penutup meririm informasi perkuliahan oleh dosen -----------------------------------------
				}elseif (count($bagi) == 6) {
					//-------------------untuk mengganti jadwal kuliah ------------------------------------------------------------
					if (strtolower($bagi[0]) == "ch") {
						if ($bagi[5]  == $cek_pin_dsn[0]['pin']) {
							$kd_mk = $bagi[1]; 	
							$kd_jurusan = substr($kd_mk, 0,2);
							$kelas = strtoupper($bagi[2]);
							$hari = strtolower($bagi[3]);
							$jam = $bagi[4];
							$nid = $cek_pin_dsn[0]['nid'];		//Kode dosen
							$dtmtkul=$crud->num("tdosenmatkul","nid='$nid' AND kd_matkul='$kd_mk'");
							$kddm = ($dtmtkul>0) ? $crud->select("tdosenmatkul","nid='$nid' AND kd_matkul='$kd_mk'") : "" ;
							$cek = $crud->select("tmatkul","kd_matkul='$kd_mk'");
							$kd_dm = $kddm[0]['kd_dm'];
							$semester = $cek[0]['semester'];
							$tahun = date("Y");
							$bulan = date("m");
							$nil = (($semester%2) == 1) ? ($semester+1)/2 : $semester/2 ;
							$ang = "";							
							if ($bulan>=2 && $bulan<=7) {
								$angka = $tahun-$nil;
								$ang = $angka."/".$angka+1;
							}elseif($bulan == 1 || $bulan >= 8){
								$angka = $tahun-$nil+1;
								$ang = $angka."/".$angka+1;
							}
							$cekjadwal = $crud->num("tjadwal", "kd_dm = '$kd_dm' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
							if ($cekjadwal>0) {
								$cekjk = $crud->select("tjadwal", "hari = '$hari' AND jam = '$jam' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
								if (!$dtmtkul > 0) {
									$replyPesan .= "Maaf kode mata kuliah yang anda masukkan salah";
									$ide = $list['ID'];
								}else{
									if ($cekjk[0]['kd_dm'] == NULL) {
										$crud->updateSingel("tjadwal","kd_dm = 'NULL'", "kd_dm = '$kd_dm' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
										$crud->updateSingel("tjadwal","kd_dm = '$kd_dm'", "hari = '$hari' AND jam = '$jam' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
										//------------------------------dikirm ke kelas yang sesui dangang pesan --------------------------
										$data = $crud->select("tkrs tk LEFT JOIN tmahasiswa tm ON tk.nim = tm.nim","tk.kd_dm = '$kd_dm' AND tm.kelas = '$kelas' AND tk.semester= '$semester' AND tm.kd_jurusan = '$kd_jurusan'");
										foreach ($data as $value) {
											$pesan = "INFO smtr ".$semester." Kelas ".$kelas.": Mata kuliah ".$cek[0]['nm_matkul']." dipindahkan hari ".strtoupper($hari)." jam ke-".strtoupper($jam).". Ttd. Bag Akademik";
											$kirim = array('DestinationNumber' => $value['telepon'], 'TextDecoded' => $pesan);
											$crud->insert("outbox", $kirim);
											$simpan = array('penerima' => $value['telepon'], 'text' => $pesan, 'tanggal'=> date("d-m-Y"));
											$crud->insert("tem_broadcast", $simpan);
										}
										//--------------------------- dikrim ke mahasiswa selain semester yang dituju ---------------------
										$data = $crud->select("tkrs tk LEFT JOIN tmahasiswa tm ON tk.nim = tm.nim","tk.kd_dm = '$kd_dm' AND tm.kelas = '$kelas' AND tk.semester <> '$semester' AND tm.kd_jurusan = '$kd_jurusan'");
										foreach ($data as $value) {
											$pesan = "INFO Perubahan Jadwal Kuliah: smtr ".$semester." Kelas ".$kelas.": Mata kuliah ".$cek[0]['nm_matkul']." dipindahkan hari ".strtoupper($hari)." jam ke-".strtoupper($jam).". Ttd. Bag Akademik";
											$kirim = array('DestinationNumber' => $value['telepon'], 'TextDecoded' => $pesan);
											$crud->insert("outbox", $kirim);
											$simpan = array('penerima' => $value['telepon'], 'text' => $pesan, 'tanggal'=> date("d-m-Y"));
											$crud->insert("tem_broadcast", $simpan);
										}
										$replyPesan .= "Terima Kasih. Jadwal mata kuliah ".$cek[0]['nm_matkul']." semester ".$semester." kelas ".$kelas." berhasil diubah";
										$ide = $list['ID'];
									}else{
										$replyPesan .= "Mohon maaf. Mata kuliah ".$cek[0]['nm_matkul']." semester ".$semester." kelas ".$kelas." tidak dapat diubah karena jam yang anda tuju telah terisi";
										$ide = $list['ID'];
									}
								}
							}else{
								$replyPesan .= "Maaf anda tidak dapat melakukan perubahan Jadwal Kuliah Karena anda tidak memiliki jadwal pada semester ".$semester."-".$kelas;
								$ide = $list['ID'];
							}
						}else{
							$replyPesan .= "Pin anda salah";
							$ide = $list['ID'];
						}
					}else{
						$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
						$ide = $list['ID'];
					}
					//----------------- penutup mengganti jadwal kuliah ----------------------------------------------------------
				}else{
					$replyPesan .= "Format Pesan salah !, Untuk melihat format pesan: Ketik CEK kirim ke nomor server";
					$ide = $list['ID'];
				}
			}else{
				$id = $list['ID'];
				$crud->delete("inbox","ID = '$id'");
			}
		}else{
			$id = $list['ID'];
			$crud->delete("inbox","ID = '$id'");
		}
		$nomor .= $SenderNumber;
	}
}
if (!$ide == "" && !$replyPesan == "") {
	$data = array('DestinationNumber' => $nomor, 'TextDecoded' => $replyPesan);
	$crud->insert('outbox',$data);
	$crud->updateSingel("inbox", "Processed = 'true'", "ID = '$ide'");
}elseif(!$ide == "" && $replyPesan == ""){
	$crud->updateSingel("inbox", "Processed = 'true'", "ID = '$ide'");
}
/*/balas pesan secara otomatis;
$jumSms = ceil(strlen($replyPesan)/160);
if($jumSms == 1){
	if(strtolower($pesanAwal) == "stmik"){
		$query=mysqli_query($conn,"SELECT * FROM mahasiswa,krs WHERE mahasiswa.nim = krs.nim AND krs.kodeMatkul='$pes2' AND krs.tahunAkademik='$tahun'");
		while ($rs=mysqli_fetch_array($query)) {
			$relply = mysqli_query($conn,"INSERT INTO outbox(DestinationNumber,TextDecoded) VALUES('$rs[telepon]','$replyPesan')");
		}
	}else{
		$relply = mysqli_query($conn,"INSERT INTO outbox(DestinationNumber,TextDecoded) VALUES('$noTeleponPengirim','$replyPesan')");
	}
}elseif($jumSms>1){
	if(strtolower($pesanAwal) == "stmik"){
		$query=mysqli_query($conn,"SELECT * FROM mahasiswa,krs WHERE mahasiswa.nim = krs.nim AND krs.kodeMatkul='$pes2' AND krs.tahunAkademik='$tahun'");
		while ($rs=mysqli_fetch_array($query)) {
			// menghitung jumlah pecahan
			$hitPecah = ceil(strlen($replyPesan)/153);
					
			// memecah pesan asli
			$pecah  = str_split($replyPesan, 153);
			 
			// membuat nilai ID untuk di insert di outbox
			$query = "SHOW TABLE STATUS LIKE 'outbox'";
			$hasil = mysql_query($query);
			$data  = mysqli_fetch_array($hasil);
			$newID = $data['Auto_increment'];
			
			for ($i=1; $i<=$jumSms;$i++){
				
				// membuat UDH untuk setiap pecahan, sesuai urutannya
				$udh = "050003A7".sprintf("%02s", $hitPecah).sprintf("%02s", $i);
			   // membaca text setiap pecahan
			   $msg = $pecah[$i-1];
			   
				if ($i == 1){
					// jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
					$query = "INSERT INTO outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart)
									VALUES ('$noTeleponPengirim', '$udh', '$msg', '$newID', 'true')";
				}else{
					// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
					$query = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
					VALUES ('$udh', '$msg', '$newID', '$i')";
				}
					// jalankan query
					mysql_query($query);
			}
		}
	}else{
		// menghitung jumlah pecahan
		$hitPecah = ceil(strlen($replyPesan)/153);
				
		// memecah pesan asli
		$pecah  = str_split($replyPesan, 153);
		 
		// membuat nilai ID untuk di insert di outbox
		$query = "SHOW TABLE STATUS LIKE 'outbox'";
		$hasil = mysql_query($query);
		$data  = mysqli_fetch_array($hasil);
		$newID = $data['Auto_increment'];
		
		for ($i=1; $i<=$jumSms;$i++){
			
			// membuat UDH untuk setiap pecahan, sesuai urutannya
			$udh = "050003A7".sprintf("%02s", $hitPecah).sprintf("%02s", $i);
		   // membaca text setiap pecahan
		   $msg = $pecah[$i-1];
		   
			if ($i == 1){
				// jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
				$query = "INSERT INTO outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart)
								VALUES ('$noTeleponPengirim', '$udh', '$msg', '$newID', 'true')";
			}else{
				// jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
				$query = "INSERT INTO outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
				VALUES ('$udh', '$msg', '$newID', '$i')";
			}
				// jalankan query
				mysql_query($query);
		}
	}
}
//$relply = mysqli_query($conn,"INSERT INTO outbox(DestinationNumber,TextDecoded) VALUES('$noTeleponPengirim','$replyPesan')");
$crud->jadwal("inbox", "Processed = 'true'", "ID = '$ide'");
//UPDATE  `akademik`.`inbox` SET  `Processed` =  'true' WHERE  `inbox`.`ID` =353 LIMIT 1 ;


//========akhir baris code untuk membalas sms  secara otomatis dengan mengambil nilai dari variabel $replyPesan sebagai isi SMS=======

*/
	}else{
		echo "Anda tidak dapat mengaktifkan server";
	}
}else{
	header('location:error.php');
}

	?>
