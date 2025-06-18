<?php
	session_start();
	include "koneksi/ceksession.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e-Kurir</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <!-- Bootstrap Core CSS -->
    <link href="assets/cssa/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/cssa/modern-business.css" rel="stylesheet">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">

  </head>
  <body>
    <div class="wrapper">
      <?php include "header.php"; ?>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      	<!-- Carousel Indikator -->
        <ol class="carousel-indicators">
        	<li data-target="carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="carousel-example-generic" data-slide-to="1"></li>
        </ol>
        
        <!-- Wrapper for Slide -->
        <div class="carousel-inner">
        	<div class="item active">
            	<img src="images/kurir.png" alt="Slide 1">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
            	<img src="images/Kurir2.png" alt="Slide 1">
                <div class="carousel-caption">
                </div>
            </div>
        </div>
        
        <!-- Control -->
        <a href="#carousel-example-generic" class="carousel-control left" data-slide="prev" role="button">
        	<span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a href="#carousel-example-generic" class="carousel-control right" data-slide="next" role="button">
        	<span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
       
      

      	
    </div> <!-- /.row -->
  </div>

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
  </body>
</html>
