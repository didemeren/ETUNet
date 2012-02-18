<?php include'GLOBALS'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $sitename; ?> - Anasayfa</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="./bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 820px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span10,
      .content .span4 {
        min-height: 500px;
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span4 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }

      .topbar .btn {
        border: 0;
      }

    </style>

    <!-- Le fav and touch icons 
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	-->
  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container-fluid">
          <a class="brand" href="index.php"><?php echo $sitename; ?></a>
          <ul class="nav">
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="#about">Tartışma Alanı</a></li>
            <li><a href="#calendar">Takvim</a></li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Duyurular</a></li>
                <li><a href="#">Yaklaşan Olaylar</a></li>
                <li><a href="#">Kayıtlı Dersler</a></li>
                <li class="divider"></li>
                <li><a href="#">Profil Görüntüle</a></li>
              </ul>
            </li>
          </ul>
		  
		  <?php
		   
		   if (isset($_SESSION['username'])) {

					echo "<p class='navbar-text pull-right'><a href='#'>{$_SESSION['username']}</a> olarak giriş yapıldı</p>";

			} else {

					echo "<form action='login' class='pull-right'>\n";
					echo "<input class='input-small' type='text' placeholder='Kullanıcı Adı'>\n";
					echo "<input class='input-small' type='password' placeholder='Şifre'>\n";
					echo "<button class='btn' type='submit'>Giriş</button>\n";
					echo "<a class='btn primary' data-toggle='modal' href='#registerModal'>Kayıt Ol</a>\n";
					echo "</form>";
			}
		   ?>
		   

            
			
          
		 
        </div>
      </div>
    </div>
	<?php  include('alerts.php'); ?>
    <div class="container">
      <div class="content">	  
	  <div class="page-header">
          <h1><?php echo $sitename; ?>&nbsp;<small><?php echo $slogan; ?></small></h1>
        </div>
 <div class="row">