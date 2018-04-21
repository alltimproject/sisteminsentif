<?php
session_start();

require_once 'functions/Database.php';

require_once 'functions/auth.php';

require_once 'functions/excel_reader.php';

require_once 'functions/Karyawan.php';


$auth     = new Auth();
$karyawan = new Karyawan();
 ?>
