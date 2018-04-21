<?php
class Karyawan{


  //proses upload karyawan
  function upload_proses($nik, $nama, $joindate, $cabang, $portofolio)
  {
    global $link;
    $query = "INSERT INTO tbl_karyawan (nik, nama_karyawan, join_date, cabang, portofolio) VALUES ('$nik', '$nama','$joindate','$cabang','$portofolio')";
    $q     = mysqli_query($link, $query);

      return $q;

  }

  //validasi nik saat di upload
  function selectNik($nik)
  {
    global $link;
    $query = "SELECT * FROM tbl_karyawan WHERE nik = '$nik' ";
    return $q = mysqli_query($link, $query);
  }

  //tampil karyawan
  function tampil()
  {
    global $link;
    $query = "SELECT * FROM tbl_karyawan";
    return $q     = mysqli_query($link, $query);
  }
  //validasi penjualan jika nik karyawan belum terdafar di Database
  function validasiPenjualan($no_kontrak)
  {
    global $link;
    $query = "SELECT * FROM penjualan WHERE no_kontrak = '$no_kontrak' ";
    return $q = mysqli_query($link, $query);
  }

  function upload_penjualan($no_kontrak, $tgl_upload, $tgl_realisasi, $nik, $objek, $pokok, $konversi)
  {
    global $link;
    $query = "INSERT INTO penjualan(no_kontrak, tgl_upload, tgl_realisasi, nik, objek, pokok_hutang, hasil_konversi) VALUES ('$no_kontrak', '$tgl_upload', '$tgl_realisasi', '$nik', '$objek', '$pokok', '$konversi')";
    return $q = mysqli_query($link, $query);
  }

  function tampil_penjualan()
  {
    global $link;
    $query = "SELECT * FROM penjualan LEFT JOIN tbl_karyawan ON penjualan.nik = tbl_karyawan.nik";
    return $q = mysqli_query($link, $query);
  }

  function hitungDataKaryawan()
  {
    global $link;
    $query = "SELECT count(*) AS jumlah FROM tbl_karyawan";
    $q     = mysqli_query($link, $query);
    $result = mysqli_fetch_array($q);
    echo $result['jumlah'];
  }

  function hitungDataPenjualan()
  {
    global $link;
    $query = "SELECT count(*) AS jumlah FROM penjualan";
    $q     = mysqli_query($link, $query);
    $result = mysqli_fetch_array($q);
    echo $result['jumlah'];
  }

  function hitungDataInsentif()
  {
    global $link;
    $query = "SELECT COUNT(DISTINCT tgl_upload) AS jumlah FROM penjualan";
    $q  = mysqli_query($link, $query);
    $result = mysqli_fetch_array($q);
    echo $result['jumlah'];
  }

  function showTglUpload()
  {
    global $link;
    $query    = "SELECT tgl_upload FROM penjualan GROUP BY tgl_upload";
    $q        = mysqli_query($link, $query);

    return $q;
  }

  function showInsentif($tgl_upload)
  {
    global $link;
    $query = "SELECT a.tgl_upload, a.nik,  SUM(a.pokok_hutang) as total, SUM(a.hasil_konversi) as konversi, b.nama_karyawan, b.cabang, b.portofolio,  b.join_date FROM penjualan a LEFT JOIN tbl_karyawan b ON a.nik = b.nik  WHERE a.tgl_upload LIKE '%".$tgl_upload."%' GROUP BY a.nik";
    $q = mysqli_query($link, $query);

    return $q;
  }

  function deleteKaryawan($nik)
  {
    global $link;
    $query = "DELETE FROM tbl_karyawan WHERE nik = '$nik'";
    $q = mysqli_query($link, $query);

    return $q;
  }

  function deletePenjualan($no)
  {
    global $link;
    $query = "DELETE FROM penjualan WHERE no_kontrak = '$no'";
    $q = mysqli_query($link, $query);

    return $q;
  }
  function pilihbyTanggal($tgl_upload)
  {
    global $link;
    $query = "SELECT a.tgl_upload, a.nik, a.tgl_realisasi,a.objek, SUM(a.pokok_hutang) as total, SUM(a.hasil_konversi) as konversi, b.nama_karyawan, b.cabang, b.join_date, b.portofolio FROM penjualan a LEFT JOIN tbl_karyawan b ON a.nik = b.nik  WHERE a.tgl_upload = '$tgl_upload' GROUP BY a.nik";
    $q = mysqli_query($link, $query);

    return $q;
  }



}


 ?>
