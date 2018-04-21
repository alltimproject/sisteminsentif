<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=data-insentif.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<h2>Data Isentif Karyawan</h2>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <th width="20">No. </th>
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
    <?php
    require_once 'core/init.php';
    $no = 1;
    $tgl_upload = $_GET['tgl_upload'];
    $show = $karyawan->pilihbyTanggal($tgl_upload);
    while($rows_tgl = mysqli_fetch_array($show) ):

      $upload = new DateTime($rows_tgl['tgl_upload']);
      $join = new DateTime($rows_tgl['join_date']);
      $hitung = $upload->diff($join);
      $hasil = $hitung->days / 31;

     ?>
    <tr valign="top">
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
      <td> <? $rows_tgl['konversi'] * $insentif; echo number_format($insentif); ?> </td>
    </tr>
      <?php endwhile; ?>
  </tbody>
</table>
