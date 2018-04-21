<?php
require_once 'core/init.php';

  $email    = $auth->escape($_POST['username'] );
  $password = $auth->escape(md5($_POST['password']) );
  $hak_akes = $auth->escape($_POST['hak_akses']);

  $cek = $auth->checkLoginAdmin($email, $password, $hak_akes);

 ?>
