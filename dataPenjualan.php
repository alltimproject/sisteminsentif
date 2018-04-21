<?php
include 'core/init.php';
$judul = "Data Penjualan";
include 'include/header.php';

if(isset($_POST['previewPJ']) ) {

  $newFile = 'data.xls';

 basename($_FILES['filepenjualanall']['name'] );

        if(is_file('storage/'.$newFile) ){
          unlink('storage/'.$newFile);
        }

  move_uploaded_file($_FILES['filepenjualanall']['tmp_name'], 'storage/'.$newFile);

  $data = new Spreadsheet_Excel_Reader('storage/'.$newFile, false);
  $baris = $data->rowcount($sheet_index = 0 );

  $no = 1; ?>
  <form  action="proses.php" method="post">

    <div class="box">
      <div class="box-header" style="background-color: rgb(28, 172, 59); color: white;">
        <div class="">
          <center><h2><b>Preview</b></h2></center>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>No Kontrak</th>
              <th>Tanggal Realisasi</th>
              <th>NIK</th>
              <th>object</th>
              <th>Pokok</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for($i = 2; $i<=$baris; $i++){
              $nik               = $data->val($i, 3);
              $no_kontrak        = $data->val($i, 1);

                    //validasi data yang sudah ada
                    $validasiNoKontrak = $karyawan->validasiPenjualan($no_kontrak);
                    if(mysqli_num_rows($validasiNoKontrak) > 0 ){
                      $no_kontrak_td = "style='background: #2bc20c;'";
                      $text          = "Data Sudah Ada";
                    }else{
                      $no_kontrak_td = "";
                      $text          = "";
                    }


                    //validasi nik yang tidak terdaftar
                    $validasiNik       = $karyawan->selectNik($nik);
                    if(mysqli_num_rows($validasiNik) > 0 ){
                      $nik_td          = "";
                      $text            = "";
                    }else{
                      $nik_td          = "style='background: #c21c0c;'";
                      $text            = "Karyawan Belum Terdaftar";
                    }

            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td <?= $no_kontrak_td ?> ><?= $no_kontrak ?></td>
              <td><?= $data->val($i, 2) ?></td>
              <td <?= $nik_td ?>><?= $data->val($i, 3) ?></td>
              <td><?= $data->val($i, 4) ?></td>
              <td><?= $data->val($i, 5)   ?></td>
            </tr>
           <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <div>
          <center>
          <button type="submit" name="submitPj" class="btn btn-md btn-success" >Submit Data <span class="glyphicon glyphicon-plus"></span></button>
          <a href="dataPenjualan.php" class="btn btn-md btn-warning" id="cancel">Cancel Upload<span class="glyphicon glyphicon-cancel"></span></a>
          </center>
        </div>
      </div>

    </div>
  </form>

<?php } else { //end if isset previewK  ?>
       <div class="box">
          <div class="box-header bg-green">
            <h3 class="box-title">Hasil Upload Data Penjualan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="penjualan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>No Kontrak</th>
                <th>Tanggal Realisasi</th>
                <th>Nik</th>
                <th>Nama Karyawa</th>
                <th>Objek</th>
                <th>pokok_hutang</th>
                <th>Hasil Konversi</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                <?php
                $no =1;
                $show = $karyawan->tampil_penjualan();
                while($rows = mysqli_fetch_array($show) ):
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?= $rows['no_kontrak']  ?></td>
                  <td><?= $rows['tgl_realisasi'] ?></td>
                  <td><?= $rows['nik']  ?></td>
                  <td><?= $rows['nama_karyawan'] ?></td>
                  <td><?= $rows['objek'] ?></td>
                  <td><?= number_format($rows['pokok_hutang']) ?></td>
                  <td><?= $rows['hasil_konversi'] ?></td>
                  <td><a class="btn btn-sm btn-danger" onclick="return confirmDelPJ('<?php echo $rows['no_kontrak']; ?>');">Hapus</a></td>
                </tr>
              <?php endwhile; ?>

              </tbody>

            </table>
          </div>
          <!-- /.box-body -->
        </div>




       <!-- /.row -->

     <?php } ?>
     </section>
     </div>
     <!-- /.container -->
   </div>
   <?php include 'include/footer.php' ?>
