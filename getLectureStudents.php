<?php
set_time_limit(600);
header ('Content-type: text/html; charset=utf-8');
		include 'connection.php';
		include './classes/StProgram.php';
		$st->prepare("select lecture_id,lecture_value from lecture");
		$st->execute();
		$st->bind_result($l_id,$l_val);
		$arrayCount=0;
		if($st->fetch()) {
			$url = "http://kayit.etu.edu.tr/Ders/Ders_prg.php";
		    $ch = curl_init();	
		    curl_setopt($ch, CURLOPT_URL,$url);	
		 	curl_setopt($ch, CURLOPT_POST,1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, 'dd_ders='.$l_val.'&btn_sube=Şube Listesini Göster');	
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
		    $returned = curl_exec($ch);	
		    curl_close ($ch);
		    $returned = mb_convert_encoding($returned, 'UTF-8'); 
			$turkish = array("ý","Ý","ð","Ð","þ","Þ");
			$english= array("ı","İ","ğ","Ğ","ş","Ş");
			$returned=str_replace($turkish, $english, $returned);
			$returned = strip_tags($returned,'<td></td><tr>');
			$returned = str_replace(' ','',$returned);
			$returned = str_replace('</tr>','<hr>',$returned);
		    $subecount=substr_count($returned, 'Şube:');    
			for ($cnt=1;$cnt<=$subecount;$cnt++) {
				$sube=$cnt;
				$valuestart=strpos($returned,'Tekrarlama');
				$returned=substr($returned,$valuestart);
				$valueend=strpos($returned,'Şube:');
				if($valueend!=null)					
					$homepage=substr($returned,0,$valueend);
				else 
					$homepage=trim($returned);
				$homepage=trim($homepage);				
				$stcount=substr_count($homepage, '<hr>')-1;
				$array = explode("<hr>",$homepage);
	            for($i=1; $i<$stcount;$i++){
	            	$sts=explode("</td>",$array[$i]);
	            	$st_id=$sts[0];
	            	$data=new StProgram();
					$data->st_id=$st_id;
					$data->sube=$sube;
					$data->lecture_value=$l_val;  
					$stProg[$arrayCount]=$data;
					$arrayCount++;
	            }
				$returned=substr($returned,$valueend);
			}
		}
		
		for($i=0;$i<count($stProg);$i++) {		
			$st->prepare("insert into st_courses (st_id,sube,lecture_value)values (?,?,?)");
			$id=$stProg[$i]->st_id;
			echo $id."<br/>";
			$st->bind_param('iii',$id,$stProg[$i]->sube,$stProg[$i]->lecture_value);
			$st->execute();
		}
		
			
?>