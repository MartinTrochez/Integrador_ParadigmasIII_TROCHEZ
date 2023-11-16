<?php
function conectar()
{
  global $con;
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $databaseName = 'integrador_paradigmas';
  $con = mysqli_connect($host, $username, $password, $databaseName);
  $ret = false;
  if (mysqli_connect_errno()) {
    printf('Error en la conexion: ');
    exit();
  } else {
    $con->set_charset('utf8');
    $ret = true;
  }
  return $ret;
}

function desconectar()
{
  global $con;
  mysqli_close($con);
}
