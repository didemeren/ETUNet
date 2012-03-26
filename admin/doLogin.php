<?php
	include 'connection.php'; 
	session_start();
	if(isset($_GET["email"]) and isset($_GET["password"])){
		$email=$_GET["email"];
		$pass=$_GET["password"];
		$pass_control=sha1($passInput."didem-erdem-cihan".$mailInput);
		$st->prepare("select id from users where email=? and password=?");
		$st->bind_param('ss',$email,$pass_control);
		$st->execute();
		$st->bind_result($id);
		if($st->fetch()){
			$_SESSION["id"]= $id;
			echo("ok");
		}
		else{
			echo "Girilen bilgiler yanlış";
		}
	} else {
		header("location:../login.php");
	}
?>