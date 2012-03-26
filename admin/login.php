<?php include("../GLOBALS.php");
include '../connection.php';
session_start();
if(isset ($_SESSION["id"]) and $_SESSION["username"] ) {
	$id=$_SESSION["id"];
	$name=$_SESSION["username"];
	$st->prepare("select admin_id,admin_username from admin where admin_id=? and admin_username=?");
	$st->bind_param('is',$id,$name);
	$st->execute();
	$st->bind_result($id,$name);
	if($st->fetch()){
		header("location:index.php");		
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $sitename; ?> Yönetim Paneli</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="../bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

  </head>

  <body>
  
  <div class="container">
  <div class="formform">
		<fieldset>
		<legend><?php echo $sitename; ?> Yönetim Paneli Girişi</legend>
			 <div id="errorMessage" >
				<div class='place-for-alert'><p> &nbsp;</p></div>
				
				</div>	
			<div class="clearfix">
	            <div class="input">
	              <input class="xlarge" name="username" id="username" size="30" type="text" placeholder='Kullanıcı Adı' />
	            </div>
		    </div><!-- /clearfix -->
			  
			<div class="clearfix">
	            <div class="input">
	              <input class="xlarge" name="password" id="password" size="30" type="password" placeholder='Şifre' />
	         	</div>
	        </div><!-- /clearfix -->
			  
			<div class="actions">
				<button class="btn primary large" onClick="registerAdmin()">Gönder</button>
			</div> 
		  </fieldset>
		 </div>
    <footer>
        <p>&copy; <?php echo $sitename; ?> 2012</p>
    </footer>

	<?php 
	include 'scripts.php';?>
  </div>
  </body>
</html>
