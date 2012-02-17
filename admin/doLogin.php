<?php
	include '../connection.php'; 
	session_start();
	if(isset($_GET["username"]) and isset($_GET["password"])){
		$username=$_GET["username"];
		$pass=$_GET["password"];
		//$pass_control=sha1($username."didemonur".$pass);
		$pass_control=$pass;
		$st->prepare("select admin_id from admin where admin_username=? and pass_control=?");
		$st->bind_param('ss',$username,$pass_control);
		$st->execute();
		$st->bind_result($id);
		if($st->fetch()){
			$_SESSION["username"]=$username;
			$_SESSION["id"]= $id;
			echo("ok");
		}
		else{
			echo"<div class='alert-message error' id='registerStep1'><p>Girilen bilgiler yanlış</p></div>";
		}
	} else {
		header("location:login.php");
	}
?>