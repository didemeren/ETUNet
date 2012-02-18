<?php
	session_start();
	include 'connection.php';
	
	if(isset($_POST['studentIDInput'])&& isset($_POST['nameInput'])&& isset($_POST['surnameInput']) 
		&&isset($_POST['reg']) && isset($_POST['reg'])&& isset($_POST['reg']) 
		&&isset($_POST['reg']) && isset($_POST['reg']))
			$_POST["userId"]=$userId;		
			$_POST["name"]=$name;
			$_POST["surname"]=$surname;
			$_POST["username"]=$username;
			$_POST["role"]="st";
	if(isset($_GET['reg'])){
		$activate=$_GET['act'];
		$st->prepare("select st_id,st_mail,st_pass,st_name,st_surname from user where st_activate=?");
		$st->bind_param('s',$activate);
		$st->execute();
		$st->bind_result($userId,$username,$pass,$name,$surname);
		if($st->fetch()){
			$_SESSION["userId"]=$userId;		
			$_SESSION["name"]=$name;
			$_SESSION["surname"]=$surname;
			$_SESSION["username"]=$username;
			$_SESSION["role"]="st";
			$st->prepare("update student set st_activate=1 where st_activate=?");
			$st->bind_param('s',$activate);
			$st->execute();
			header("location:starea.php");
		}else {
			header("location:index.php");
		}
	}
	else{
		header("location:index.php");	
	}
?>