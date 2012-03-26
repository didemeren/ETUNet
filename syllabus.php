<?php
	include('header.php');
?>
<div class="span10">
	<input class="span3" type="text" placeholder="Öğrenci Numarası" id="studentIDsl">
	<button class="btn" onClick="getProgramme()">Programı Göster</button>
	<?php
		   if (isset($_SESSION['username']) && isset($_SESSION['userId'])) {
		  ?>
			<button class="btn" onClick="getMyProgramme('0<?php echo $_SESSION["userId"]?>')">Programım</button>
		<?php }?>
	<div id="programTable">
	<div id="errorMessage"></div>  
	</div>
</div>
<?php
	include ('sidebar.php');
	include('footer.php'); 
?>