<?php

	 echo "<title>
		Halaman serverSms
	  </title>
	 <meta http-equiv=refresh content='1;url=serverSms.php'>
	 <h1>
		Server SMS Running..., jangan di tutup!
	  </h1>";
	include "../conf/connect.php";
	$crud = new crud("localhost","root","","db_broadcast");
//===menangambil data isi pesan,noPengirim, dari inbox dengan field Processed bernilai false, yang menandakan bahwa pesan masuk belum diproses====
$sql = $crud->fetch("inbox", "Processed = 'false'");
$ide="";
$replyPesan="";
$pesanAwal="";
foreach ($sql as $data) {
	$noTel = substr($data['SenderNumber'],3);
	//$noTeleponPengirim = "0".$noTel;
	$pecah = explode(' ', $data['TextDecoded']);
	//$ide = $data['ID'];
	//$pesanAwal = $pecah['0'];
	if($pecah > 0){
		if((strtolower($pesanAwal) != "cek") AND (strtolower($pesanAwal) != "cekjk") AND (strtolower($pesanAwal) != "ch") AND (strtolower($pesanAwal) != "cekmk") AND (strtolower($pesanAwal) != "info")){
			//jika keyword pecahan pertama tidak sesuai dengan ketentuan makan akan dibalas dengan isi pesan berikut ini
			if(is_numeric($noTel)==TRUE){
				$replyPesan = "Maaf! format SMS sepertinya belum tepat. mohon diulangi";
				$spam=mysqli_query($conn,"UPDATE `inbox` SET `status`='true' WHERE `ID`=$ide");
			}else{
				$spam=mysqli_query($conn,"INSERT INTO `inbox_spam`(`IDInbox`, `noPengirim`, `pesan`,`tglMasuk`) VALUES ('$ide','$data[SenderNumber]','$data[TextDecoded]','$data[ReceivingDateTime]')");
				$del=mysqli_query($conn,"DELETE FROM `inbox` WHERE ID='$ide'");
			}
		}else{
			
			if(strtolower($pesanAwal)=="cek"){
				$replyPesan = " fotmat SMS";
				$replyPesan .= " CEKJK(spasi)TGL(spasi)PIN";
				$replyPesan .= " CH(spasi)KODEMK(spasi)KELAS(spasi)TGL(spasi)JAM(spasi)PIN";
				$replyPesan .= " CEKMK(spasi)PIN";
				$replyPesan .= " INFO(spasi)TEXT";
				$replyPesan .= " CH(spasi)PINLAMA(spasi) PINBARU";
			}elseif(strtolower($pesanAwal)=="cekjk"){
				$pecahpesan = explode('#', $data['TextDecoded']);
				$pes1=$pecahpesan['1'];
				$pes2=$pecahpesan['2'];
				$thn=date("Y");
				$tahun=($thn-1)."/".$thn;
				$qry = mysqli_query($conn,"SELECT * from dosenmatkul WHERE kodeDosen='$pes1' AND kodeMatkul='$pes2' AND tahun='$tahun'");
				if(mysqli_num_rows($qry)<1){
					$replyPesan = "Maaf! kami tidak menemukan kriteria pencarian anda, mohon diulangi.";
					$replyPesan .=" Untuk memastikan format SMS ketik info dan kirim ke nomor server";
				}else{
					
					$replyPesan = "INFO AKADEMIK: ".$pes3;
				}
			}elseif(strtolower($pesanAwal) == "info"){
				if(count($pecah) != 1){
					$replyPesan = "Maaf! format SMS sepertinya belum tepat. mohon diulangi";
				}else{
					$datadosen=mysqli_query($conn,"SELECT * FROM dosen where telepon='$noTeleponPengirim'");
					$datamahasiswa=mysqli_query($conn,"SELECT * FROM mahasiswa where telepon='$noTeleponPengirim'");
					if(mysqli_num_rows($datadosen)>0){
						$replyPesan .= "STMIK#KODEDOSEN#KODEMATKUL#PESAN";
					}elseif(mysqli_num_rows($datamahasiswa)>0){
						$replyPesan .= "CEK#NIM, ";
					}else{
						$replyPesan = "Maaf! nomor belum terdaftar silahkan Hub.TU";
					}
				}
			}
		}
	}
}
//balas pesan secara otomatis;
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

$update = mysqli_query($conn,"UPDATE inbox SET Processed = 'true' WHERE ID = '$ide'") or die("eror");
//UPDATE  `akademik`.`inbox` SET  `Processed` =  'true' WHERE  `inbox`.`ID` =353 LIMIT 1 ;


//========akhir baris code untuk membalas sms  secara otomatis dengan mengambil nilai dari variabel $replyPesan sebagai isi SMS=======


	?>