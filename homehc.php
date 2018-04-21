<?php
include 'core/init.php';

if(!isset($_SESSION['login']) == TRUE ){
  header('Location: index.php');
}

include 'include/headerhc.php';
 ?>
 <!-- Full Width Column -->
 <div class="content-wrapper">
   <div class="container-fluid">
     <!-- Content Header (Page header) -->
     <section class="content-header">
       <h3>
         Laporan Perhitungan Insentif
         <small>Management System</small>
       </h3>
       <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Layout</a></li>
         <li class="active">Top Navigation</li>
       </ol>
     </section>
     <!-- Main content -->
   <section class="content">
     <!-- /.box-header -->
     <div class="row">
      <div class="col-md-8">
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title">Tanggal Upload</h3>
          </div>

          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">No</th>
                <th>Tanggal</th>
                <th style="width: 300px">Action</th>
              </tr>
              <?php
              $no = 1;
              $show = $karyawan->showTglUpload();
              while($rows_hc = mysqli_fetch_array($show) ):?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $rows_hc['tgl_upload'] ?></td>
                <td>
                  <a href="homehc.php?tgl_upload=<?= $rows_hc['tgl_upload']  ?>">Lihat Data</a>

                </td>
              </tr>


              <?php endwhile; ?>

            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3> <?= $karyawan->hitungDataInsentif() ?> </h3>
            <p> <a href="dataPenjualan.php" style="color: white">Tanggal Upload</a></p>
          </div>
          <a  data-toggle="modal" data-target="#dataPenjualan" class="small-box-footer">Upload Penjualan <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>



    </div>
          <!-- /.box-body -->
          <?php if(isset($_GET['tgl_upload']) ){ ?>
          <div class="box">
            <div class="box-header" style="background-color: rgb(23, 175, 231); color: white;">
              <div>
                <center> <h2> <b> Laporan Tanggal <?php echo $_GET['tgl_upload'] ?> </b> </h2> </center>
              </div>

            </div>

            <div class="box-body">
                <a href="report.php?tgl_upload=<?= $_GET['tgl_upload'] ?>" class="btn btn-success" onclick="return confirm('apakah anda yakin ingin mencetak ?')" >PRINT EXCEL</a>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Nik</th>
                    <th>Nama Karyawan</th>
                    <th>Portofolio</th>
                    <th>Join Date</th>
                    <th>Masa Kerja</th>
                    <th>Point Konversi</th>
                    <th>Tarif Insentif</th>
                    <th>Total Insentif</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $tgl_upload = $_GET['tgl_upload'];
                  $show = $karyawan->pilihbyTanggal($tgl_upload);
                  while($rows_tgl = mysqli_fetch_array($show) ):

                    $upload = new DateTime($rows_tgl['tgl_upload']);
                    $join = new DateTime($rows_tgl['join_date']);
                    $hitung = $upload->diff($join);
                    $hasil = $hitung->days / 31;

                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $rows_tgl['cabang'] ?></td>
                    <td><?= $rows_tgl['nik'] ?></td>
                    <td><?= $rows_tgl['nama_karyawan'] ?></td>
                    <td><?= $rows_tgl['portofolio'] ?></td>
                    <td><?= $rows_tgl['join_date'] ?></td>
                    <td><?= floor($hasil); ?> Bulan</td>
                    <td><?= $rows_tgl['konversi'] ?></td>
                    <td>
                      <?php
                        $insentif = 0;
                        if($hasil < 2)
                        {
                          if($rows_tgl['konversi'] <= 10)
                          {
                            $insentif = 30000;
                          } elseif($rows_tgl['konversi'] <= 20)
                          {
                            $insentif = 60000;
                          } elseif($rows_tgl['konversi'] <= 45)
                          {
                            $insentif = 75000;
                          } else
                          {
                            $insentif = 105000;
                          }
                        } elseif($hasil < 3)
                        {
                          if($rows_tgl['konversi'] <= 15)
                          {
                            $insentif = 30000;
                          } elseif($rows_tgl['konversi'] <= 24)
                          {
                            $insentif = 60000;
                          } elseif($rows_tgl['konversi'] <= 45)
                          {
                            $insentif = 75000;
                          } else {
                            $insentif = 105000;
                          }
                        } elseif($hasil >= 3)
                        {
                          if($rows_tgl['konversi'] <= 20)
                          {
                            $insentif = 30000;
                          } elseif($rows_tgl['konversi'] <= 34)
                          {
                            $insentif = 60000;
                          } elseif($rows_tgl['konversi'] <= 45)
                          {
                            $insentif = 75000;
                          } else {
                            $insentif = 105000;
                          }
                        }

                        echo "Rp. ".number_format($insentif);
                       ?>

                    </td>
                    <td> <? $total = $rows_tgl['konversi'] * $insentif; echo number_format($total) ?> </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          <?php } ?>






</div>
</div>
</div>
<?php include 'include/footer.php' ?>
