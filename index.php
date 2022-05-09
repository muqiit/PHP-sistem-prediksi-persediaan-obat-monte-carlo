<?php
  INI_SET("display_errors",0);
?>
<?php
@session_start();
if(empty($_SESSION['status_login']))
{
  header('Location:login.php');

}

  if($_GET['id']=="logout")
  {
     unset($_SESSION['status_login']);
    unset($_SESSION['nama_user']);
    unset($_SESSION['lvl']);
    header('Location:login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Simulasi Monte Carlo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?id=1" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P </b>O</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Persediaan </b>Obat</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="index.php?id=logout">Keluar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><h4><?php echo $_SESSION['nama_user']; ?></h4></p>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <?php
        if($_SESSION['lvl']=='1')
        {
      ?>
        <li class="header">ADMIN</li>
        <!-- <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li> -->
        <li><a href="index.php?id=5"><i class="fa fa-edit"></i> <span>Input Persediaan Obat</span></a></li>
        <li><a href="index.php?id=9"><i class="fa fa-files-o"></i>Penggunaan Obat</a></li>
        <li><a href="index.php?id=2"><i class="fa fa-pie-chart"></i> <span>Prediksi Obat</span></a></li>
        
        <li><a href="index.php?id=11"><i class="fa fa-line-chart"></i>Hasil Prediksi</a></li>
        <li><a href="index.php?id=13"><i class="fa fa-tachometer"></i>Akurasi</a></li>
        

        <li class="header">PETUGAS PELAYANAN</li>
        <!-- <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> <span>Menu Utama</span></a></li> -->
        <li><a href="index.php?id=6"><i class="fa fa-edit"></i> <span>Input Penggunaan Obat</span></a></li>
        <li><a href="index.php?id=9"><i class="fa fa-files-o"></i>Penggunaan Obat</a></li>
        <!-- <li><a href="#"><i class="fa fa-files-o"></i>Penggunaan Obat</a></li> -->
        <?php }elseif($_SESSION['lvl']=='2')
        {
          ?>
          <li class="header">MENU</li>
          <!-- <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li> -->
          <li><a href="index.php?id=5"><i class="fa fa-edit"></i> <span>Input Persediaan Obat</span></a></li>
          <li><a href="index.php?id=9"><i class="fa fa-files-o"></i>Penggunaan Obat</a></li>
          <li><a href="index.php?id=2"><i class="fa fa-pie-chart"></i> <span>Prediksi Obat</span></a></li>
          
          <li><a href="index.php?id=11"><i class="fa fa-line-chart"></i>Hasil Prediksi</a></li>
          <li><a href="index.php?id=13"><i class="fa fa-tachometer"></i>Akurasi</a></li>
          <?php
        }elseif($_SESSION['lvl']=='3')
        {
          ?>
          <li class="header">MENU</li>
          <!-- <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> <span>Menu Utama</span></a></li> -->
          <li><a href="index.php?id=6"><i class="fa fa-edit"></i> <span>Input Penggunaan Obat</span></a></li>
          <li><a href="index.php?id=9"><i class="fa fa-files-o"></i>Penggunaan Obat</a></li>
          <?php
        }else{
          ?>
          <?php
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php 
    if($_GET['id']=="")
    {
      include('blank.php');
    }
    if($_GET['id']=="1")
    {
      include('blank.php');
    }
    if($_GET['id']=="2")
    {
      include('obat.php');
    }
    if($_GET['id']=="3")
    {
      include('hitung.php');
    }
    if($_GET['id']=="4")
    {
      include('hasil2.php');
    }
    if($_GET['id']=="5")
    {
      include('input_obat.php');
    }
    if($_GET['id']=="6")
    {
      include('list_obat.php');
    }
    if($_GET['id']=="7")
    {
      include('lihat_pemakaian.php');
    }
    if($_GET['id']=="8")
    {
      include('pemakaian.php');
    }
    if($_GET['id']=="9")
    {
      include('penggunaan.php');
    }
    if($_GET['id']=="10")
    {
      include('detail_penggunaan.php');
    }
    if($_GET['id']=="11")
    {
      include('hasil_simulasi.php');
    }
    if($_GET['id']=="12")
    {
      include('detail_hasil.php');
    }
    if($_GET['id']=="13")
    {
      include('akurasi2.php');
    }

  ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1
    </div>
    <strong>Copyright &copy; 2020-2021</strong>
  </footer>
</div>
<!-- ./Batang Chart -->
<script type="text/javascript" src="chartjs/Chart.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
