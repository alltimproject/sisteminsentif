<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="container">
    <div class="pull-right hidden-xs">
      <b>Version</b>
    </div>
    <strong>Copyright &copy; 2017 <a href="#">Sistem Perhitungan Isentif</a>.</strong> All rights
    reserved.
  </div>
  <!-- /.container -->
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script type="text/javascript" src="sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $(function(){
      var path = window.location.href;

      if(path === "http://localhost/Sistem_Insentif/dataKaryawan.php")
      {
        $('#menuPJ').animate({width: 'toggle'});
        $('#menuIn').animate({width: 'toggle'});
      }else if (path === "http://localhost/Sistem_Insentif/dataInsentif.php")
      {
        $('#menuPJ').animate({width: 'toggle'});
        $('#menuK').animate({width: 'toggle'});
      } else if (path === "http://localhost/Sistem_Insentif/dataPenjualan.php")
      {
        $('#menuIn').animate({width: 'toggle'});
        $('#menuK').animate({width: 'toggle'});
      } else if (path === "http://localhost/Sistem_Insentif/home.php")
      {
        $('#menuIn').hide('fast');
        $('#menuK').hide('fast');
        $('#menuPJ').hide('fast');

        $('#menuIn').slideDown('slow');
        $('#menuK').slideDown('slow');
        $('#menuPJ').slideDown('slow');
      }
    })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#logout').click(function(){
      var getLink = $(this).attr('href');
      swal({
        title: "Apakah Anda Yakin?",
        text: "Anda akan logout dan memerlukan Login kembali untuk mengakses halaman ini",
        type: "warning",
        confirmButtonColor: "rgb(14, 95, 233)",
        cancelButtonColor: "rgb(242, 11, 11)",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        showCancelButton: true,
        closeOnConfirm: false
      },
      function(){
        window.location.href = getLink
      });
      return false;
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#cancel').click(function(){
      var getLink = $(this).attr('href');
      swal({
        title: "Apakah Anda yakin ingin membatalkan?",
        type: "warning",
        confirmButtonColor: "rgb(14, 95, 233)",
        cancelButtonColor: "rgb(242, 11, 11)",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        showCancelButton: true,
        closeOnConfirm: false
      },
      function(){
        window.location.href = getLink
      });
      return false;
    });
  });
</script>
<script type="text/javascript">
function confirmDel(id)
{
  swal({
    title: "Apakah Anda yakin ingin menghapus data ini?",
    type: "warning",
    confirmButtonColor: "rgb(14, 95, 233)",
    cancelButtonColor: "ss",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
    showCancelButton: true,
    closeOnConfirm: false
  },
  function(){
    window.location.href = "hapus.php?nik="+id;
  });
  return false;
}
</script>

<script>
function confirmDelPJ(id)
{
  swal({
    title: "Apakah Anda yakin ingin menghapus data ini?",
    type: "warning",
    confirmButtonColor: "rgb(14, 95, 233)",
    cancelButtonColor: "ss",
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
    showCancelButton: true,
    closeOnConfirm: false
  },
  function(){
    window.location.href = "hapus.php?no_kontrak="+id;
  });
  return false;
}
</script>

<script type="text/javascript">
  $(function(){
    $('#karyawan').DataTable();
    $('#penjualan').DataTable();
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('.navigasi').click(function(){
        $('#menuIn').slideDown();
        $('#menuK').slideDown();
        $('#menuPJ').slideDown();
      });
    });
</script>

<script type="text/javascript">
$(function(){
  $('.alert').hide();
  $('.karyawan-form').submit(function(){
    $('.alert').hide();
    if($('input[name=filepegawaiall]').val() == ""){
      $('.alert').fadeIn().html('<strong> Harap Masukkan File Karyawan</strong>');
    }else {
      return true;
    }
    return false;
  });
});
</script>

<script type="text/javascript">
$(function(){
  $('.alert').hide();
  $('.penjualan-form').submit(function(){
    $('.alert').hide();
    if($('input[name=filepenjualanall]').val() == ""){
      $('.alert').fadeIn().html('<strong> Harap Masukkan File Penjualan</strong>');
    }else {
      return true;
    }
    return false;
  });
});
</script>


<script type="text/javascript">
    $(".loader").fadeOut(3000);
</script>
<script>
$('#notifications').slideDown('slow').delay(1500).slideUp('slow');



</script>

</body>
</html>
