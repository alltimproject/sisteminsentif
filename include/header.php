<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Perhitungan Insentif</title>
  <style media="screen">
  #notifications {
      cursor: pointer;
      position: fixed;
      right: 0px;
      z-index: 9999;
      bottom: 0px;
      margin-bottom: 22px;
      margin-right: 15px;
      min-width: 300px;
      max-width: 800px;
    }
 }
  </style>
  <style media="screen">
	.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url('images/loadingmy.gif') 50% 50% no-repeat rgb(251, 244, 244);
			opacity: .9;
}
	</style>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="home.php" class="navbar-brand"> Insentive Management </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">

            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="home.php" id="navigasi">Beranda</a></li>
                <li><a href="dataKaryawan.php" id="navigasi">Data Karyawan</a></li>
                <li><a href="dataPenjualan.php" id="navigasi">Data Penjualan</a></li>
                <li><a href="dataInsentif.php" id="navigasi">Data Insentif</a></li>

              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Hello, <?php echo $_SESSION['username']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header" style="height: 80px;">
                  <p>
                    <?php echo $_SESSION['name']; ?>
                    <small><?php echo $_SESSION['level']; ?> </small>
                  </p>
                </li>

                <li class="user-footer">
                    <center> <a href="logout.php" id="logout" class="btn btn-default btn-danger" style="width: 250px; color: white;">Sign Out</a> </center>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>


  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $judul; ?>
          <small>Sistem Perhitungan Insentif</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="home.php" id="navigasi"><i class="fa fa-dashboard"></i> Beranda </a></li>
          <li class="active"><?php echo $judul; ?></li>
        </ol>
      </section>
      <!-- Main content -->
    <section class="content">
       <!-- show modal form Upload -->
      <!-- Small boxes (Stat box) -->
      <div class="">
      </div>
        <p></p>
      <div class="row">
        <div class="col-lg-4 col-xs-6" id="menuK">
          <!-- small box -->
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3><?= $karyawan->hitungDataKaryawan() ?></h3>
              <p> <a href="dataKaryawan.php" style="color: white" id="navigasi">Data Karyawan </a> </p>
            </div>
            <a  data-toggle="modal" data-target="#exampleModal" class="small-box-footer">Upload Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6" id="menuPJ">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $karyawan->hitungDataPenjualan() ?></h3>
              <p> <a href="dataPenjualan.php" style="color: white" id="navigasi"> Data Penjualan </a></p>
            </div>
            <a  data-toggle="modal" data-target="#dataPenjualan" class="small-box-footer">Upload Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6" id="menuIn">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $karyawan->hitungDataInsentif() ?></h3>
              <p> <a href="dataInsentif.php" style="color: white" id="navigasi"> Data Insentif </a></p>
            </div>
            <a  href="dataInsentif.php" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(63, 100, 232); color: white;">
        <h3 class="modal-title" id="exampleModalLabel">Upload Data Karyawan</h3>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" class="karyawan-form" method="post" enctype="multipart/form-data">
          <label>Select</label>
          <input class="form-group" type="file" name="filepegawaiall" value="">
      </div>
      <div class="modal-footer">
        <div class="alert alert-danger"></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="previewK" class="btn btn-primary" value="Upload" >
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="dataPenjualan" tabindex="-1" role="dialog" aria-labelledby="dataP Penjualanalan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(29, 162, 13); color: white;">
        <h3 class="modal-title" id="exampleModalLabel">Upload Data Penjualan</h3>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="penjualan-form" enctype="multipart/form-data">
          <label>Select</label>
          <input class="form-group" type="file" name="filepenjualanall" value="">
      </div>
      <div class="modal-footer">
        <div class="alert alert-danger"></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="previewPJ" class="btn btn-success" value="Upload">
      </div>
      </form>
    </div>
  </div>
</div>
