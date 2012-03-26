<?php
		header ('Content-type: text/html; charset=utf-8');
		include 'connection.php';
		include 'admin/lec_lec.php';		
        if(isset($_GET["ogrenci"]) ){
        	$id=$_GET["ogrenci"];
	        $st->prepare("select st_id,sube,lecture_id from st_courses where st_id=?");
			$st->bind_param('i',$id);
			$st->execute();
			$st->bind_result($st_id,$sube,$lecId);
			if($st->fetch()) {
				echo $st_id.$sube.$lecId."<br/>";
				while($st->fetch()) {
					echo $st_id.$sube.$lecId."<br/>";
				}
			}else {
	            $url = "http://kayit.etu.edu.tr/kayit/dersprogrami.php?ogrenci=".$id."&sube=0";
	            $homepage = file_get_contents($url);
	            $homepage = mb_convert_encoding($homepage, 'UTF-8'); 
	            $turkish = array("ý","Ý","ð","Ð","þ","Þ");
	            $english= array("ı","İ","ğ","Ğ","ş","Ş");
	            $homepage=str_replace($turkish, $english, $homepage);
	            $st->prepare("select lecture_id,lecture_value from lecture");
				$st->execute();
				$st->bind_result($l_id,$l_val);
				$i=0;
				while($st->fetch()) {
					$start=mb_strpos($homepage,$l_id,0,'UTF-8');
					if($start>0) {
						if (mb_check_encoding($homepage,'UTF-8')) {
					        $sube = mb_substr($homepage,$start+mb_strlen($l_id,'utf-8')+3,1,'utf-8');
						}
						$sonuc=new Lec_lec();
						$sonuc->lecture=$l_val;
						$sonuc->sube=$sube;
						$lecs[$i]=$sonuc;
						$i++;
					}
				}
				for($i=0;$i<count($lecs);$i++) {		
					$st->prepare("insert into st_courses (st_id,sube,lecture_value)values (?,?,?)");
					$st->bind_param('iii',$id,$lecs[$i]->sube,$lecs[$i]->lecture);
					$st->execute();
				}				
			}
        } else {
              echo "<div id=errorMessage><div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div></div>";
        }
       ?>