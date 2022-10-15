<?php

	session_start();
  if(empty($_SESSION['name'])||empty($_SESSION['level'])){  ?>
    <script>
    alert("Anda Harus Login terlebih Dahulu"); 
    window.location="login/login.php"; 
    </script>
    <?php
  }else
    
    {
    $pilih=$_GET['pilih'];
      switch($pilih){
        default   : $tampil = "master.php"; break;
         case "1.1"  : $tampil = "kepalasekolah/kepsek.php"; break; 
        case "1.2"  : $tampil = "guru/guru.php"; break; 
        case "1.3"  : $tampil = "tabungan_guru/tabungan.php"; break;
         case "1.4"  : $tampil = "siswa/siswa.php"; break; 
          case "1.5"  : $tampil = "tabungan_siswa/tabungan_siswa.php"; break; 
          case "1.6"  : $tampil = "tabungan_siswa/tabungan_siswa_wakel.php"; break; 
          case "1.7"  : $tampil = "tabungan_siswa/tabungan_siswa_ambil.php"; break; 
          case "1.8"  : $tampil = "tabungan_siswa/viewambil.php"; break; 
         
        case "2.1"  : $tampil = "transaksi/transaksi.php"; break; 
           case "2.2"  : $tampil = "tabungan_guru/view_tabunganguru.php"; break; 
             
        case "4.3"  : $tampil = "pengaturan/data-user.php"; break;
       
        case "4.8"  : $tampil = "laporan/laporantransaksi.php"; break;
       
      }
?>

<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>SIPAN | Sistem Simpan SMK Cahaya Hati</title>
  <link rel="shortcut icon" href="logo2.jpg" />
    <link href="Theme/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="Theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="Theme/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="Theme/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="Theme/assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="Theme/assets/css/style.css" rel="stylesheet">
    <link href="Theme/assets/css/style-responsive.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="Theme/assets/js/chart-master/Chart.js"></script>
  </head>
</head>

<body>
<section id="container" >
      <?php 
      if($_SESSION['level']=='admin')
      {
        echo '<header class="header" style="background-color:red;">';
      }
       else if($_SESSION['level']=='kepsek')
      {
        echo '<header class="header" style="background-color:purple;">';
      }
       else if($_SESSION['level']=='guru')
      {
        echo '<header class="header" style="background-color:green;">';
      }
       else if($_SESSION['level']=='walikelas')
      {
        echo '<header class="header" style="background-color:lightblue;">';
      }
       else if($_SESSION['level']=='siswa')
      {
        echo '<header class="header" style="background-color:orange;">';
      }
      ?>
  
              <div class="sidebar-toggle-box" style="color:#f0f0f0f0;">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="#" class="logo">SIPAN |Sistem Simpan SMK Cahaya Hati</a>
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
              <ul style="float:right; margin-top:12px;">
                    <li>
                  <span style="font-size:15px;color:#FFF;"><?php echo date("Y-m-d"); ?></span>
                  <a class="logout" href="login/proses_logout.php">
                <?php 
                      if($_SESSION['level']=='admin')
                      {
                        echo '<button class="btn btn-info" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
                      }
                     
			else if($_SESSION['level']=='kepsek')
                      {
                        echo '<button class="btn btn-success" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
                      }
                      else if($_SESSION['level']=='walikelas')
                      {
                        echo '<button class="btn btn-success" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
                      }
                      else if($_SESSION['level']=='guru')
                      {
                        echo '<button class="btn btn-success" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
                      }
                      else if($_SESSION['level']=='siswa')
                      {
                        echo '<button class="btn btn-success" style="border:3px solid #fff;"><span class="glyphicon glyphicon-off"></span> Logout</button>';
                      }
                 ?>
                  </a></li>
              </ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <?php 
              if($_SESSION['level']=='admin')
              {
                ?>

                  <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#"><img src="logo2.jpg" class="img-circle" width="70"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['name'];?></h5>
                    
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <span style="font-size:130%; color:white;"><i class="fa fa-home"></i>Dashboard</span>
                      </a>
                  </li>
                   <li class="sub-menu">

                        <a href="javascript:;" >
                          <i class="glyphicon glyphicon-th"></i>
                          <span style="font-size:120%; color:#fff;">Master Data</span>
                      </a>
                      <ul class="sub">
                        
              <li><a href="index.php?pilih=1.4">Data Siswa</a></li>
              <li> <a href="index.php?pilih=1.2">Data Guru</a></li>
              <li><a href="index.php?pilih=1.1"> Data Kepala Sekolah</a></li>
             
                      </ul>
                  </li>
                  
                   
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-money"></i>
                          <span style="font-size:120%; color:#fff;">Transaksi</span>
                      </a>
                      <ul class="sub">
                        <li>   <a href="index.php?pilih=1.5">
                        
                          <i class="fa fa-money"></i>Data Tabungan Siswa
                      </a>
                  </li>
                  <li>
                      <a href="index.php?pilih=1.3">
                        
                        <i class="fa fa-dollar"></i>Data Tabungan Guru
                      </a>
                  </li>
              </ul>
              </li>
                 <li class="sub-menu">
                      <a href="index.php?pilih=4.8">

                          <span style="font-size:130%; color:white;"><i class="fa fa-book"></i>Laporan</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                        <a href="javascript:;" >
                          <i class="glyphicon glyphicon-cog"></i>
                          <span style="font-size:120%; color:#fff;">Pengaturan</span>
                      </a>
                      <ul class="sub">
      
           <li> <a href="index.php?pilih=4.3"><i class="fa fa-user"></i> Data User Login</a></li>
                      
               

              </ul>
            </li>
        
            <?php
              }
              else if($_SESSION['level']=='kepsek')
              {
                ?>
                <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#">
                  <img src="logo2.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['name'];?></h5>
  
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-home"></i>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=4.9">
                        
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-money"></i>Data Pengajuan</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=4.8">
                        
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-money"></i>Laporan Transaksi</span>
                      </a>
                  </li>
              </ul>
              <?php
              }
              else if($_SESSION['level']=='walikelas')
              {
                ?>
                <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#">
                  <img src="logo2.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['name'];?></h5>
  
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-home"></i>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=1.6">
                        
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-money"></i>Data Tabungan Siswa</span>
                      </a>
                  </li>
              </ul>
              <?php
              }
              else if($_SESSION['level']=='guru')
              {
                ?>
                <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#">
                  <img src="logo2.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['name'];?></h5>
  
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-home"></i>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=2.2">
                        
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-money"></i>Data Tabungan Guru</span>
                      </a>
                  </li>
                  
              </ul>
              <?php
              }
              else if($_SESSION['level']=='siswa')
              {
                ?>
                <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#">
                  <img src="logo2.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $_SESSION['name'];?></h5>
  
                  <li class="sub-menu">
                      <a href="index.php?pilih=home">
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-home"></i>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="index.php?pilih=1.8">
                        
                          <span style="font-size:130%; color:#fff;"><i class="fa fa-money"></i>Data Tabungan Siswa</span>
                      </a>
                  </li>
              </ul>
            <?php }
            ?>
              <hr>
              <center> SMK Cahaya Hati 2021
              </center>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <section id="main-content">
          <section class="wrapper">
          <?php

           include("$tampil");?>
          </section>
      </section>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="Theme/assets/js/jquery.js"></script>
    <script src="Theme/assets/js/jquery-1.8.3.min.js"></script>
    <script src="Theme/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="Theme/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="Theme/assets/js/jquery.scrollTo.min.js"></script>
    <script src="Theme/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="Theme/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="Theme/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="Theme/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="Theme/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="Theme/assets/js/sparkline-chart.js"></script>    
  <script src="Theme/assets/js/zabuto_calendar.js"></script>  
  
  
  <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  <?php

   } ?>