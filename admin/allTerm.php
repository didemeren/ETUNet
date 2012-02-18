<?php include('header.php'); 
	include '../connection.php';
?>
	<div class="row">         
            <center>
            <?php 
				$st->prepare("select term_id,yearterm,term from term");
				$st->execute();
				$st->bind_result($term_id,$yearterm,$term );
				while($st->fetch()){
					switch($term) {
						case 1:
							$term="Güz Dönemi";break;
						case 2:
							$term="Bahar Dönemi";break;
						case 3:
							$term="Yaz Dönemi";break;
					}
					echo("$term_id.  $yearterm  $term");	
    			}
            ?>
        </center>
       </div>
<?php include("footer.php"); ?>