<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Insert title here</title>
</head>
<body>
<?php

	session_start();
	include 'connection.php';
	setlocale ( LC_CTYPE, 'C' );
	
	$url = "http://kayit.etu.edu.tr/Ders/_Ders_prg_start.php";
	$homepage = file_get_contents($url);
	$homepage = mb_convert_encoding($homepage, 'UTF-8'); 
	$turkish = array("ý","Ý","ð","Ð","þ","Þ");
	$english= array("ı","İ","ğ","Ğ","ş","Ş");
	$homepage=str_replace($turkish, $english, $homepage);
	//-------------------------ders
	
	
	
	/**	
	$ders='dd_ders';
	$start=strpos($homepage,$ders);
	$bolum=substr($homepage, $start);
	$end=strpos($bolum,'</select>');
	$bolum=substr($bolum,0,$end);
	$valuecount=substr_count($bolum, 'value');
	for ($i=0;$i<$valuecount;$i++) {		
		$valuestart=strpos($bolum,'value=');
		$bolum=substr($bolum,$valuestart+6);
		$valueend=strpos($bolum,'>');
		$value=substr($bolum,0,$valueend);		
		
		$bolum=substr($bolum,$valueend+1);
		$textend=strpos($bolum,'</option>');
		$text=substr($bolum,0,$textend);
		$id=mb_substr($text,0,8,'UTF-8');
		$name=mb_substr($text,8,strlen($text),'UTF-8');	
		
		$st->prepare("insert into lecture (lecture_id,lecture_name,lecture_value)values (?,?,?)");
		$st->bind_param('sss',$id,$text,$value);
		$st->execute();	
		$bolum=substr($bolum,$textend+9);
	}	
	$st->prepare("select * from lecture order by lecture_id");
	$st->execute();
	$st->bind_result($id,$name,$value);
	echo("<select name = dd_ders>");
	while($st->fetch()){
		echo ("<option value=$value>$id  $name</option>");
	}
	echo("</select><br/>");
	
		
		
		
		
	//-------------------------hoca	
	$hoca="dd_hoca";
	$start=strpos($homepage,$hoca);
	$bolum=substr($homepage, $start);
	$end=strpos($bolum,'</select>');
	$bolum=substr($bolum,0,$end);
	$valuecount=substr_count($bolum, 'value');
	for ($i=0;$i<$valuecount;$i++) {	
		$valuestart=strpos($bolum,'value=');
		$bolum=substr($bolum,$valuestart+6);
		$valueend=strpos($bolum,'>');
		$value=substr($bolum,0,$valueend);	
		$bolum=substr($bolum,$valueend+1);
		$textend=strpos($bolum,'</option>');
		$text=substr($bolum,0,$textend);		
		$st->prepare("insert into lecturer (lecturer_name,lecturer_value)values (?,?)");
		$st->bind_param('ss',$text,$value);
		$st->execute();			
		$bolum=substr($bolum,$textend+9);
	}	
	$st->prepare("select * from lecturer order by lecturer_name");
	$st->execute();
	$st->bind_result($value,$name);
	echo("<select name = dd_hoca>");
	while($st->fetch()){
		echo ("<option value=$value>$name</option>");
	}
	echo("</select>");
	
	
	
	
	
	//-------------------------derslik
	$derslik="dd_derslik";
	$start=strpos($homepage,$derslik);
	$bolum=substr($homepage, $start);
	$end=strpos($bolum,'</select>');
	$bolum=substr($bolum,0,$end);
	$valuecount=substr_count($bolum, 'value');
	for ($i=0;$i<$valuecount;$i++) {		
		$valuestart=strpos($bolum,'value=');
		$bolum=substr($bolum,$valuestart+6);
		$valueend=strpos($bolum,'>');
		$value=substr($bolum,0,$valueend);
		$bolum=substr($bolum,$valueend+1);
		$textend=strpos($bolum,'</option>');
		$text=substr($bolum,0,$textend);	
		$st->prepare("insert into classroom (classroom_name,classroom_value)values (?,?)");
		$st->bind_param('ss',$text,$value);
		$st->execute();			
		$bolum=substr($bolum,$textend+9);
	}
	$st->prepare("select * from classroom order by classroom_name");
	$st->execute();
	$st->bind_result($value,$name);
	echo("<select name = dd_deslik>");
	while($st->fetch()){
		echo ("<option value=$value>$name</option>");
	}
	echo("</select>");	
	
	
	
	
	
	//-------------------------bolum
	$bolum="dd_bolum";
	$start=strpos($homepage,$bolum);
	$bolum=substr($homepage, $start);
	$end=strpos($bolum,'</select>');
	$bolum=substr($bolum,0,$end);
	$valuecount=substr_count($bolum, 'value');
	for ($i=0;$i<$valuecount;$i++) {		
		$valuestart=strpos($bolum,'value=');
		$bolum=substr($bolum,$valuestart+6);
		$valueend=strpos($bolum,'>');
		$value=substr($bolum,0,$valueend);
		$bolum=substr($bolum,$valueend+1);
		$textend=strpos($bolum,'</option>');
		$text=substr($bolum,0,$textend);	
		$st->prepare("insert into department (dep_name,dep_value)values (?,?)");
		$st->bind_param('ss',$text,$value);
		$st->execute();			
		$bolum=substr($bolum,$textend+9);
	}
	$st->prepare("select * from department order by dep_name");
	$st->execute();
	$st->bind_result($value,$name);
	echo("<select name = dd_bolum>");
	while($st->fetch()){
		echo ("<option value=$value>$name</option>");
	}
	echo("</select>");	
	
	
	//-----------------------ders-hoca
	include 'lec_lec.php';
	set_time_limit(600);
	
	$st->prepare("select lecture_value from lecture order by lecture_name");
	$st->execute();
	$st->bind_result($value);
	$arraycount=0;	
	while($st->fetch()){
		$url = "http://kayit.etu.edu.tr/Ders/Ders_prg.php";
	    $ch = curl_init();	
	    curl_setopt($ch, CURLOPT_URL,$url);	
	 	curl_setopt($ch, CURLOPT_POST,1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, 'dd_ders='.$value.'&btn_ders=Seçili Dersin Programını Göster');	
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
	    $returned = curl_exec($ch);	
	    curl_close ($ch);
	    $returned = mb_convert_encoding($returned, 'UTF-8'); 
		$turkish = array("ý","Ý","ð","Ð","þ","Þ");
		$english= array("ı","İ","ğ","Ğ","ş","Ş");
		$returned=str_replace($turkish, $english, $returned);
	    $subecount=substr_count($returned, 'Şube:');		    
		for ($i=1;$i<=$subecount;$i++) {		
			$valuestart=strpos($returned,'Şube:')+2;
			$returned=substr($returned,$valuestart+5);
			$valueend=strpos($returned,'<tr>');
			$text=substr($returned,0,$valueend);
			$text=trim($text);
			$sonuc=new Lec_lec();
			$sonuc->lecture=$value;
			$sonuc->lecturer=$text;
			$sonuc->sube=$i;
			$lecture_lecturer[$arraycount]=$sonuc;
			$bolum=substr($returned,$valueend+4);
			$arraycount++;
		}
	}
	for($i=0;$i<count($lecture_lecturer);$i++) {
		$lecturer=$lecture_lecturer[$i]->lecturer;
		$st->prepare("select lecturer_value from lecturer where lecturer_name=?");
		$st->bind_param('s',$lecturer);
		$st->execute();
		$st->bind_result($v);
		if($st->fetch()) {
		$lecture_lecturer[$i]->lecturer=$v;
		}
		$st->prepare("insert into lecture_lecturer (lecture_value,lecturer_value,sube)values (?,?,?)");
		$st->bind_param('sss',$lecture_lecturer[$i]->lecture,$lecture_lecturer[$i]->lecturer,$lecture_lecturer[$i]->sube);
		$st->execute();	
	}
*/
	
	
	
	
	/**
		$url = "http://kayit.etu.edu.tr/Ders/Ders_prg.php";
	    $ch = curl_init();	
	    curl_setopt($ch, CURLOPT_URL,$url);	
	 	curl_setopt($ch, CURLOPT_POST,1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, 'ogrencino=07110356&btn_ogrenci=Programı Göster');	
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
	    $returned = curl_exec($ch);	
	    curl_close ($ch);	
	    echo $returned;
	    */
?>
</body>
</html>