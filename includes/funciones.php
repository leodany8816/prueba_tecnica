<?php
include('config.php');



function anti_injection_texto($sql)
{

  $sql = preg_replace(my_sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $sql);

  $sql = trim($sql);

  $sql = strip_tags($sql);

  $sql = addslashes($sql);

  return $sql;
}

function seg_a_min($tiempo_en_segundos)
{

  $horas = floor($tiempo_en_segundos / 3600);

  $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);

  $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

  $cadena = '';

  if ($horas != 0) {

    $cadena .= $horas . 'hrs. ';
  }

  if ($minutos != 0) {

    $cadena .= $minutos . 'min. ';
  }

  if ($segundos != 0) {

    $cadena .= $segundos . 'seg. ';
  }

  return $cadena;
}

function anti_injection($user, $pass)
{

  $banlist = array(

    "insert", "select", "update", "delete", "distinct", "having", "truncate", "replace",

    "handler", "like", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc"

  );

  if (preg_match("/[a-zA-Z0-9]+/i", $user)) {

    $user = trim(str_replace($banlist, '', strtolower($user)));
  } else {

    $user = null;
  }

  if (preg_match("/[a-zA-Z0-9]+/i", $pass)) {

    $pass = trim(str_replace($banlist, '', strtolower($pass)));
  } else {

    $pass = null;
  }

  $array = array('user' => $user, 'pass' => $pass);

  if (in_array(NULL, $array)) {

    return false;
  } else {

    return true;
  }
}

function my_sql_regcase($str)
{

  $res = "";

  $chars = str_split($str);

  foreach ($chars as $char) {

    if (preg_match("/[A-Za-z]/", $char))

      $res .= "[" . mb_strtoupper($char, 'UTF-8') . mb_strtolower($char, 'UTF-8') . "]";

    else

      $res .= $char;
  }

  return $res;
}


function insertar_bd($tabla, $atributos)
{

  global $dbcon;

  $contador = 0;

  $bandera = false;

  $valor = '';

  $columna = '';

  foreach ($atributos as $k => $v) {

    if ($contador == 0 && ($contador + 1 == sizeof($atributos))) {

      $columna .= "(" . $k . ")";

      $valor .= "('" . $v . "')";
    } else if ($contador + 1 == sizeof($atributos)) {

      $columna .= ", " . $k . ")";

      $valor .= ", '" . $v . "')";
    } else if ($contador == 0) {

      $columna = "(" . $k . "";

      $valor = "('" . $v . "'";
    } else {

      $columna .= ", " . $k . "";

      $valor .= ", '" . $v . "'";

      $bandera = true;
    }

    $contador++;
  }

  $sql = "INSERT INTO " . $tabla . " " . $columna . " VALUES " . $valor;

  //echo 'registro->'. $sql;

  if ($dbcon->query($sql) === TRUE) {

    return $dbcon->insert_id;
  } else {

    return false;
  }
}

function actualizar_bd($tabla, $atributos, $id_columna, $id)
{

  global $dbcon;

  $contador = 0;

  $bandera = false;

  $valor = '';

  foreach ($atributos as $k => $v) {

    if ($contador + 1 == sizeof($atributos)) {

      $valor .= "" . $k . " = '" . $v . "'";
    } else {

      $valor .= "" . $k . " = '" . $v . "', ";
    }

    $contador++;
  }

  $sql = "UPDATE " . $tabla . " SET " . $valor . " WHERE " . $id_columna . " = '" . $id . "'";

  //echo "sql->".$sql."<br/>"; 

  if ($dbcon->query($sql) === TRUE) {

    return true;
  } else {

    return false;
  }
}


function eliminar_bd($tabla, $id_columna, $id)
{

  global $dbcon;

  $sql = "DELETE FROM " . $tabla . " WHERE " . $id_columna . " = '" . $id . "'";

  //echo $sql;       

  if ($dbcon->query($sql) === TRUE) {

    return true;
  } else {

    return false;
  }
}

function informacion_registro_query($sql)
{

  //echo "query->".$sql;

  global $dbcon;

  $resultado = array();

  $result = $dbcon->query($sql);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      $resultado = $row;
    }
  }

  return $resultado;
}

function informacion_registros_query($sql)
{

  global $dbcon;

  //echo $sql."<br/>";   

  $resultado = array();

  $result = $dbcon->query($sql);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      $resultado[] = $row;
    }
  }

  return $resultado;
}