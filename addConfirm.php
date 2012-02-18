<?php
	session_start();
	include 'connection.php';
	setlocale ( LC_CTYPE, 'C' );
	if(isset($_GET['id'])) {
		$userid=$_GET['id'];
		$url = "http://kayit.etu.edu.tr/Ders/Ders_prg.php";
	    $ch = curl_init();	
	    curl_setopt($ch, CURLOPT_URL,$url);	
	 	curl_setopt($ch, CURLOPT_POST,1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, 'ogrencino='.$userid.'&btn_ogrenci=Programı Göster');	
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
	    $returned = curl_exec($ch);	
	    curl_close ($ch);
	    $returned = mb_convert_encoding($returned, 'UTF-8'); 
		$turkish = array("ý","Ý","ð","Ð","þ","Þ");
		$english= array("ı","İ","ğ","Ğ","ş","Ş");
		$returned=str_replace($turkish, $english, $returned);
		$pattern = '/'.$userid.'/';
		preg_match($pattern, $returned, $matches);
		if(count($matches)>0) {
			$start=strpos($returned,$userid);
			$str=substr($returned, $start+11);
			$end=strpos($str,'<br>');
			$str=substr($str,0,$end);
			$index=strrpos($str,' ');
			$name=trim(substr($str,0,$index));
			$surname=trim(substr($str,$index));
			$st->prepare("select st_id from user where st_id=?");
			$st->bind_param('i',$userid);
			$st->execute();
			$st->bind_result($id);
			if($st->fetch()){
				echo "<div class='alert-message error'><p>Öğrenci kaydı daha önce yapılmış</p></div>";
			}else {
				$date=getdate();				
				$activate=sha1($userid."didem-onur".$date[0]);
				$st->prepare("insert into user (st_id,st_activate,st_name,st_surname) values (?,?,?,?)");
				$st->bind_param('isss',$userid,$activate,$name,$surname);
				$st->execute();
				/**
				$mail_to="st0".$userid."@etu.edu.tr";
				$mail_from="info@etunet.net";
				$mail_sub="Üyelik Aktivasyon";
				$mail_mesg="Üyeliğinizi aktif etmek için aşağıdaki linke tıklayınız.
				
				
				www.etunet.net/activate.php?act=".$activate;
				mail($mail_to,$mail_sub,$mail_mesg,$mail_from);
				*/
				echo"<div class='alert-message info' id='registerStep1'><p>ETUMail hesabınıza gelen maildeki doğrulama adresine gitmeniz gerekmektedir</p></div>";
			}
		} else {
			echo "<div class='alert-message error'><p>Lütfen geçerli bir öğrenci numarası giriniz</p></div>";
		}
	} else 
		header("location:index.php");
	
?>