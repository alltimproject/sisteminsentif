<?php
include 'core/init.php';

if(isset($_POST['submit']))
{
  $newFile = "data.xls";
  $data = new Spreadsheet_Excel_Reader('storage/'.$newFile, false);
  $baris = $data->rowcount($sheet_index = 0 );

  for($i =2; $i <= $baris; $i++)
  {
    $nik        = $data->val($i, 1);
    $nama       = $data->val($i, 2);
    $joindate   = $data->val($i, 3);
    $cabang     = $data->val($i, 4);
    $portofolio = $data->val($i, 5);

    $insert   = $karyawan->upload_proses($nik, $nama, $joindate, $cabang, $portofolio);
    if($insert){

        echo "<script type='text/javascript'>
              setTimeout(function(){
                swal({
                  title: 'Data berhasil disimpan',
                  type: 'success',
                  showConfirmButton: true
                });
              },10);
              window.setTimeout(function(){
                window.location.replace('dataKaryawan.php');
              }, 2000);
            </script>";
    }else{
      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal('Gagal Upload', 'Terdapat record yang tidak dapat di save', 'error');
            },10);
            window.setTimeout(function(){
              window.location.replace('dataKaryawan.php');
            }, 3000);
          </script>";
    }
  }
}
//--------------------------------------------------------------//

if(isset($_POST['submitPj']) )
{
  $newFile = "data.xls";
  $data = new Spreadsheet_Excel_Reader('storage/'.$newFile, false);
  $baris = $data->rowcount($sheet_index = 0 );
  $tgl_upload    = date("Y-m-d");

  for($i =2; $i <= $baris; $i++)
  {
    $no_kontrak    = $data->val($i, 1);
    $tgl_realisasi = $data->val($i, 2);
    $nik           = $data->val($i, 3);
    $objek         = $data->val($i, 4);
    $pokok         = $data->val($i, 5);

//membaca jumlah nik yang akan diupload



//membaca nik yang ada di tbl karyawan
    if($objek == "MOTOR BARU")
    {
      if($pokok < 35000000)
      {
        $konversi = 1;
      } elseif ($pokok >= 35000000 && $pokok < 60000000)
      {
        $konversi = 2;
      }elseif ($pokok >= 60000000 && $pokok < 150000000)
      {
        $konversi = 3;
      } elseif ($pokok >= 150000000 && $pokok < 300000000)
      {
        $konversi = 5;
      } else {
        $konversi = 7;
      }
    } elseif ($objek == "MOTOR BEKAS")
    {
      if($pokok < 25000000)
      {
        $konversi = 1;
      } elseif ($pokok >= 25000000 && $pokok < 50000000)
      {
        $konversi = 2;
      }elseif ($pokok >= 50000000 && $pokok < 120000000)
      {
        $konversi = 3;
      } elseif ($pokok >= 120000000 && $pokok < 300000000)
      {
        $konversi = 5;
      } else {
        $konversi = 7;
      }
    } elseif ($objek == "MOBIL BARU")
    {
      if($pokok < 375000000)
      {
        $konversi = 4;
      } elseif ($pokok >= 375000000 && $pokok < 700000000)
      {
        $konversi = 6;
      } else {
        $konversi = 7;
      }
    }elseif ($objek == "MOBIL BEKAS")
    {
      if($pokok < 200000000)
      {
        $konversi = 4;
      } elseif ($pokok >= 200000000 && $pokok < 500000000)
      {
        $konversi = 6;
      } else {
        $konversi = 7;
      }
    } else {
      $konversi = "DATA TIDAK DITEMUKAN";
    }

  $insert   = $karyawan->upload_penjualan($no_kontrak, $tgl_upload, $tgl_realisasi, $nik, $objek, $pokok, $konversi);
  if($insert){


      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal({
                title: 'Data berhasil disimpan',
                type: 'success',
                showConfirmButton: true
              });
            },10);
            window.setTimeout(function(){
              window.location.replace('dataInsentif.php?tgl_upload=".$tgl_upload."');
            }, 2000);
          </script>";
    } else {
      echo "<script type='text/javascript'>
            setTimeout(function(){
              swal('Gagal Upload', 'Terdapat record yang tidak dapat di save', 'error');
            },10);
            window.setTimeout(function(){
              window.location.replace('dataPenjualan.php');
            }, 3000);
          </script>";


  }    
  }
}
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
