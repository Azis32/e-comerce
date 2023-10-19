
<title>Halaman serverSms</title>
<meta http-equiv="refresh" content="5;url=serverSms.php">
<h1>Server SMS Running..., jangan di tutup!</h1>

<?php		
require_once "conf/connect.php";

//===menangambil data isi pesan,noPengirim, dari inbox dengan field Processed bernilai false, yang menandakan bahwa pesan masuk belum diproses====
$crud = new crud("localhost","root","","db_broadcast");
$pesan = $crud->fetch("inbox", " Processed = 'false' ");
$ide = "";
$replyPesan = "";
$pesanAwal = "";
$nomor = "";
if (count($pesan)>0) {
	foreach ($pesan as $list) {
		$SenderNumber = "0".substr($list['SenderNumber'],3);
		if (is_numeric($SenderNumber)) {
			$cek_nomor = $crud->num("tpengguna","telepon = '$SenderNumber'");
			$jabatan = $crud->fetch("tpengguna", "telepon = '$SenderNumber'");
			if ($cek_nomor>0) {
				$isi = $list['TextDecoded'];
				$bagi = explode("#", $isi);
				if (count($bagi) == 6) {
					$pin = $bagi[5];
					if ($pin == $jabatan[0]['pin'] && $jabatan[0]['jabatan'] == "Dosen") {
						if (strtolower($bagi[0]) == "ch") {
							$kd_mk = $bagi[1]; 						//kode matkul
							$kd_jurusan = substr($kd_mk, 0,2);
							$kelas = strtoupper($bagi[2]); 						//kelas
							$hari = strtolower($bagi[3]);			//hari
							$jam = $bagi[4];						//jam
							$no_reg = $jabatan[0]['no_reg'];		//Kode dosen
							$dtmtkul=$crud->num("tdosenmatkul","no_reg='$no_reg' AND kd_matkul='$kd_mk'");
							$kddm = "";
							if ($dtmtkul>0) {
								$kddm = $crud->fetch("tdosenmatkul","no_reg='$no_reg' AND kd_matkul='$kd_mk'");
							}
							$cek = $crud->fetch("tmatkul","kd_matkul='$kd_mk'");
							$kd_dm = $kddm[0]['kd_dm'];
							$semester = $cek[0]['semester'];
							$cekjk = $crud->fetch("tjadwal", "hari = '$hari' AND jam = '$jam' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
							if (!$dtmtkul > 0) {
								$replyPesan .= "Maaf kode mata kuliah yang anda masukkan salah";
								$ide = $list['ID'];
							}else{
								if ($cekjk[0]['kd_dm'] == NULL) {
									$crud->jadwal("tjadwal","kd_dm = '$kd_dm'", "hari = '$hari' AND jam = '$jam' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$kd_jurusan'");
									$data = $crud->fetch("tkrs tk LEFT JOIN tpengguna tp ON tk.no_reg = tp.no_reg","tk.kd_dm = '$kd_dm' AND tp.kelas = '$kelas' AND tp.semester = '$semester' AND tp.jurusan = '$jurusan'");
									foreach ($data as $value) {
										$pesan = "INFO smtr ".$semester." Kelas ".$kelas.": Utk Mata kuliah ".$cek[0]['nm_matkul']." telah dipindahkan ke hari ".$hari." jam ke-".$jam.". Ttd. ".$jabatan[0]['nama'];
										$kirim = array('SenderNumber' => $value['telepon'], 'TextDecoded' => $pesan);
										$crud->insert("outbox", $kirim);
									}
									$replyPesan .= "Jadwal berhasil diubah";
									$ide = $list['ID'];
								}else{
									$replyPesan .= "Jam yang anda tuju telah terisi";
									$ide = $list['ID'];
								}
							}
							/*else{
								$cekjk = $crud->fetch("tjadwal", "hari = '$hari' AND jam = '$jam' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$jurusan'");
								if (!$cekjk[0]['kd_dm'] == "") {
									$hasil = $crud->jadwal("tjadwal","kd_dm = '$kd_dm'", "hari = '$hari' AND jam = '$jam' AND kelas = '$kelas' AND semester = '$semester' AND jurusan = '$jurusan'");
									$replyPesan .= "Jadwal kuliah berhasil diubah";
									$ide = $list['ID'];	
								}else{
									$replyPesan .= "Maaf hari ".$hari." jam ke-".$jam." sudah terisi";
									$ide = $list['ID'];	
								}
								
							}*/
						}
					}else{
						$replyPesan .= "Pin yang anda masukkan salah !";
						$ide = $list['ID'];
					}
				} else {
					if ($pin == $cek_nomor[0]['pin']) {
						if (strtolower($bagi[0]) == "info") {
							if (strtolower($bagi[1]) == "Dosen") {
								# code...
							}
						}else{
							$replyPesan .= "Format pesan yang anda masukkan salah";
						}
					}
				}
			}else{
				$id = $list['ID'];
				$crud->delete("inbox","ID = '$id'");
			}
		}else{
			$id = $list['ID'];
			$crud->delete("inbox","ID = '$id'");
		}
	$nomor = $SenderNumber;
	}
}
if (!$ide == "" && !$replyPesan == "") {
	$data = array('DestinationNumber' => $nomor, 'TextDecoded' => $replyPesan);
	$crud->insert('outbox',$data);
	$crud->jadwal("inbox", "Processed = 'true'", "ID = '$ide'");
}elseif(!$ide == "" && $replyPesan == ""){
	$crud->jadwal("inbox", "Processed = 'true'", "ID = '$ide'");
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
	?>