<?php
set_time_limit(600);
header ('Content-type: text/html; charset=utf-8');
		include 'connection.php';
		include './classes/CourseProgram.php';
		$st->prepare("select lecture_id,lecture_value from lecture");
		$st->execute();
		$st->bind_result($l_id,$l_val);
		$arrayCount=0;
		while($st->fetch()) {
			$url = "http://kayit.etu.edu.tr/Ders/Ders_prg.php";
		    $ch = curl_init();	
		    curl_setopt($ch, CURLOPT_URL,$url);	
		 	curl_setopt($ch, CURLOPT_POST,1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, 'dd_ders='.$l_val.'&btn_ders=Seçili Dersin Programını Göster');	
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
		    $returned = curl_exec($ch);	
		    curl_close ($ch);
		    $returned = mb_convert_encoding($returned, 'UTF-8'); 
			$turkish = array("ý","Ý","ð","Ð","þ","Þ");
			$english= array("ı","İ","ğ","Ğ","ş","Ş");
			$returned=str_replace($turkish, $english, $returned);
		    $subecount=substr_count($returned, 'Şube:');    
			for ($cnt=1;$cnt<=$subecount;$cnt++) {
				$sube=$cnt;	
				$valuestart=mb_strpos($returned,'Şube:',0,'utf-8');
				$returned=substr($returned,$valuestart+511);
				$valueend=strpos($returned,'Şube:');
				if($valueend!=null)					
					$homepage=substr($returned,0,$valueend);
				else 
					$homepage=trim($returned);
				$homepage=trim($homepage);
				$homepage = strip_tags($homepage,'<center><br>');
				$homepage = str_replace('center','hr',$homepage);
				$homepage = str_replace('Derslik:','',$homepage);
				$homepage = str_replace('<br>','',$homepage);
				//echo $homepage;echo("<br/><br/><br/>");
				$array = explode("<hr>",$homepage);
	            for($i=2; $i<9;$i++){
	            	$day=$i-1;
	            	$hour=1;
	            	for($j=0;$j<97;$j=$j+8) {	            		
	            		$classroom=trim($array[$i+$j]);
	            		if($classroom!="-") {
	            			$data=new CourseProgram();
							$data->lectureValue=$l_val;
							$data->sube=$sube;
							$data->classroom=$classroom;
							$data->hour=$hour;
							$data->day=$day;
							$lecsProg[$arrayCount]=$data;
							$arrayCount++;
	            		}
	            		$hour++;
	            	}
	            	
	            }
			}
		}
		for($i=0;$i<count($lecsProg);$i++) {
			//echo($lecsProg[$i]->lectureValue.",".$lecsProg[$i]->sube.",".$lecsProg[$i]->classroom.",".$lecsProg[$i]->hour.",".$lecsProg[$i]->day."<br/>");		
			$st->prepare("insert into lecture_program (lecture_value,sube,classroom,hour,day)values (?,?,?,?,?)");
			$st->bind_param('iisii',$lecsProg[$i]->lectureValue,$lecsProg[$i]->sube,$lecsProg[$i]->classroom,$lecsProg[$i]->hour,$lecsProg[$i]->day);
			$st->execute();
		}
			
?>