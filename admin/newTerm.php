<?php include('header.php'); 
	include '../connection.php';
?>
	<div class="row">         
            <center><h2>Yeni bir dönem eklemek için bulunduğunuz dönemi seçin ve bilgilerin yüklenmesini bekleyin</h2>
            <p>NOT:Yeni dönem bilgileri ancak yeni dönem ders programı belli olduktan sonra eklenmelidir</p>
            
			<?php 
				date_default_timezone_set('Europe/Istanbul');
				$year=date("Y");
				$month=date("m");
				$day=date("m");
				$guz=array(8,9,10,11);
				$bahar=array(12,1,2,3);
				$yaz=array(4,5,6,7);
				
				if(array_search($month, $guz)) {
					$value=1;
					$term="Güz Dönemi";
					$yearterm=$year." - ".($year+1)."";
				}else if (array_search($month, $bahar)) {
					$value=2;
					$term="Bahar Dönemi";
					if($month==12) {
						$yearterm=$year." - ".($year+1)."";
					}else {
						$yearterm=($year-1)." - ".$year."";
					}
				}else if (array_search($month, $yaz)) {
					$value=3;
					$term="Yaz Dönemi";					
					$yearterm=($year-1)." - ".$year."";
					
				}
				echo("<select disabled=disabled name=yearterm ><option>$yearterm</option></select> 
            		<select disabled=disabled name=term><option value=$value>$term</option></select><br/><br/>");
				$st->prepare("select term_id from term where yearterm=? and term=?");
				$st->bind_param('is',$yearterm,$value);
				$st->execute();
				$st->bind_result($term_id);
				if($st->fetch()){
					echo("$yearterm $term bilgileri halihazırda kayıtlı<br/>Güncellemek için dönem güncelleme sayfasına gidiniz<br/><br/>
					<p><a class=btn href=# disabled=disabled >Bilgilerini Ekle</a></p>
					");	
    			} else {
    				echo("<p><a class=btn href=# onclick= >Bilgileirni Ekle</a></p>");
    			}
            ?>
        </center>
       </div>
<?php include("footer.php"); ?>