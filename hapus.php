<?php

  include 'core/init.php';

  if(isset($_GET['nik']))
  {
    $nik = $_GET['nik'];
    $hapus = $karyawan->deleteKaryawan($nik);

    if($hapus){
      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal({
                title: 'Data berhasil dihapus',
                type: 'success',
                showConfirmButton: true
              });
            },10);
            window.setTimeout(function(){
              window.location.replace('dataKaryawan.php');
            }, 2000);
          </script>";
    } else {
      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal('Gagal Delete', '', 'error');
            },10);
            window.setTimeout(function(){
              window.location.replace('dataKaryawan.php');
            }, 3000);
          </script>";
    }

  }


  if(isset($_GET['no_kontrak']))
  {
    $no = $_GET['no_kontrak'];
    $hapus = $karyawan->deletePenjualan($no);

    if($hapus){
      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal({
                title: 'Data berhasil dihapus',
                type: 'success',
                showConfirmButton: true
              });
            },10);
            window.setTimeout(function(){
              window.location.replace('dataPenjualan.php');
            }, 2000);
          </script>";
    } else {
      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal('Gagal Delete', '', 'error');
            },10);
            window.setTimeout(function(){
              window.location.replace('dataPenjualan.php');
            }, 3000);
          </script>";
    }

  }


 ?>

 <script src="js/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="sweetalert/dist/sweetalert.min.js"></script>
 <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
