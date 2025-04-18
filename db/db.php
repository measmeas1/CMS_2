<?php 
  session_start();
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'php_cms2';
  $port = 3307;

  $con = mysqli_connect($host, $user, $pass, $db, $port);

  if (!$con){
    die("Connection failed: ". mysqli_connect_error());
  }
?>