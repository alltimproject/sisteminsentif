<?php
include 'core/init.php';


$judul = "Beranda";

if(!isset($_SESSION['login']) == TRUE ){
  header('Location: index.php');
}
include 'include/header.php';
 //priview karyawan

 if(isset($_POST['previewK']) ) {
   $newFile = 'data.xls';

  basename($_FILES['filepegawaiall']['name'] );

         if(is_file('storage/'.$newFile) ){
           unlink('storage/'.$newFile);
         }

   move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], 'storage/'.$newFile);

   $data = new Spreadsheet_Excel_Reader('storage/'.$newFile, false);
   $baris = $data->rowcount($sheet_index = 0 );

   $no = 1; ?>
  <form  action="proses.php" method="post">
  <div class="box">
    <div class="box-header" style="background-color: rgb(23, 175, 231); color: white;">
      <div>
        <center> <h2> <b> Preview </b> </h2> </center>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Join Date</th>
            <th>Cabang</th>
            <th>Portofolio</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for($i = 2; $i<=$baris; $i++){
           $nik      = $data->val($i, 1);
           $validasi = $karyawan->selectNik($nik);
             if(mysqli_num_rows($validasi) > 0 ){
                 $nik_td  = "style='background: #2bc20c;'";
                 $nik_text = "Data Sudah Ada Di Database";
             }else{
                 $nik_td   = "";
                 $nik_text = "Data Belum Terdaftar / Baru ";
             }
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td <?= $nik_td  ?>><?= $nik ?></td>
            <td><?= $data->val($i, 2)?></td>
            <td><?= $data->val($i, 3)?></td>
            <td><?= $data->val($i, 4)?></td>
            <td><?= $data->val($i, 5)?></td>
            <td <?= $nik_td ?> ><?= $nik_text ?></td>
          </tr>
         <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="box-footer">
      <div>
        <center>
        <button type="submit" name="submit" class="btn btn-md btn-success" >Submit Data <span class="glyphicon glyphicon-plus"></span></button>
        <a href="home.php" class="btn btn-md btn-warning" id="cancel">Cancel Upload<span class="glyphicon glyphicon-cancel"></span></a>
        </center>
      </div>
    </div>

  </div>
  </form>

   <?php } //end if isset previewK  ?>

   <?php
   //penjualan

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
                  <td><?= number_format($data->val($i, 5) )  ?></td>
                </tr>
               <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <div>
              <center>
              <button type="submit" name="submitPj" class="btn btn-md btn-success" >Submit Data <span class="glyphicon glyphicon-plus"></span></button>
              <a href="home.php" class="btn btn-md btn-warning" id="cancel">Cancel Upload<span class="glyphicon glyphicon-cancel"></span></a>
              </center>
            </div>
          </div>

        </div>
      </form>

      <?php } //end if isset previewK  ?>


      <!-- /.row -->
    </section>
    </div>
    <!-- /.container -->
  </div>
  <?php include 'include/footer.php' ?>
