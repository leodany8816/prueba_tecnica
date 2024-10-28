<?php
  // BD
  $host = "localhost";
  $usuario = "root";
  $base = "registrosdb";
  $contrasena = "";
  global $dbcon;
  $dbcon = new mysqli($host,$usuario,$contrasena,$base) OR die ("Error al conectar con la base de datos");  
  mysqli_set_charset($dbcon, 'utf8');    
  date_default_timezone_set("America/Mexico_City");
?>

