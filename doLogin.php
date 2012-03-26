<?php
	session_start();
	include 'connection.php';
			if(isset($_GET['reg'])){
				if(isset($_POST['studentIDInput'])&& isset($_POST['nameInput'])&& isset($_POST['surnameInput']) 
				&&isset($_POST['passInput']) && isset($_POST['pass-againInput'])&& isset($_POST['mailInput']) 
				&&isset($_POST['classInput']) && isset($_POST['departmentInput'])) {
					$studentID=$_POST["studentIDInput"];
					$passInput=$_POST["passInput"];
					$mailInput=$_POST["mailInput"];
					$classInput=$_POST["classInput"];
					$departmentInput=$_POST["departmentInput"];
					$optionsUName=$_POST["optionsUName"];
					$st->prepare("select st_id from user where st_id=?");
					$st->bind_param('i',$studentID);
					$st->execute();
					$st->bind_result($userId);
					if($st->fetch()){
						$pass_control=sha1($studentID."didem-onur".$passInput);
						$st->prepare("select st_id from user where st_mail=?");
						$st->bind_param('i',$mailInput);
						$st->execute();
						$st->bind_result($x);
						if(!$st->fetch()){
							$st->prepare("update user set st_mail=?,st_username=?,pass_control=?,st_class=?,st_department=?,st_activate=1 where st_id=?");
							$st->bind_param('sssiii', $mailInput,$optionsUName,$pass_control,$classInput,$departmentInput,$userId);
							$st->execute();						
							$_SESSION["userId"]=$userId;
							$_SESSION["username"]=$optionsUName;
							header("location:index.php");
						} else {
							echo "<div class='alert-message error'><p>Girilen mail kayıtlı.</p></div>";
						}
					} else {
						header("location:index.php");
					}				
			}else {
				header("location:index.php");
			}
		}else {
			if(isset($_POST['studentIdL'])&& isset($_POST['passwordL'])) {
				$studentID=$_POST["studentIdL"];
				$passInput=$_POST["passwordL"];
				$pass_control=sha1($studentID."didem-onur".$passInput);
					$st->prepare("select st_id,st_username from user where st_id=? and pass_control=? and st_activate=1");
					$st->bind_param('is',$studentID,$pass_control);
					$st->execute();
					$st->bind_result($userId,$username);
					if($st->fetch()){						
						$_SESSION["userId"]=$userId;
						$_SESSION["username"]=$username;
						header("location:index.php");
					} else {
						header("location:index.php");
					}	
			} else {
				header("location:index.php");
			}
		}
?>