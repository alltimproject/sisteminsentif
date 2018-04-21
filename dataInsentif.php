<?php
  include 'core/init.php';
  $judul = "Data Insentif";
  include 'include/header.php';
 ?>
    <!-- /.box-header -->
      <form class="" action="dataInsentif.php" method="post">
        <div class="form-group">
          <div class="col-md-4">
            <label> Tanggal Upload </label>
            <div class="input-group input-group">
            <select class="form-control" name="tgl_upload">
              <option value="">-- Pilih Tanggal --</option>

              <?php
                  $show = $karyawan->showTglUpload();

                  while ($rows = mysqli_fetch_array($show))
                  {
              ?>

              <option value="<?php echo $rows['tgl_upload']; ?>"> <?php echo $rows['tgl_upload']; ?> </option>

              <?php } ?>
            </select>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-md" name="cariPJ"> Cari <span class="glyphicon glyphicon-search"></span></button>
              </span>
          </div>
        </div>
      </div>
    </form><br/><br/><br/><br/>




<?php

  if(isset($_GET['tgl_upload']))
  {
    $tgl_upload = $_GET['tgl_upload'];
  } elseif (isset($_POST['cariPJ']))
  {
    $tgl_upload = $_POST['tgl_upload'];
  }

?>


<?php if(isset($_GET['tgl_upload']) || isset($_POST['cariPJ']))
      {

?>
  <div class="box">
    <div class="box-header bg-yellow">
       <h3 class="box-title">Hasil Upload Data Insentif</h3>
    </div>
    <div class="box-body">
      <a href="report.php?tgl_upload=<?= $tgl_upload ?>" class="btn btn-info btn-xs" onclick="return confirm('Apakah anda yakin ingin mencetak ?')" >PRINT EXCEL</a>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Cabang</th>
          <th>NIK</th>
          <th>Nama Karyawan</th>
          <th>portofolio</th>
          <th>Join Date</th>
          <th>Masa Kerja</th>
          <th>Point Konversi</th>
          <th>Tarif Insenstif</th>
          <th>Total Insentif</th>
        </tr>
        </thead>
        <tbody>

<?php

          $no =1;
          $show = $karyawan->showInsentif($tgl_upload);
          while($rows = mysqli_fetch_array($show) ):

          $upload = new DateTime($rows['tgl_upload']);
          $join = new DateTime($rows['join_date']);
          $hitung = $upload->diff($join);
          $hasil = $hitung->days / 31;

?>

          <tr>
            <td><?= $no++ ?></td>
            <td><?= $rows['cabang']  ?></td>
            <td><?= $rows['nik'] ?></td>
            <td><?= $rows['nama_karyawan']  ?></td>
            <td><?= $rows['portofolio'] ?></td>
            <td><?= $rows['join_date'] ?></td>
            <td><?= floor($hasil);  ?> Bulan</td>
            <td><?= $rows['konversi']  ?></td>

            <td>
              <?php
                $insentif = 0;
                if($hasil < 2)
                {
                  if($rows['konversi'] <= 10)
                  {
                    $insentif = 30000;
                  } elseif($rows['konversi'] <= 20)
                  {
                    $insentif = 60000;
                  } elseif($rows['konversi'] <= 45)
                  {
                    $insentif = 75000;
                  } else
                  {
                    $insentif = 105000;
                  }
                } elseif($hasil < 3)
                {
                  if($rows['konversi'] <= 15)
                  {
                    $insentif = 30000;
                  } elseif($rows['konversi'] <= 24)
                  {
                    $insentif = 60000;
                  } elseif($rows['konversi'] <= 45)
                  {
                    $insentif = 75000;
                  } else {
                    $insentif = 105000;
                  }
                } elseif($hasil >= 3)
                {
                  if($rows['konversi'] <= 20)
                  {
                    $insentif = 30000;
                  } elseif($rows['konversi'] <= 34)
                  {
                    $insentif = 60000;
                  } elseif($rows['konversi'] <= 45)
                  {
                    $insentif = 75000;
                  } else {
                    $insentif = 105000;
                  }
                }

                echo "Rp. ".number_format($insentif);
               ?>

            </td>
            <td> <? $total = $rows['konversi'] * $insentif; echo number_format($total)  ?> </td>

          </tr>
        <?php endwhile; ?>

        </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>


<?php }  ?>






</section>
</div>
</div>
<?php include 'include/footer.php'; ?>
