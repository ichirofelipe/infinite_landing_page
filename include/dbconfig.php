<?php
require_once('functions.php');

$servername = "localhost";
$username = "root";
$password = "";
$database = "ilp";
$prefix = "ilp_";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
date_default_timezone_set('Asia/Singapore');

// Check connection
if ($conn->connect_error) {
  logInfo("Database connection failed".' - '.date("F j, Y, g:i a").PHP_EOL);
  die("Connection failed: " . $conn->connect_error);
}

function closeConn(){
  global $conn, $prefix;
  $conn->close();
}

function insertQuery($data, $table, $getLastId = false){
  global $conn, $prefix;
  $sql['columns'] = $sql['values'] = [];
  $timestamp = time();
  $datetime = date('Y-m-d H:i:s', $timestamp);

  foreach($data as $column => $value){
    array_push($sql['columns'], $table."_".$column);
    array_push($sql['values'], "'".$value."'");
  }
  $query = "INSERT INTO $prefix"."$table (".implode(',',$sql['columns']).",$table"."_created_at,$table"."_updated_at)
  VALUES (".implode(',',$sql['values']).",'".$datetime."','".$datetime."')";

  $result = $conn->query($query);
  if($result && $getLastId)
    return $conn->insert_id;

  return $result;
}

function insertMultipleQuery($table, $columns, $values){
  global $conn, $prefix;
  $timestamp = time();
  $datetime = date('Y-m-d H:i:s', $timestamp);

  $query = "INSERT INTO $prefix"."$table (".implode(',',$columns).",$table"."_created_at,$table"."_updated_at) VALUES ";
  foreach($values as $key => $val){
    $query.="(".implode(',',$val).",'".$datetime."','".$datetime."')";
    if($key+1 == count($values)){
      $query.=";";
      continue;
    }
    $query.=",";
  }
  
  $result = $conn->query($query);
  return $result;
}

function userVerificationQuery($data, $getLastId = false, $table = 'users'){
  global $conn, $prefix;

  $query = "SELECT * FROM $prefix"."$table WHERE $table"."_username = '".$data['username']."'";
  $result = $conn->query($query);
  if($user = $result->fetch_assoc()){
    $verify = password_verify($data['password'], $user[$table.'_password']);

    if($getLastId && $verify)
      return $user[$table.'_id'];
    return $verify;
  }
}

function dataExistsQuery($user, $table, $column){
  global $conn, $prefix;
  $query = "SELECT * FROM $prefix"."$table WHERE $table"."_". $column ." = '".$user."'";
  $result = $conn->query($query);
  
  return $result->fetch_assoc();
}

function findQuery($value, $table, $column = 'id'){
  global $conn, $prefix;
  
  $query = "SELECT * FROM $prefix"."$table WHERE $table"."_".$column." = '".$value."'";
  $result = $conn->query($query);

  return $result->fetch_assoc();
}

function selectQuery($table, $toSelect = '*', $condition = null, $skip = null, $limit = null){
  global $conn, $prefix;

  $query = "SELECT $toSelect FROM $prefix"."$table ";
  if($condition){
    $query .= "WHERE ";
    foreach($condition as $key => $value){
      $query .= $key.$value." ";
    }
  }

  $query .= "ORDER BY $table"."_id DESC ";

  if($limit)
    $query .= "LIMIT ".($skip?$skip.',':'')."".$limit;
    
  $result = $conn->query($query);

  return $result->fetch_all(MYSQLI_ASSOC);
}

function countQuery($table){
  global $conn, $prefix;

  $query = "SELECT COUNT(*) as count FROM $prefix"."$table";
  
  $result = $conn->query($query);
  
  return $result->fetch_assoc();
}

function deleteQuery($id, $table){
  global $conn, $prefix;

  $query = "DELETE FROM $prefix"."$table WHERE $table"."_id = ".$id;

  $result = $conn->query($query);

  return $result;
}

function toggleStateQuery($id, $table, $column, $value){
  global $conn, $prefix;
  $timestamp = time();
  $datetime = date('Y-m-d H:i:s', $timestamp);
  
  $query = "UPDATE ".$prefix.$table."
  SET ".$column." = '".$value."', $table"."_updated_at = '". $datetime ."'
  WHERE $table"."_id = ".$id;
  
  $result = $conn->query($query);

  return $result;
}

function updateQuery($data, $table, $id){
  global $conn, $prefix;
  $timestamp = time();
  $datetime = date('Y-m-d H:i:s', $timestamp);
  
  $query = "UPDATE ".$prefix.$table." SET ";
  
  foreach($data as $key => $value){
    $query .= $table."_".$key." = '". $value."',";
  }

  $query .= " $table"."_updated_at = '". $datetime."'";
  $query .= " WHERE $table"."_id = ".$id;
  
  $result = $conn->query($query);

  return $result;
}

?>