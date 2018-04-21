<?php
class Auth{

  private $table = 'user';

  public function get($name)
  {
    if(isset($_POST['nama']) ){
      return $_POST[$nama];
    }else if(isset($_GET[$name]) ){
      return $_GET[$nama];
    }
    return false;
  }
  public function checkLoginAdmin($name, $password, $hak_akes)
  {
    global $link;
    $query = "SELECT * FROM $this->table WHERE username='$name' AND password='$password' AND level = '$hak_akes'";
    $q     = mysqli_query($link, $query);
    $row   = $q->fetch_object();

    if(mysqli_num_rows($q) == 1 ){
      $_SESSION['login'] = TRUE;
      $_SESSION['username']  = $row->username;
      $_SESSION['level']     = $row->level;
      $_SESSION['name'] = $row->name;

        if($_SESSION['level'] == 'Marketing'){
            echo "ok";
        }else if($_SESSION['level'] == 'HC'){
            echo "okhc";
        }
    }else{
      echo "<b> Username </b> atau <b> Password </b> tidak terdaftar";
    }
  }

  public function escape($data)
  {
    global $link;
    return mysqli_real_escape_string($link, $data);
  }


}


 ?>
