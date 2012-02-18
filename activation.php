<?php
	session_start();
	
	if(isset($_GET['act'])){
		include 'connection.php';
		include('header.php');
		
		$activate=$_GET['act'];
		$st->prepare("select st_id,st_name,st_surname from user where st_activate=?");
		$st->bind_param('s',$activate);
		$st->execute();
		$st->bind_result($userId,$name,$surname);
		if($st->fetch()){
			include('registerForm.php');
			include('footer.php');
		}else {
			header("location:index.php");
		}
	}
	else{
		header("location:index.php");	
	}
?>
