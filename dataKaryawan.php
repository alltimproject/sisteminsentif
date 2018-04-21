<?php
  include 'core/init.php';
  $judul = "Data Karyawan";
  include 'include/header.php';

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
       <a href="dataKaryawan.php" class="btn btn-md btn-warning" id="cancel">Cancel Upload<span class="glyphicon glyphicon-cancel"></span></a>
       </center>
     </div>
   </div>

 </div>
 </form>

  <?php } else { //end if isset previewK  ?>

       <div class="box">
          <div class="box-header bg-aqua">
            <h3 class="box-title">Hasil Upload Data Karyawan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="karyawan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Join Date</th>
                <th>Cabang</th>
                <th>Portofolio</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                <?php
                $no =1;
                $show = $karyawan->tampil();
                while($rows = mysqli_fetch_array($show) ):
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?= $rows['nik']  ?></td>
                  <td><?= $rows['nama_karyawan'] ?></td>
                  <td><?= $rows['join_date']  ?></td>
                  <td><?= $rows['cabang'] ?></td>
                  <td><?= $rows['portofolio'] ?></td>
                  <td><a class="btn btn-sm btn-danger" onclick="return confirmDel('<?php echo $rows['nik']; ?>');">Hapus</a></td>

                </tr>
                <?php endwhile; ?>

              </tbody>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Upload CSV</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <form action="home.php" method="post" enctype="multipart/form-data">
           <label>Select CSV</label>
           <input class="form-group" type="file" name="filepegawaiall" value="">

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="submit" name="submit" class="btn btn-primary" value="Upload" >
       </div>
       </form>
     </div>
   </div>
 </div>
<?php } ?>
       <!-- /.row -->
     </section>
     </div>
     <!-- /.container -->
   </div>
   <?php include 'include/footer.php' ?>
