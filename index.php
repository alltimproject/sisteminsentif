

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sitem Perhitungan Isentif</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h3>Sistem Perhitungan Isentif</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <div class="alert alert-danger" role="alert"> </div>

    <form class="login-form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Enter Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <select class="form-control" name="hak_akses">
          <option value="">--Pilih Hak Akses--</option>
          <option value="Marketing">Marketing</option>
          <option value="HC">Hc</option>
        </select>
      </div>

      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="Login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

<script type="text/javascript">
  $(function(){
    $('.alert').hide();
    $('.login-form').submit(function(){
      $('.alert').hide();
      if($('input[name=username]').val() == ""){
        $('.alert').fadeIn().html('<strong> Harap Masukkan Username </strong>');
      } else if($('input[name=password]').val() == "") {
        $('.alert').fadeIn().html('<strong> Harap Masukkan Password </strong>');
      } else if ($('select[name=hak_akses]').val() == "") {
        $('.alert').fadeIn().html('<strong> Harap Pilih Hak Akses </strong>');
      }else {
        $.ajax({
          type : "POST",
          url : "login_cek.php",
          data : $(this).serialize(),
          success : function(data){
            if(data == "ok"){
              window.location = "home.php";
            } else if (data == "okhc") {
              window.location = "homehc.php";
            }
            else $('.alert').fadeIn().html(data);
          }
        });
      }
      return false;
    });
  });
</script>

</body>
</html>
