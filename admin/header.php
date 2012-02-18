<?php include("../GLOBALS");
include '../connection.php';
session_start();
if(isset ($_SESSION["id"]) and $_SESSION["username"] ) {
	$id=$_SESSION["id"];
	$name=$_SESSION["username"];
	$st->prepare("select admin_id,admin_username from admin where admin_id=? and admin_username=?");
	$st->bind_param('is',$id,$name);
	$st->execute();
	$st->bind_result($id,$name);
	if(!$st->fetch()){
		header("location:login.php");		
    }
}else {
	header("location:login.php");
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

    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a class="brand" href="../index.php"><?php echo $sitename; ?></a>
          <ul class="nav">
            <li><a href="index.php">Panel Anasayfa</a></li>
			
			<li class=​"dropdown">​<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Haberler <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Yeni Haber Ekle</a></li>
                <li><a href="#">Tüm Haberler</a></li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Duyurular <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Duyuru Yap</a></li>
                <li><a href="#">Tüm Duyurular</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Takvim <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Olay Ekle</a></li>
                <li><a href="#">Tüm Olaylar</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Üye İşlemleri <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Tüm Üyeler</a></li>
                <li><a href="#">Akademik Kadro</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Davet Et</a></li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Yanbar Linkleri <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Yeni Ekle</a></li>
                <li><a href="#">Kategori Ekle</a></li>
                <li><a href="#">Tümünü Görüntüle</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dönem İşlemleri <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="newTerm.php">Yeni Dönem Ekle</a></li>
                <li><a href="editTerm.php">Dönem Güncelle</a></li>
                <li><a href="allTerm.php">Tümünü Görüntüle</a></li>
              </ul>
            </li>
          </ul>
          
          <div class="pull-right" style="margin-right: 45px;">
	          <ul class="nav">
		          <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name;?><b class="caret"></b></a>
		              <ul class="dropdown-menu">
		                <li><a href="#">Hesap İşlemleri</a></li>
		                <li class="divider"></li>
                		<li><a href="logout.php">Çıkış Yap</a></li>
		              </ul>
		            </li>
	          </ul>
         </div> 
        </div>
      </div>
    </div>
	
	<div class="container-fluid">
	
	
	 <div class="sidebar">
        <div class="well">
          <h5>Haberler</h5>
          <ul>
            <li><a href="#">Yeni Haber Ekle</a></li>
            <li><a href="#">Tüm Haberler</a></li>
          </ul>
          <h5>Duyurular</h5>
          <ul>
            <li><a href="#">Duyuru Yap</a></li>
            <li><a href="#">Tüm Duyurular</a></li>
          </ul>
          <h5>Takvim</h5>
          <ul>
            <li><a href="#">Olay Ekle</a></li>
            <li><a href="#">Tüm Olaylar</a></li>
          </ul>
		  <h5>Üye İşlemleri</h5>
          <ul>
            <li><a href="#">Davet Et</a></li>
            <li><a href="#">Akademik Kadro</a></li>
            <li><a href="#">Tüm Üyeler</a></li>
          </ul>
        </div>
      </div>
	  
	  
	
	
	
	  <div class="content">